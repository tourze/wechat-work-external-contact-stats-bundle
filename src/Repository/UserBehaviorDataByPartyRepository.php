<?php

namespace WechatWorkExternalContactStatsBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use WechatWorkExternalContactStatsBundle\Entity\UserBehaviorDataByParty;

/**
 * @method UserBehaviorDataByParty|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserBehaviorDataByParty|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserBehaviorDataByParty[]    findAll()
 * @method UserBehaviorDataByParty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserBehaviorDataByPartyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserBehaviorDataByParty::class);
    }
}
