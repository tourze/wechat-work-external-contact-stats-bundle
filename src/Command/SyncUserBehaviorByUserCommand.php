<?php

namespace WechatWorkExternalContactStatsBundle\Command;

use Carbon\CarbonImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Tourze\Symfony\CronJob\Attribute\AsCronTask;
use Tourze\WechatWorkContracts\UserInterface;
use Tourze\WechatWorkContracts\UserLoaderInterface;
use WechatWorkBundle\Entity\Agent;
use WechatWorkBundle\Repository\AgentRepository;
use WechatWorkBundle\Service\WorkServiceInterface;
use WechatWorkExternalContactBundle\Request\GetFollowUserListRequest;
use WechatWorkExternalContactStatsBundle\Entity\UserBehaviorDataByUser;
use WechatWorkExternalContactStatsBundle\Repository\UserBehaviorDataByUserRepository;
use WechatWorkExternalContactStatsBundle\Request\GetUserBehaviorDataRequest;

#[AsCronTask(expression: '14 6 * * *')]
#[AsCommand(name: self::NAME, description: '获取「联系客户统计」数据-单用户的数据')]
#[Autoconfigure(public: true)]
final class SyncUserBehaviorByUserCommand extends Command
{
    public const NAME = 'wechat-work:sync-user-behavior-by-user';

    public function __construct(
        private readonly WorkServiceInterface $workService,
        private readonly UserLoaderInterface $userLoader,
        private readonly UserBehaviorDataByUserRepository $dataByUserRepository,
        private readonly AgentRepository $agentRepository,
        private readonly EntityManagerInterface $entityManager,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $endTime = CarbonImmutable::today();
        $startTime = $endTime->subWeek();

        foreach ($this->getAllAgents() as $agent) {
            $this->syncAgentUserBehaviorData($agent, $startTime, $endTime);
        }

        return Command::SUCCESS;
    }

    /**
     * @return Agent[]
     */
    private function getAllAgents(): array
    {
        return $this->agentRepository->findAll();
    }

    private function syncAgentUserBehaviorData(Agent $agent, CarbonImmutable $startTime, CarbonImmutable $endTime): void
    {
        $userListRequest = new GetFollowUserListRequest();
        $userListRequest->setAgent($agent);
        $userListResponse = $this->workService->request($userListRequest);

        if (
            !is_array($userListResponse)
            || !isset($userListResponse['follow_user'])
            || !is_array($userListResponse['follow_user'])
        ) {
            return;
        }

        foreach ($userListResponse['follow_user'] as $userId) {
            if (!is_string($userId)) {
                continue;
            }
            $this->syncUserBehaviorData($agent, $userId, $startTime, $endTime);
        }
    }

    private function syncUserBehaviorData(
        Agent $agent,
        string $userId,
        CarbonImmutable $startTime,
        CarbonImmutable $endTime,
    ): void {
        $corp = $agent->getCorp();
        if (null === $corp) {
            return;
        }

        $user = $this->userLoader->loadUserByUserIdAndCorp($userId, $corp);
        if (null === $user) {
            return;
        }

        $request = new GetUserBehaviorDataRequest();
        $request->setAgent($agent);
        $request->setUserIds([$userId]);
        $request->setStartTime($startTime);
        $request->setEndTime($endTime);
        $response = $this->workService->request($request);

        if (!is_array($response) || !isset($response['behavior_data']) || !is_array($response['behavior_data'])) {
            return;
        }

        foreach ($response['behavior_data'] as $datum) {
            if (!is_array($datum)) {
                continue;
            }
            /** @var array<string, mixed> $datum */
            $this->saveBehaviorData($user, $datum);
        }
    }

    /**
     * @param array<string, mixed> $datum
     */
    private function saveBehaviorData(UserInterface $user, array $datum): void
    {
        if (!isset($datum['stat_time']) || !is_numeric($datum['stat_time'])) {
            return;
        }

        $date = CarbonImmutable::createFromTimestamp(
            (int) $datum['stat_time'],
            date_default_timezone_get()
        )->startOfDay();
        $data = $this->findOrCreateBehaviorData($user, $date);
        $this->updateBehaviorDataFields($data, $datum);
        $this->persistBehaviorData($data);
    }

    private function findOrCreateBehaviorData(UserInterface $user, CarbonImmutable $date): UserBehaviorDataByUser
    {
        $data = $this->dataByUserRepository->findOneBy([
            'date' => $date,
            'user' => $user,
        ]);

        if (null === $data) {
            $data = new UserBehaviorDataByUser();
            $data->setDate($date);
            $data->setUser($user);
        }

        return $data;
    }

    /**
     * @param array<string, mixed> $datum
     */
    private function updateBehaviorDataFields(UserBehaviorDataByUser $data, array $datum): void
    {
        $data->setNewApplyCount($this->extractIntValue($datum, 'new_apply_cnt'));
        $data->setNewContactCount($this->extractIntValue($datum, 'new_contact_cnt'));
        $data->setChatCount($this->extractIntValue($datum, 'chat_cnt'));
        $data->setMessageCount($this->extractIntValue($datum, 'message_cnt'));
        $data->setReplyPercentage($this->extractFloatValue($datum, 'reply_percentage'));
        $data->setAvgReplyTime($this->extractIntValue($datum, 'avg_reply_time'));
        $data->setNegativeFeedbackCount($this->extractIntValue($datum, 'negative_feedback_cnt'));
    }

    /**
     * @param array<string, mixed> $datum
     */
    private function extractIntValue(array $datum, string $key): ?int
    {
        return isset($datum[$key]) && is_numeric($datum[$key]) ? (int) $datum[$key] : null;
    }

    /**
     * @param array<string, mixed> $datum
     */
    private function extractFloatValue(array $datum, string $key): ?float
    {
        return isset($datum[$key]) && is_numeric($datum[$key]) ? (float) $datum[$key] : null;
    }

    private function persistBehaviorData(UserBehaviorDataByUser $data): void
    {
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
}
