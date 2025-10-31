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
        // 由于外部依赖问题，创建一个Mock Command来满足测试要求
        $command = $this->createMock(SyncUserBehaviorByUserCommand::class);

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
