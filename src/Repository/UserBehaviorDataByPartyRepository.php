<?php

namespace WechatWorkExternalContactStatsBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Tourze\PHPUnitSymfonyKernelTest\Attribute\AsRepository;
use WechatWorkExternalContactStatsBundle\Entity\UserBehaviorDataByParty;

/**
 * @extends ServiceEntityRepository<UserBehaviorDataByParty>
 */
#[AsRepository(entityClass: UserBehaviorDataByParty::class)]
final class UserBehaviorDataByPartyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserBehaviorDataByParty::class);
    }

    public function save(UserBehaviorDataByParty $entity, bool $flush = true): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserBehaviorDataByParty $entity, bool $flush = true): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
