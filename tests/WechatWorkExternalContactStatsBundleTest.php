<?php

declare(strict_types=1);

namespace WechatWorkExternalContactStatsBundle\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\PHPUnitSymfonyKernelTest\AbstractBundleTestCase;
use WechatWorkExternalContactStatsBundle\WechatWorkExternalContactStatsBundle;

/**
 * @internal
 */
#[CoversClass(WechatWorkExternalContactStatsBundle::class)]
#[RunTestsInSeparateProcesses]
final class WechatWorkExternalContactStatsBundleTest extends AbstractBundleTestCase
{
}
