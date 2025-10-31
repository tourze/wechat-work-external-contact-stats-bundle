<?php

declare(strict_types=1);

namespace WechatWorkExternalContactStatsBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use WechatWorkBundle\Entity\Agent;
use WechatWorkBundle\Entity\Corp;
use WechatWorkExternalContactStatsBundle\Entity\UserBehaviorDataByParty;
use WechatWorkStaffBundle\Entity\Department;

final class UserBehaviorDataByPartyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $corp = new Corp();
        $corp->setName('Test Corp for User Behavior By Party');
        $corp->setCorpId('behavior_party_corp_' . uniqid());
        $corp->setCorpSecret('test_corp_secret');
        $manager->persist($corp);

        $agent = new Agent();
        $agent->setName('Behavior Party Test Agent');
        $agent->setAgentId('behavior_party_agent_' . uniqid());
        $agent->setSecret('test_agent_secret');
        $agent->setCorp($corp);
        $manager->persist($agent);

        $department = new Department();
        $department->setName('Behavior Test Department');
        $department->setAgent($agent);
        $department->setCorp($corp);
        $manager->persist($department);

        for ($i = 1; $i <= 3; ++$i) {
            $entity = new UserBehaviorDataByParty();
            $entity->setDate(new \DateTimeImmutable("2024-01-0{$i}"));
            $entity->setParty($department);
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
