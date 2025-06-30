<?php

namespace WechatWorkExternalContactStatsBundle\Tests\Unit\Exception;

use PHPUnit\Framework\TestCase;
use WechatWorkExternalContactStatsBundle\Exception\InvalidParameterException;

/**
 * InvalidParameterException 测试
 */
class InvalidParameterExceptionTest extends TestCase
{
    public function test_inheritance(): void
    {
        $exception = new InvalidParameterException('Test message');
        $this->assertInstanceOf(\RuntimeException::class, $exception);
    }

    public function test_message(): void
    {
        $message = 'Invalid parameter provided';
        $exception = new InvalidParameterException($message);
        $this->assertSame($message, $exception->getMessage());
    }
}