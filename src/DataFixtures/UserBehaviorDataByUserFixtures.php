<?php

declare(strict_types=1);

namespace WechatWorkExternalContactStatsBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use WechatWorkBundle\Entity\Agent;
use WechatWorkBundle\Entity\Corp;
use WechatWorkExternalContactStatsBundle\Entity\UserBehaviorDataByUser;
use WechatWorkStaffBundle\Entity\User;

final class UserBehaviorDataByUserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $corp = new Corp();
        $corp->setName('Test Corp for User Behavior By User');
        $corp->setCorpId('behavior_user_corp_' . uniqid());
        $corp->setCorpSecret('test_corp_secret');
        $manager->persist($corp);

        $agent = new Agent();
        $agent->setName('Behavior User Test Agent');
        $agent->setAgentId('behavior_user_agent_' . uniqid());
        $agent->setSecret('test_agent_secret');
        $agent->setCorp($corp);
        $manager->persist($agent);

        $user = new User();
        $user->setUserId('behavior_test_user_' . uniqid());
        $user->setName('Behavior Test User');
        $user->setAgent($agent);
        $user->setCorp($corp);
        $manager->persist($user);

        for ($i = 1; $i <= 3; ++$i) {
            $entity = new UserBehaviorDataByUser();
            $entity->setDate(new \DateTimeImmutable("2024-01-0{$i}"));
            $entity->setUser($user);
            $entity->setNewApplyCount(10 * $i);
            $entity->setNewContactCount(5 * $i);
            $entity->setChatCount(20 * $i);
            $entity->setMessageCount(100 * $i);
            $entity->setReplyPercentage(0.85);
            $entity->setAvgReplyTime(30 + $i);
            $entity->setNegativeFeedbackCount($i);
            $manager->persist($entity);
        }

        $manager->flush();
    }
}
