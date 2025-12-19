<?php

namespace WechatWorkExternalContactStatsBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Tourze\PHPUnitSymfonyKernelTest\Attribute\AsRepository;
use WechatWorkExternalContactStatsBundle\Entity\UserBehaviorDataByUser;

/**
 * @extends ServiceEntityRepository<UserBehaviorDataByUser>
 */
#[AsRepository(entityClass: UserBehaviorDataByUser::class)]
final class UserBehaviorDataByUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserBehaviorDataByUser::class);
    }

    public function save(UserBehaviorDataByUser $entity, bool $flush = true): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserBehaviorDataByUser $entity, bool $flush = true): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
