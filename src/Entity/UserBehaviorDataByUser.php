<?php

namespace WechatWorkExternalContactStatsBundle\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Tourze\DoctrineTimestampBundle\Traits\TimestampableAware;
use Tourze\EasyAdmin\Attribute\Action\Exportable;
use Tourze\EasyAdmin\Attribute\Column\ExportColumn;
use Tourze\EasyAdmin\Attribute\Column\ListColumn;
use Tourze\EasyAdmin\Attribute\Permission\AsPermission;
use Tourze\WechatWorkContracts\UserInterface;
use WechatWorkExternalContactStatsBundle\Repository\UserBehaviorDataByUserRepository;

/**
 * @see https://developer.work.weixin.qq.com/document/path/92132
 */
#[AsPermission(title: '联系客户统计数据x单用户')]
#[Exportable]
#[ORM\Entity(repositoryClass: UserBehaviorDataByUserRepository::class)]
#[ORM\Table(name: 'wechat_work_behavior_data_by_user', options: ['comment' => '联系客户统计数据x单用户'])]
class UserBehaviorDataByUser
{
    use TimestampableAware;
    use BehaviorDataTrait;

    #[ListColumn(order: -1)]
    #[ExportColumn]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER, options: ['comment' => 'ID'])]
    private ?int $id = 0;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?UserInterface $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    public function setUser(?UserInterface $user): static
    {
        $this->user = $user;

        return $this;
    }}
