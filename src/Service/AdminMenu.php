<?php

declare(strict_types=1);

namespace WechatWorkExternalContactStatsBundle\Service;

use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Tourze\EasyAdminMenuBundle\Service\LinkGeneratorInterface;
use Tourze\EasyAdminMenuBundle\Service\MenuProviderInterface;
use WechatWorkExternalContactStatsBundle\Controller\Admin\UserBehaviorDataByPartyCrudController;
use WechatWorkExternalContactStatsBundle\Controller\Admin\UserBehaviorDataByUserCrudController;

/**
 * 企业微信外部联系人统计菜单提供者
 */
#[Autoconfigure(public: true)]
readonly class AdminMenu implements MenuProviderInterface
{
    public function __construct(
        private LinkGeneratorInterface $linkGenerator,
    ) {
    }

    public function __invoke(ItemInterface $item): void
    {
        $statsMenu = $item->addChild('企业微信联系人统计', [
            'uri' => '#',
            'attributes' => [
                'class' => 'has-submenu',
                'icon' => 'fas fa-chart-bar',
            ],
        ]);

        $statsMenu->addChild('用户行为数据', [
            'uri' => $this->linkGenerator->getCurdListPage(UserBehaviorDataByUserCrudController::class),
            'attributes' => [
                'icon' => 'fas fa-user-chart',
            ],
        ]);

        $statsMenu->addChild('部门行为数据', [
            'uri' => $this->linkGenerator->getCurdListPage(UserBehaviorDataByPartyCrudController::class),
            'attributes' => [
                'icon' => 'fas fa-users-gear',
            ],
        ]);
    }
}
