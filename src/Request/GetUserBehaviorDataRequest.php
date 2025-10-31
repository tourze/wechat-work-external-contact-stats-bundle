<?php

namespace WechatWorkExternalContactStatsBundle\Request;

use Carbon\CarbonInterface;
use HttpClientBundle\Request\ApiRequest;
use WechatWorkBundle\Request\AgentAware;
use WechatWorkExternalContactStatsBundle\Exception\InvalidParameterException;

/**
 * 获取「联系客户统计」数据
 *
 * @see https://developer.work.weixin.qq.com/document/path/92132
 */
class GetUserBehaviorDataRequest extends ApiRequest
{
    use AgentAware;

    /**
     * @var CarbonInterface 数据起始时间
     */
    private CarbonInterface $startTime;

    /**
     * @var CarbonInterface 数据结束时间
     */
    private CarbonInterface $endTime;

    /**
     * @var string[] 成员ID列表，最多100个
     */
    private array $userIds = [];

    /**
     * @var int[] 部门ID列表，最多100个
     */
    private array $partyIds = [];

    public function getRequestPath(): string
    {
        return '/cgi-bin/externalcontact/get_user_behavior_data';
    }

    public function getRequestOptions(): ?array
    {
        $json = [
            'start_time' => $this->getStartTime()->getTimestamp(),
            'end_time' => $this->getEndTime()->getTimestamp(),
        ];
        if ([] !== $this->getUserIds()) {
            $json['userid'] = $this->getUserIds();
        }
        if ([] !== $this->getPartyIds()) {
            $json['partyid'] = $this->getPartyIds();
        }

        if (!isset($json['userid']) && !isset($json['partyid'])) {
            throw new InvalidParameterException('userid和partyid不可同时为空');
        }

        return [
            'json' => $json,
        ];
    }

    public function getRequestMethod(): ?string
    {
        return 'POST';
    }

    public function getStartTime(): CarbonInterface
    {
        return $this->startTime;
    }

    public function setStartTime(CarbonInterface $startTime): void
    {
        $this->startTime = $startTime;
    }

    public function getEndTime(): CarbonInterface
    {
        return $this->endTime;
    }

    public function setEndTime(CarbonInterface $endTime): void
    {
        $this->endTime = $endTime;
    }

    /**
     * @return string[]
     */
    public function getUserIds(): array
    {
        return $this->userIds;
    }

    /**
     * @param string[] $userIds
     */
    public function setUserIds(array $userIds): void
    {
        $this->userIds = $userIds;
    }

    /**
     * @return int[]
     */
    public function getPartyIds(): array
    {
        return $this->partyIds;
    }

    /**
     * @param int[] $partyIds
     */
    public function setPartyIds(array $partyIds): void
    {
        $this->partyIds = $partyIds;
    }
}
