<?php

namespace WechatWorkExternalContactStatsBundle\Tests\Command;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Symfony\Component\Console\Tester\CommandTester;
use Tourze\PHPUnitSymfonyKernelTest\AbstractCommandTestCase;
use WechatWorkExternalContactStatsBundle\Command\SyncUserBehaviorByUserCommand;

/**
 * Command test - basic unit tests only due to external dependencies
 *
 * @internal
 */
#[RunTestsInSeparateProcesses]
#[CoversClass(SyncUserBehaviorByUserCommand::class)]
final class SyncUserBehaviorByUserCommandTest extends AbstractCommandTestCase
{
    protected function onSetUp(): void
    {
        // Command tests don't need additional setup
    }

    protected function getCommandTester(): CommandTester
    {
        // 从容器获取真实的 Command 实例，包含所有依赖
        /** @var SyncUserBehaviorByUserCommand $command */
        $command = self::getService(SyncUserBehaviorByUserCommand::class);

        return new CommandTester($command);
    }

    public function testCommandNameConstant(): void
    {
        $this->assertSame('wechat-work:sync-user-behavior-by-user', SyncUserBehaviorByUserCommand::NAME);
    }

    public function testCommandTester(): void
    {
        $tester = $this->getCommandTester();
        $this->assertInstanceOf(CommandTester::class, $tester);
    }
}
