<?php

declare(strict_types=1);

namespace WechatWorkExternalContactStatsBundle\Tests\Service;

use Knp\Menu\ItemInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\EasyAdminMenuBundle\Service\MenuProviderInterface;
use Tourze\PHPUnitSymfonyWebTest\AbstractEasyAdminMenuTestCase;
use WechatWorkExternalContactStatsBundle\Service\AdminMenu;

/**
 * @internal
 */
#[CoversClass(AdminMenu::class)]
#[RunTestsInSeparateProcesses]
class AdminMenuTest extends AbstractEasyAdminMenuTestCase
{
    protected function onSetUp(): void
    {
        // 实现抽象方法，但不需要特殊初始化
    }

    public function testImplementsMenuProviderInterface(): void
    {
        $adminMenu = self::getService(AdminMenu::class);

        $this->assertInstanceOf(MenuProviderInterface::class, $adminMenu);
    }

    public function testInstanceCreation(): void
    {
        $adminMenu = self::getService(AdminMenu::class);

        $this->assertNotNull($adminMenu);
        $this->assertInstanceOf(AdminMenu::class, $adminMenu);
    }

    public function testMenuItemsAreAdded(): void
    {
        $adminMenu = self::getService(AdminMenu::class);

        $mockItem = $this->createMock(ItemInterface::class);
        $mockSubMenu = $this->createMock(ItemInterface::class);

        $mockItem->expects($this->once())
            ->method('addChild')
            ->willReturn($mockSubMenu)
        ;

        $mockSubMenu->expects($this->exactly(2))
            ->method('addChild')
            ->willReturn($this->createMock(ItemInterface::class))
        ;

        $adminMenu->__invoke($mockItem);
    }
}
