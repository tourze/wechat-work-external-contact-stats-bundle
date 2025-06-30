<?php

namespace WechatWorkExternalContactStatsBundle\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use WechatWorkExternalContactStatsBundle\WechatWorkExternalContactStatsBundle;

/**
 * WechatWorkExternalContactStatsBundle 测试
 */
class WechatWorkExternalContactStatsBundleTest extends TestCase
{
    public function test_inheritance(): void
    {
        $bundle = new WechatWorkExternalContactStatsBundle();
        $this->assertInstanceOf(Bundle::class, $bundle);
    }

    public function test_getName(): void
    {
        $bundle = new WechatWorkExternalContactStatsBundle();
        $this->assertSame('WechatWorkExternalContactStatsBundle', $bundle->getName());
    }
}