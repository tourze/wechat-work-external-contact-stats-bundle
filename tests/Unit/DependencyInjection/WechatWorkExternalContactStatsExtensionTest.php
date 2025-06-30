<?php

namespace WechatWorkExternalContactStatsBundle\Tests\Unit\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use WechatWorkExternalContactStatsBundle\DependencyInjection\WechatWorkExternalContactStatsExtension;

/**
 * WechatWorkExternalContactStatsExtension 测试
 */
class WechatWorkExternalContactStatsExtensionTest extends TestCase
{
    private WechatWorkExternalContactStatsExtension $extension;
    private ContainerBuilder $container;

    protected function setUp(): void
    {
        $this->extension = new WechatWorkExternalContactStatsExtension();
        $this->container = new ContainerBuilder();
    }

    public function test_inheritance(): void
    {
        $this->assertInstanceOf(Extension::class, $this->extension);
    }

    public function test_load(): void
    {
        $configs = [];
        $this->extension->load($configs, $this->container);
        
        // 测试扩展加载后容器是否有定义
        $this->assertTrue($this->container->hasDefinition('WechatWorkExternalContactStatsBundle\Repository\UserBehaviorDataByPartyRepository'));
        $this->assertTrue($this->container->hasDefinition('WechatWorkExternalContactStatsBundle\Repository\UserBehaviorDataByUserRepository'));
    }
}