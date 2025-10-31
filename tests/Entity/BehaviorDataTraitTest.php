<?php

namespace WechatWorkExternalContactStatsBundle\Tests\Entity;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use WechatWorkExternalContactStatsBundle\Entity\BehaviorDataTrait;

/**
 * BehaviorDataTrait 测试用例
 *
 * 测试行为数据特性的所有数据访问器方法
 *
 * @internal
 */
#[CoversClass(BehaviorDataTrait::class)]
final class BehaviorDataTraitTest extends TestCase
{
    private TestableTraitUser $traitObject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->traitObject = new TestableTraitUser();
    }

    public function testSetDateWithValidDateSetsDateCorrectly(): void
    {
        $date = new \DateTimeImmutable('2024-01-15');

        $this->traitObject->setDate($date);

        $this->assertSame($date, $this->traitObject->getDate());
    }

    public function testGetDateInitiallyReturnsNull(): void
    {
        $this->assertNull($this->traitObject->getDate());
    }

    public function testSetNewApplyCountWithValidIntegerSetsCountCorrectly(): void
    {
        $count = 42;

        $this->traitObject->setNewApplyCount($count);

        $this->assertSame($count, $this->traitObject->getNewApplyCount());
    }

    public function testSetNewApplyCountWithNullSetsNull(): void
    {
        $this->traitObject->setNewApplyCount(100);

        $this->traitObject->setNewApplyCount(null);

        $this->assertNull($this->traitObject->getNewApplyCount());
    }

    public function testSetNewApplyCountWithZeroSetsZero(): void
    {
        $this->traitObject->setNewApplyCount(0);

        $this->assertSame(0, $this->traitObject->getNewApplyCount());
    }

    public function testSetNewApplyCountWithNegativeValueSetsNegativeValue(): void
    {
        $this->traitObject->setNewApplyCount(-5);

        $this->assertSame(-5, $this->traitObject->getNewApplyCount());
    }

    public function testGetNewApplyCountInitiallyReturnsNull(): void
    {
        $this->assertNull($this->traitObject->getNewApplyCount());
    }

    public function testSetNewContactCountWithValidIntegerSetsCountCorrectly(): void
    {
        $count = 25;

        $this->traitObject->setNewContactCount($count);

        $this->assertSame($count, $this->traitObject->getNewContactCount());
    }

    public function testSetNewContactCountWithNullSetsNull(): void
    {
        $this->traitObject->setNewContactCount(50);

        $this->traitObject->setNewContactCount(null);

        $this->assertNull($this->traitObject->getNewContactCount());
    }

    public function testGetNewContactCountInitiallyReturnsNull(): void
    {
        $this->assertNull($this->traitObject->getNewContactCount());
    }

    public function testSetChatCountWithValidIntegerSetsCountCorrectly(): void
    {
        $count = 150;

        $this->traitObject->setChatCount($count);

        $this->assertSame($count, $this->traitObject->getChatCount());
    }

    public function testSetChatCountWithNullSetsNull(): void
    {
        $this->traitObject->setChatCount(75);

        $this->traitObject->setChatCount(null);

        $this->assertNull($this->traitObject->getChatCount());
    }

    public function testGetChatCountInitiallyReturnsNull(): void
    {
        $this->assertNull($this->traitObject->getChatCount());
    }

    public function testSetMessageCountWithValidIntegerSetsCountCorrectly(): void
    {
        $count = 500;

        $this->traitObject->setMessageCount($count);

        $this->assertSame($count, $this->traitObject->getMessageCount());
    }

    public function testSetMessageCountWithNullSetsNull(): void
    {
        $this->traitObject->setMessageCount(300);

        $this->traitObject->setMessageCount(null);

        $this->assertNull($this->traitObject->getMessageCount());
    }

    public function testGetMessageCountInitiallyReturnsNull(): void
    {
        $this->assertNull($this->traitObject->getMessageCount());
    }

    public function testSetReplyPercentageWithValidFloatSetsPercentageCorrectly(): void
    {
        $percentage = 85.5;

        $this->traitObject->setReplyPercentage($percentage);

        $this->assertSame($percentage, $this->traitObject->getReplyPercentage());
    }

    public function testSetReplyPercentageWithNullSetsNull(): void
    {
        $this->traitObject->setReplyPercentage(90.0);

        $this->traitObject->setReplyPercentage(null);

        $this->assertNull($this->traitObject->getReplyPercentage());
    }

    public function testSetReplyPercentageWithZeroSetsZero(): void
    {
        $this->traitObject->setReplyPercentage(0.0);

        $this->assertSame(0.0, $this->traitObject->getReplyPercentage());
    }

    public function testSetReplyPercentageWithMaxPercentageSetsMaxPercentage(): void
    {
        $this->traitObject->setReplyPercentage(100.0);

        $this->assertSame(100.0, $this->traitObject->getReplyPercentage());
    }

    public function testGetReplyPercentageInitiallyReturnsNull(): void
    {
        $this->assertNull($this->traitObject->getReplyPercentage());
    }

    public function testSetAvgReplyTimeWithValidIntegerSetsTimeCorrectly(): void
    {
        $time = 45; // 45分钟

        $this->traitObject->setAvgReplyTime($time);

        $this->assertSame($time, $this->traitObject->getAvgReplyTime());
    }

    public function testSetAvgReplyTimeWithNullSetsNull(): void
    {
        $this->traitObject->setAvgReplyTime(30);

        $this->traitObject->setAvgReplyTime(null);

        $this->assertNull($this->traitObject->getAvgReplyTime());
    }

    public function testSetAvgReplyTimeWithZeroSetsZero(): void
    {
        $this->traitObject->setAvgReplyTime(0);

        $this->assertSame(0, $this->traitObject->getAvgReplyTime());
    }

    public function testGetAvgReplyTimeInitiallyReturnsNull(): void
    {
        $this->assertNull($this->traitObject->getAvgReplyTime());
    }

    public function testSetNegativeFeedbackCountWithValidIntegerSetsCountCorrectly(): void
    {
        $count = 3;

        $this->traitObject->setNegativeFeedbackCount($count);

        $this->assertSame($count, $this->traitObject->getNegativeFeedbackCount());
    }

    public function testSetNegativeFeedbackCountWithNullSetsNull(): void
    {
        $this->traitObject->setNegativeFeedbackCount(5);

        $this->traitObject->setNegativeFeedbackCount(null);

        $this->assertNull($this->traitObject->getNegativeFeedbackCount());
    }

    public function testSetNegativeFeedbackCountWithZeroSetsZero(): void
    {
        $this->traitObject->setNegativeFeedbackCount(0);

        $this->assertSame(0, $this->traitObject->getNegativeFeedbackCount());
    }

    public function testGetNegativeFeedbackCountInitiallyReturnsNull(): void
    {
        $this->assertNull($this->traitObject->getNegativeFeedbackCount());
    }

    /**
     * 测试所有字段设置后的值正确性
     */
    public function testAllFieldsCanBeSetAndRetrieved(): void
    {
        $date = new \DateTimeImmutable('2024-01-01');

        $this->traitObject->setDate($date);
        $this->traitObject->setNewApplyCount(10);
        $this->traitObject->setNewContactCount(5);
        $this->traitObject->setChatCount(20);
        $this->traitObject->setMessageCount(100);
        $this->traitObject->setReplyPercentage(80.5);
        $this->traitObject->setAvgReplyTime(30);
        $this->traitObject->setNegativeFeedbackCount(2);

        $this->assertSame($date, $this->traitObject->getDate());
        $this->assertSame(10, $this->traitObject->getNewApplyCount());
        $this->assertSame(5, $this->traitObject->getNewContactCount());
        $this->assertSame(20, $this->traitObject->getChatCount());
        $this->assertSame(100, $this->traitObject->getMessageCount());
        $this->assertSame(80.5, $this->traitObject->getReplyPercentage());
        $this->assertSame(30, $this->traitObject->getAvgReplyTime());
        $this->assertSame(2, $this->traitObject->getNegativeFeedbackCount());
    }

    /**
     * 测试边界值情况
     */
    public function testBoundaryValuesAreHandledCorrectly(): void
    {
        // 测试最大整数值
        $maxInt = PHP_INT_MAX;
        $this->traitObject->setNewApplyCount($maxInt);
        $this->assertSame($maxInt, $this->traitObject->getNewApplyCount());

        // 测试最小整数值
        $minInt = PHP_INT_MIN;
        $this->traitObject->setNewContactCount($minInt);
        $this->assertSame($minInt, $this->traitObject->getNewContactCount());

        // 测试极小浮点数
        $smallFloat = 0.0001;
        $this->traitObject->setReplyPercentage($smallFloat);
        $this->assertSame($smallFloat, $this->traitObject->getReplyPercentage());

        // 测试极大浮点数
        $largeFloat = 999999.9999;
        $this->traitObject->setReplyPercentage($largeFloat);
        $this->assertSame($largeFloat, $this->traitObject->getReplyPercentage());
    }

    /**
     * 测试DateTimeInterface的各种实现
     */
    public function testSetDateWithDifferentDateTimeImplementations(): void
    {
        // 测试DateTime
        $dateTime = new \DateTimeImmutable('2024-01-15 12:30:45');
        $this->traitObject->setDate($dateTime);
        $this->assertSame($dateTime, $this->traitObject->getDate());

        // 测试DateTimeImmutable
        $dateTimeImmutable = new \DateTimeImmutable('2024-02-20 09:15:30');
        $this->traitObject->setDate($dateTimeImmutable);
        $this->assertSame($dateTimeImmutable, $this->traitObject->getDate());
    }
}
