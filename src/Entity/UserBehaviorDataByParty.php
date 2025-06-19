<?php

namespace WechatWorkExternalContactStatsBundle\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Tourze\DoctrineTimestampBundle\Traits\TimestampableAware;
use Tourze\EasyAdmin\Attribute\Action\Exportable;
use Tourze\WechatWorkContracts\DepartmentInterface;
use WechatWorkExternalContactStatsBundle\Repository\UserBehaviorDataByPartyRepository;

/**
 * @see https://developer.work.weixin.qq.com/document/path/92132
 */
#[Exportable]
#[ORM\Entity(repositoryClass: UserBehaviorDataByPartyRepository::class)]
#[ORM\Table(name: 'wechat_work_behavior_data_by_party', options: ['comment' => '联系客户统计数据x单部门'])]
class UserBehaviorDataByParty implements \Stringable
{
    use TimestampableAware;
    use BehaviorDataTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER, options: ['comment' => 'ID'])]
    private ?int $id = 0;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?DepartmentInterface $party = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParty(): ?DepartmentInterface
    {
        return $this->party;
    }

    public function setParty(?DepartmentInterface $party): static
    {
        $this->party = $party;

        return $this;
    }
    public function __toString(): string
    {
        return (string) $this->getId();
    }
}
