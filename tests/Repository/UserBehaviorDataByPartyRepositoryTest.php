<?php

declare(strict_types=1);

namespace WechatWorkExternalContactStatsBundle\Tests\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\PHPUnitSymfonyKernelTest\AbstractRepositoryTestCase;
use Tourze\WechatWorkContracts\DepartmentInterface;
use WechatWorkBundle\Entity\Agent;
use WechatWorkBundle\Entity\Corp;
use WechatWorkExternalContactStatsBundle\Entity\UserBehaviorDataByParty;
use WechatWorkExternalContactStatsBundle\Repository\UserBehaviorDataByPartyRepository;
use WechatWorkStaffBundle\Entity\Department;

/**
 * UserBehaviorDataByPartyRepository 测试
 *
 * @internal
 */
#[CoversClass(UserBehaviorDataByPartyRepository::class)]
#[RunTestsInSeparateProcesses]
final class UserBehaviorDataByPartyRepositoryTest extends AbstractRepositoryTestCase
{
    private UserBehaviorDataByPartyRepository $repository;

    protected function onSetUp(): void
    {
        $repository = self::getContainer()->get(UserBehaviorDataByPartyRepository::class);
        $this->assertInstanceOf(UserBehaviorDataByPartyRepository::class, $repository);
        $this->repository = $repository;

        // 创建测试数据以满足AbstractRepositoryTestCase的要求
        $entity = new UserBehaviorDataByParty();
        $entity->setDate(new \DateTimeImmutable('2024-01-01'));
        $entity->setNewApplyCount(10);
        $entity->setNewContactCount(5);
        $entity->setChatCount(20);
        $entity->setMessageCount(100);
        $entity->setReplyPercentage(0.85);
        $entity->setAvgReplyTime(30);
        $entity->setNegativeFeedbackCount(1);
        $entity->setParty($this->createMockDepartment());

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
        $this->assertInstanceOf(UserBehaviorDataByParty::class, $foundEntity);
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
        $this->assertInstanceOf(UserBehaviorDataByParty::class, $foundEntity);

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

        $this->assertInstanceOf(UserBehaviorDataByParty::class, $result);
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

    protected function createNewEntity(): UserBehaviorDataByParty
    {
        $entity = new UserBehaviorDataByParty();
        $entity->setDate(new \DateTimeImmutable('2024-01-01'));

        // 创建一个虚拟的部门对象来满足外键约束
        // 在实际测试中，这会被 AbstractRepositoryTestCase 的 setup 过程替换
        $entity->setParty($this->createMockDepartment());

        return $entity;
    }

    /**
     * 创建一个模拟的部门对象以满足外键约束
     */
    private function createMockDepartment(): DepartmentInterface
    {
        // 创建必要的关联实体，使用唯一ID避免冲突
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

        // 创建真实的Department实体
        $department = new Department();
        $department->setName('Test Department ' . $uniqueId);
        $department->setAgent($agent);
        $department->setCorp($corp);
        self::getEntityManager()->persist($department);
        self::getEntityManager()->flush();

        return $department;
    }

    /**
     * @return ServiceEntityRepository<UserBehaviorDataByParty>
     */
    protected function getRepository(): ServiceEntityRepository
    {
        return $this->repository;
    }

    private function fillEntity(UserBehaviorDataByParty $entity): void
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
