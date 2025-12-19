<?php

namespace WechatWorkExternalContactStatsBundle\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Tourze\DoctrineTimestampBundle\Traits\TimestampableAware;
use Tourze\WechatWorkContracts\UserInterface;
use WechatWorkExternalContactStatsBundle\Repository\UserBehaviorDataByUserRepository;

/**
 * @see https://developer.work.weixin.qq.com/document/path/92132
 */
#[ORM\Entity(repositoryClass: UserBehaviorDataByUserRepository::class)]
#[ORM\Table(name: 'wechat_work_behavior_data_by_user', options: ['comment' => '联系客户统计数据x单用户'])]
class UserBehaviorDataByUser implements \Stringable
{
    use TimestampableAware;
    use BehaviorDataTrait;

    /**
     * @var int 主键ID
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER, options: ['comment' => 'ID'])]
    private int $id = 0;

    /**
     * @var UserInterface|null 员工用户
     */
    #[ORM\ManyToOne(targetEntity: UserInterface::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?UserInterface $user = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    public function setUser(?UserInterface $user): void
    {
        $this->user = $user;
    }

    public function __toString(): string
    {
        return (string) $this->getId();
    }
}
