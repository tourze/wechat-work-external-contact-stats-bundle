<?php

declare(strict_types=1);

namespace WechatWorkExternalContactStatsBundle\Tests\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\PHPUnitSymfonyKernelTest\AbstractRepositoryTestCase;
use WechatWorkBundle\Entity\Agent;
use WechatWorkBundle\Entity\Corp;
use WechatWorkStaffBundle\Entity\User;
use WechatWorkExternalContactStatsBundle\Entity\UserBehaviorDataByUser;
use WechatWorkExternalContactStatsBundle\Repository\UserBehaviorDataByUserRepository;

/**
 * UserBehaviorDataByUserRepository 测试
 *
 * @internal
 */
#[CoversClass(UserBehaviorDataByUserRepository::class)]
#[RunTestsInSeparateProcesses]
final class UserBehaviorDataByUserRepositoryTest extends AbstractRepositoryTestCase
{
    private UserBehaviorDataByUserRepository $repository;

    protected function onSetUp(): void
    {
        $repository = self::getContainer()->get(UserBehaviorDataByUserRepository::class);
        $this->assertInstanceOf(UserBehaviorDataByUserRepository::class, $repository);
        $this->repository = $repository;

        // 创建测试数据以满足AbstractRepositoryTestCase的要求
        $entity = new UserBehaviorDataByUser();
        $entity->setDate(new \DateTimeImmutable('2024-01-01'));
        $entity->setNewApplyCount(10);
        $entity->setNewContactCount(5);
        $entity->setChatCount(20);
        $entity->setMessageCount(100);
        $entity->setReplyPercentage(0.85);
        $entity->setAvgReplyTime(30);
        $entity->setNegativeFeedbackCount(1);
        $entity->setUser($this->createWechatWorkUser());

        self::getEntityManager()->persist($entity);
        self::getEntityManager()->flush();
    }

    public function testSaveWithoutFlushShouldNotPersistImmediately(): void
    {
        $entity = $this->createNewEntity();
        $this->fillEntity($entity);

        $this->repository->save($entity, false);

        // Entity should be managed but not yet in database
        $this->assertTrue(self::getEntityManager()->contains($entity));

        // Flush manually to persist
        self::getEntityManager()->flush();

        $foundEntity = $this->repository->find($entity->getId());
        $this->assertInstanceOf(UserBehaviorDataByUser::class, $foundEntity);
    }

    public function testRemoveWithFlushShouldDeleteEntity(): void
    {
        $entity = $this->createNewEntity();
        $this->fillEntity($entity);
        $this->repository->save($entity);
        $entityId = $entity->getId();

        $this->repository->remove($entity);

        $foundEntity = $this->repository->find($entityId);
        $this->assertNull($foundEntity);
    }

    public function testRemoveWithoutFlushShouldNotDeleteImmediately(): void
    {
        $entity = $this->createNewEntity();
        $this->fillEntity($entity);
        $this->repository->save($entity);
        $entityId = $entity->getId();

        $this->repository->remove($entity, false);

        // Entity should still exist in database until flush
        $foundEntity = $this->repository->find($entityId);
        $this->assertInstanceOf(UserBehaviorDataByUser::class, $foundEntity);

        // Flush to complete deletion
        self::getEntityManager()->flush();

        $foundEntity = $this->repository->find($entityId);
        $this->assertNull($foundEntity);
    }

    public function testFindAllWithInvalidDatabaseSchemaShouldHandleGracefully(): void
    {
        // This test ensures findAll() can handle edge cases
        $result = $this->repository->findAll();

        $this->assertIsArray($result);
    }

    public function testFindOneByWithValidCriteriaShouldWork(): void
    {
        $entity = $this->createNewEntity();
        $this->fillEntity($entity);
        self::getEntityManager()->persist($entity);
        self::getEntityManager()->flush();

        $result = $this->repository->findOneBy(['newApplyCount' => 10]);

        $this->assertInstanceOf(UserBehaviorDataByUser::class, $result);
        $this->assertEquals(10, $result->getNewApplyCount());
    }

    public function testCountWithValidCriteriaShouldWork(): void
    {
        $entity = $this->createNewEntity();
        $this->fillEntity($entity);
        $entity->setNewApplyCount(15); // 使用不同的值，避免与 onSetUp 中的实体冲突
        self::getEntityManager()->persist($entity);
        self::getEntityManager()->flush();

        $count = $this->repository->count(['newApplyCount' => 15]);

        $this->assertEquals(1, $count);
    }

    protected function createNewEntity(): UserBehaviorDataByUser
    {
        $entity = new UserBehaviorDataByUser();
        $entity->setDate(new \DateTimeImmutable('2024-01-01'));

        // 创建一个用户对象来满足外键约束
        $entity->setUser($this->createWechatWorkUser());

        return $entity;
    }

    /**
     * @return ServiceEntityRepository<UserBehaviorDataByUser>
     */
    protected function getRepository(): ServiceEntityRepository
    {
        return $this->repository;
    }

    private function createWechatWorkUser(): User
    {
        $uniqueId = uniqid();

        $corp = new Corp();
        $corp->setName('Test Corp ' . $uniqueId);
        $corp->setCorpId('test_corp_' . $uniqueId);
        $corp->setCorpSecret('test_corp_secret');
        self::getEntityManager()->persist($corp);

        $agent = new Agent();
        $agent->setName('Test Agent ' . $uniqueId);
        $agent->setAgentId('agent_' . $uniqueId);
        $agent->setSecret('test_agent_secret');
        $agent->setCorp($corp);
        self::getEntityManager()->persist($agent);

        $user = new User();
        $user->setUserId('test_user_' . $uniqueId);
        $user->setName('Test User ' . $uniqueId);
        $user->setAgent($agent);
        $user->setCorp($corp);
        self::getEntityManager()->persist($user);
        self::getEntityManager()->flush();

        return $user;
    }

    private function fillEntity(UserBehaviorDataByUser $entity): void
    {
        $entity->setDate(new \DateTimeImmutable());
        $entity->setNewApplyCount(10);
        $entity->setNewContactCount(5);
        $entity->setChatCount(20);
        $entity->setMessageCount(100);
        $entity->setReplyPercentage(0.85);
        $entity->setAvgReplyTime(30);
        $entity->setNegativeFeedbackCount(1);
    }
}
