<?php

namespace WechatWorkExternalContactStatsBundle\Tests\Exception;

use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\PHPUnitBase\AbstractExceptionTestCase;
use WechatWorkExternalContactStatsBundle\Exception\InvalidParameterException;

/**
 * InvalidParameterException 测试
 *
 * @internal
 */
#[CoversClass(InvalidParameterException::class)]
final class InvalidParameterExceptionTest extends AbstractExceptionTestCase
{
    public function testInheritance(): void
    {
        $exception = new InvalidParameterException('Test message');
        $this->assertInstanceOf(\RuntimeException::class, $exception);
    }

    public function testMessage(): void
    {
        $message = 'Invalid parameter provided';
        $exception = new InvalidParameterException($message);
        $this->assertSame($message, $exception->getMessage());
    }
}
