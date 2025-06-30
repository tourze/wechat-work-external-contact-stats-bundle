<?php

namespace WechatWorkExternalContactStatsBundle\Tests\Integration\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;
use WechatWorkExternalContactStatsBundle\Entity\UserBehaviorDataByUser;
use WechatWorkExternalContactStatsBundle\Repository\UserBehaviorDataByUserRepository;

/**
 * UserBehaviorDataByUserRepository 测试
 */
class UserBehaviorDataByUserRepositoryTest extends TestCase
{
    public function test_inheritance(): void
    {
        $registry = $this->createMock(ManagerRegistry::class);
        $repository = new UserBehaviorDataByUserRepository($registry);
        
        $this->assertInstanceOf(ServiceEntityRepository::class, $repository);
    }

    public function test_constructor(): void
    {
        $registry = $this->createMock(ManagerRegistry::class);
        $repository = new UserBehaviorDataByUserRepository($registry);
        
        // 测试构造函数正常执行
        $this->assertInstanceOf(UserBehaviorDataByUserRepository::class, $repository);
    }
}