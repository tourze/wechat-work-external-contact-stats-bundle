<?php

namespace WechatWorkExternalContactStatsBundle\Tests\Integration\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;
use WechatWorkExternalContactStatsBundle\Entity\UserBehaviorDataByParty;
use WechatWorkExternalContactStatsBundle\Repository\UserBehaviorDataByPartyRepository;

/**
 * UserBehaviorDataByPartyRepository 测试
 */
class UserBehaviorDataByPartyRepositoryTest extends TestCase
{
    public function test_inheritance(): void
    {
        $registry = $this->createMock(ManagerRegistry::class);
        $repository = new UserBehaviorDataByPartyRepository($registry);
        
        $this->assertInstanceOf(ServiceEntityRepository::class, $repository);
    }

    public function test_constructor(): void
    {
        $registry = $this->createMock(ManagerRegistry::class);
        $repository = new UserBehaviorDataByPartyRepository($registry);
        
        // 测试构造函数正常执行
        $this->assertInstanceOf(UserBehaviorDataByPartyRepository::class, $repository);
    }
}