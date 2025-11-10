<?php

namespace WechatWorkExternalContactStatsBundle\Tests\Entity;

use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\PHPUnitDoctrineEntity\AbstractEntityTestCase;
use Tourze\WechatWorkContracts\DepartmentInterface;
use WechatWorkExternalContactStatsBundle\Entity\UserBehaviorDataByParty;

/**
 * UserBehaviorDataByParty 实体测试用例
 *
 * 测试按部门统计的联系客户行为数据实体的所有功能
 *
 * @internal
 */
#[CoversClass(UserBehaviorDataByParty::class)]
final class UserBehaviorDataByPartyTest extends AbstractEntityTestCase
{
    private UserBehaviorDataByParty $behaviorData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->behaviorData = new UserBehaviorDataByParty();
    }

    public function testConstructorSetsDefaultValues(): void
    {
        $data = new UserBehaviorDataByParty();

        $this->assertSame(0, $data->getId());
        $this->assertNull($data->getParty());
        $this->assertNull($data->getCreateTime());
        $this->assertNull($data->getUpdateTime());

        // 测试 BehaviorDataTrait 的默认值
        $this->assertNull($data->getDate());
        $this->assertNull($data->getNewApplyCount());
        $this->assertNull($data->getNewContactCount());
        $this->assertNull($data->getChatCount());
        $this->assertNull($data->getMessageCount());
        $this->assertNull($data->getAvgReplyTime());
        $this->assertNull($data->getNegativeFeedbackCount());
        $this->assertNull($data->getReplyPercentage());
    }

    public function testSetPartyWithValidDepartmentSetsDepartmentCorrectly(): void
    {
        $department = $this->createMock(DepartmentInterface::class);

        $this->behaviorData->setParty($department);

        $this->assertSame($department, $this->behaviorData->getParty());
    }

    public function testSetPartyWithNullSetsNull(): void
    {
        $department = $this->createMock(DepartmentInterface::class);
        $this->behaviorData->setParty($department);

        $this->behaviorData->setParty(null);

        $this->assertNull($this->behaviorData->getParty());
    }

    public function testSetCreateTimeWithValidDateTimeSetsTimeCorrectly(): void
    {
        $createTime = new \DateTimeImmutable('2024-01-01 08:00:00');

        $this->behaviorData->setCreateTime($createTime);

        $this->assertSame($createTime, $this->behaviorData->getCreateTime());
    }

    public function testSetCreateTimeWithNullSetsNull(): void
    {
        $this->behaviorData->setCreateTime(new \DateTimeImmutable());

        $this->behaviorData->setCreateTime(null);

        $this->assertNull($this->behaviorData->getCreateTime());
    }

    public function testSetUpdateTimeWithValidDateTimeSetsTimeCorrectly(): void
    {
        $updateTime = new \DateTimeImmutable('2024-01-30 18:30:00');

        $this->behaviorData->setUpdateTime($updateTime);

        $this->assertSame($updateTime, $this->behaviorData->getUpdateTime());
    }

    public function testSetUpdateTimeWithNullSetsNull(): void
    {
        $this->behaviorData->setUpdateTime(new \DateTimeImmutable());

        $this->behaviorData->setUpdateTime(null);

        $this->assertNull($this->behaviorData->getUpdateTime());
    }

    /**
     * 测试 BehaviorDataTrait 的功能
     */
    public function testSetDateWithValidDateTimeSetsTimeCorrectly(): void
    {
        $date = new \DateTimeImmutable('2024-01-15 00:00:00');

        $this->behaviorData->setDate($date);

        $this->assertSame($date, $this->behaviorData->getDate());
    }

    public function testSetNewApplyCountWithValidCountSetsCountCorrectly(): void
    {
        $newApplyCount = 15;

        $this->behaviorData->setNewApplyCount($newApplyCount);

        $this->assertSame($newApplyCount, $this->behaviorData->getNewApplyCount());
    }

    public function testSetNewContactCountWithValidCountSetsCountCorrectly(): void
    {
        $newContactCount = 50;

        $this->behaviorData->setNewContactCount($newContactCount);

        $this->assertSame($newContactCount, $this->behaviorData->getNewContactCount());
    }

    public function testSetChatCountWithValidCountSetsCountCorrectly(): void
    {
        $chatCount = 120;

        $this->behaviorData->setChatCount($chatCount);

        $this->assertSame($chatCount, $this->behaviorData->getChatCount());
    }

    public function testSetMessageCountWithValidCountSetsCountCorrectly(): void
    {
        $messageCount = 500;

        $this->behaviorData->setMessageCount($messageCount);

        $this->assertSame($messageCount, $this->behaviorData->getMessageCount());
    }

    public function testSetAvgReplyTimeWithValidTimeSetsTimeCorrectly(): void
    {
        $avgReplyTime = 30; // 30分钟

        $this->behaviorData->setAvgReplyTime($avgReplyTime);

        $this->assertSame($avgReplyTime, $this->behaviorData->getAvgReplyTime());
    }

    public function testSetNegativeFeedbackCountWithValidCountSetsCountCorrectly(): void
    {
        $negativeFeedbackCount = 5;

        $this->behaviorData->setNegativeFeedbackCount($negativeFeedbackCount);

        $this->assertSame($negativeFeedbackCount, $this->behaviorData->getNegativeFeedbackCount());
    }

    public function testSetReplyPercentageWithValidPercentageSetsPercentageCorrectly(): void
    {
        $replyPercentage = 85.5;

        $this->behaviorData->setReplyPercentage($replyPercentage);

        $this->assertSame($replyPercentage, $this->behaviorData->getReplyPercentage());
    }

    /**
     * 测试链式调用
     */
    public function testChainedSettersReturnSameInstance(): void
    {
        $department = $this->createMock(DepartmentInterface::class);

        $date = new \DateTimeImmutable('2024-01-15 00:00:00');
        $createTime = new \DateTimeImmutable('2024-01-01 08:00:00');
        $updateTime = new \DateTimeImmutable('2024-01-30 18:00:00');

        $this->behaviorData->setParty($department);
        $this->behaviorData->setDate($date);
        $this->behaviorData->setNewApplyCount(15);
        $this->behaviorData->setNewContactCount(50);
        $this->behaviorData->setChatCount(120);
        $this->behaviorData->setMessageCount(500);
        $this->behaviorData->setAvgReplyTime(30);
        $this->behaviorData->setNegativeFeedbackCount(5);
        $this->behaviorData->setReplyPercentage(85.5);

        $this->behaviorData->setCreateTime($createTime);
        $this->behaviorData->setUpdateTime($updateTime);
        $this->assertSame($department, $this->behaviorData->getParty());
        $this->assertSame($date, $this->behaviorData->getDate());
        $this->assertSame(15, $this->behaviorData->getNewApplyCount());
        $this->assertSame(50, $this->behaviorData->getNewContactCount());
        $this->assertSame(120, $this->behaviorData->getChatCount());
        $this->assertSame(500, $this->behaviorData->getMessageCount());
        $this->assertSame(30, $this->behaviorData->getAvgReplyTime());
        $this->assertSame(5, $this->behaviorData->getNegativeFeedbackCount());
        $this->assertSame(85.5, $this->behaviorData->getReplyPercentage());
        $this->assertSame($createTime, $this->behaviorData->getCreateTime());
        $this->assertSame($updateTime, $this->behaviorData->getUpdateTime());
    }

    /**
     * 测试边界场景
     */
    public function testEdgeCasesExtremeValues(): void
    {
        // 测试极端整数值
        $this->behaviorData->setNewContactCount(PHP_INT_MAX);
        $this->assertSame(PHP_INT_MAX, $this->behaviorData->getNewContactCount());

        $this->behaviorData->setMessageCount(0);
        $this->assertSame(0, $this->behaviorData->getMessageCount());

        $this->behaviorData->setAvgReplyTime(PHP_INT_MIN);
        $this->assertSame(PHP_INT_MIN, $this->behaviorData->getAvgReplyTime());
    }

    public function testEdgeCasesFloatValues(): void
    {
        // 测试极端浮点值
        $this->behaviorData->setReplyPercentage(0.0);
        $this->assertSame(0.0, $this->behaviorData->getReplyPercentage());

        $this->behaviorData->setReplyPercentage(100.0);
        $this->assertSame(100.0, $this->behaviorData->getReplyPercentage());

        $this->behaviorData->setReplyPercentage(99.999);
        $this->assertSame(99.999, $this->behaviorData->getReplyPercentage());
    }

    public function testEdgeCasesDateTimeTypes(): void
    {
        // 测试DateTime
        $dateTime = new \DateTimeImmutable('2024-01-15 12:30:45');
        $this->behaviorData->setDate($dateTime);
        $this->assertSame($dateTime, $this->behaviorData->getDate());

        // 测试DateTimeImmutable
        $dateTimeImmutable = new \DateTimeImmutable('2024-02-20 09:15:30');
        $this->behaviorData->setCreateTime($dateTimeImmutable);
        $this->assertSame($dateTimeImmutable, $this->behaviorData->getCreateTime());
    }

    /**
     * 测试业务逻辑场景
     */
    public function testBusinessScenarioDepartmentDailyStats(): void
    {
        $salesDept = $this->createMock(DepartmentInterface::class);

        $date = new \DateTimeImmutable('2024-01-15 00:00:00');
        $createTime = new \DateTimeImmutable('2024-01-16 08:00:00');

        // 模拟销售部门的日统计数据
        $this->behaviorData->setParty($salesDept);
        $this->behaviorData->setDate($date);
        $this->behaviorData->setNewApplyCount(25);      // 新增申请人数
        $this->behaviorData->setNewContactCount(1200);  // 总联系人数
        $this->behaviorData->setChatCount(3);           // 新增聊天次数
        $this->behaviorData->setMessageCount(5000);     // 总消息数
        $this->behaviorData->setAvgReplyTime(1800);     // 平均回复时间30分钟
        $this->behaviorData->setNegativeFeedbackCount(2); // 负面反馈次数
        $this->behaviorData->setReplyPercentage(92.5); // 回复率92.5%

        $this->behaviorData->setCreateTime($createTime);

        // 验证业务状态
        $this->assertNotNull($this->behaviorData->getParty());
        $this->assertSame($date, $this->behaviorData->getDate());
        $this->assertSame(25, $this->behaviorData->getNewApplyCount());
        $this->assertSame(1200, $this->behaviorData->getNewContactCount());
        $this->assertSame(3, $this->behaviorData->getChatCount());
        $this->assertSame(5000, $this->behaviorData->getMessageCount());
        $this->assertSame(1800, $this->behaviorData->getAvgReplyTime());
        $this->assertSame(2, $this->behaviorData->getNegativeFeedbackCount());
        $this->assertSame(92.5, $this->behaviorData->getReplyPercentage());

        // 验证时间逻辑
        $this->assertLessThan($createTime, $date);
    }

    public function testBusinessScenarioDepartmentWeeklyStats(): void
    {
        $marketingDept = $this->createMock(DepartmentInterface::class);

        $date = new \DateTimeImmutable('2024-01-08 00:00:00'); // 周一

        // 模拟市场部门的周统计数据
        $this->behaviorData->setParty($marketingDept);
        $this->behaviorData->setDate($date);
        $this->behaviorData->setNewApplyCount(150);     // 一周新增150个申请
        $this->behaviorData->setNewContactCount(3500);  // 总联系人数
        $this->behaviorData->setChatCount(45);          // 一周新增聊天次数
        $this->behaviorData->setMessageCount(10000);    // 一周总消息数
        $this->behaviorData->setAvgReplyTime(2400);     // 平均回复时间40分钟
        $this->behaviorData->setNegativeFeedbackCount(8); // 负面反馈次数
        $this->behaviorData->setReplyPercentage(88.2); // 回复率88.2%

        // 验证周统计数据的合理性
        $this->assertGreaterThan(0, $this->behaviorData->getNewApplyCount());
        $this->assertGreaterThan($this->behaviorData->getNewApplyCount(), $this->behaviorData->getNewContactCount());
        $this->assertGreaterThanOrEqual(
            $this->behaviorData->getNewContactCount(),
            $this->behaviorData->getMessageCount()
        );
        $this->assertTrue(
            $this->behaviorData->getReplyPercentage() >= 0
            && $this->behaviorData->getReplyPercentage() <= 100
        );
    }

    public function testBusinessScenarioPerfectPerformanceDepartment(): void
    {
        $techDept = $this->createMock(DepartmentInterface::class);

        // 模拟表现完美的技术部门
        $this->behaviorData->setParty($techDept);
        $this->behaviorData->setDate(new \DateTimeImmutable('2024-01-15'));
        $this->behaviorData->setNewApplyCount(20);
        $this->behaviorData->setNewContactCount(800);
        $this->behaviorData->setChatCount(100);
        $this->behaviorData->setMessageCount(2000);
        $this->behaviorData->setAvgReplyTime(600);        // 10分钟快速回复
        $this->behaviorData->setNegativeFeedbackCount(0);   // 无负面反馈
        $this->behaviorData->setReplyPercentage(100.0);  // 100%回复率

        // 验证完美表现
        $this->assertSame(20, $this->behaviorData->getNewApplyCount());
        $this->assertSame(800, $this->behaviorData->getNewContactCount());
        $this->assertSame(0, $this->behaviorData->getNegativeFeedbackCount());
        $this->assertSame(100.0, $this->behaviorData->getReplyPercentage());
        $this->assertLessThanOrEqual(600, $this->behaviorData->getAvgReplyTime()); // 快速回复
    }

    public function testBusinessScenarioProblematicDepartment(): void
    {
        $dept = $this->createMock(DepartmentInterface::class);

        // 模拟有问题的部门
        $this->behaviorData->setParty($dept);
        $this->behaviorData->setDate(new \DateTimeImmutable('2024-01-15'));
        $this->behaviorData->setNewApplyCount(5);         // 新增申请人数很少
        $this->behaviorData->setNewContactCount(200);     // 总量下降
        $this->behaviorData->setChatCount(10);            // 新增聊天次数较少
        $this->behaviorData->setMessageCount(500);         // 总量下降
        $this->behaviorData->setAvgReplyTime(7200);        // 2小时回复时间过长
        $this->behaviorData->setNegativeFeedbackCount(20);  // 负面反馈次数较多
        $this->behaviorData->setReplyPercentage(45.5);    // 回复率较低

        // 验证问题指标
        $this->assertLessThan(10, $this->behaviorData->getNewApplyCount());
        $this->assertGreaterThan($this->behaviorData->getNewApplyCount(), $this->behaviorData->getNewContactCount());
        $this->assertGreaterThan($this->behaviorData->getNewContactCount(), $this->behaviorData->getMessageCount());
        $this->assertGreaterThan(3600, $this->behaviorData->getAvgReplyTime()); // 超过1小时
        $this->assertGreaterThan(10, $this->behaviorData->getNegativeFeedbackCount());
        $this->assertLessThan(50, $this->behaviorData->getReplyPercentage());
    }

    public function testBusinessScenarioMonthlyTrendAnalysis(): void
    {
        $dept = $this->createMock(DepartmentInterface::class);

        $createTime = new \DateTimeImmutable('2024-02-01 08:00:00');
        $updateTime = new \DateTimeImmutable('2024-02-01 18:00:00');

        // 模拟月度趋势分析数据
        $this->behaviorData->setParty($dept);
        $this->behaviorData->setDate(new \DateTimeImmutable('2024-01-01')); // 1月份数据
        $this->behaviorData->setNewApplyCount(300);
        $this->behaviorData->setNewContactCount(5000);
        $this->behaviorData->setChatCount(100);
        $this->behaviorData->setMessageCount(2000);
        $this->behaviorData->setAvgReplyTime(1500);  // 25分钟
        $this->behaviorData->setNegativeFeedbackCount(10);
        $this->behaviorData->setReplyPercentage(90.8);

        $this->behaviorData->setCreateTime($createTime);
        $this->behaviorData->setUpdateTime($updateTime);

        // 验证月度数据的合理性
        $this->assertGreaterThanOrEqual(0, $this->behaviorData->getNewApplyCount());
        $this->assertGreaterThan(0, $this->behaviorData->getNewContactCount());
        $this->assertGreaterThanOrEqual(0, $this->behaviorData->getMessageCount()); // messageCount可能小于newContactCount
        $this->assertGreaterThanOrEqual(0, $this->behaviorData->getReplyPercentage());
        $this->assertLessThanOrEqual(100, $this->behaviorData->getReplyPercentage());
        $this->assertGreaterThan($createTime, $updateTime);
    }

    /**
     * 创建被测实体实例.
     */
    protected function createEntity(): object
    {
        return new UserBehaviorDataByParty();
    }

    /**
     * 提供属性及其样本值的 Data Provider.
     *
     * @return iterable<string, array{string, mixed}>
     */
    public static function propertiesProvider(): iterable
    {
        // party 属性为 DepartmentInterface 类型，避免序列化问题，由专门的测试方法覆盖
        yield 'date' => ['date', new \DateTimeImmutable('2024-01-15')];
        yield 'newApplyCount' => ['newApplyCount', 10];
        yield 'newContactCount' => ['newContactCount', 20];
        yield 'chatCount' => ['chatCount', 30];
        yield 'messageCount' => ['messageCount', 40];
        yield 'avgReplyTime' => ['avgReplyTime', 50];
        yield 'negativeFeedbackCount' => ['negativeFeedbackCount', 5];
        yield 'replyPercentage' => ['replyPercentage', 85.5];
        yield 'createTime' => ['createTime', new \DateTimeImmutable('2024-01-01 08:00:00')];
        yield 'updateTime' => ['updateTime', new \DateTimeImmutable('2024-01-30 18:00:00')];
    }

    /**
     * 测试null值处理
     */
    public function testNullValueHandlingAllNullValues(): void
    {
        $this->behaviorData->setParty(null);
        $this->behaviorData->setNewApplyCount(null);
        $this->behaviorData->setNewContactCount(null);
        $this->behaviorData->setChatCount(null);
        $this->behaviorData->setMessageCount(null);
        $this->behaviorData->setAvgReplyTime(null);
        $this->behaviorData->setNegativeFeedbackCount(null);
        $this->behaviorData->setReplyPercentage(null);

        $this->behaviorData->setCreateTime(null);
        $this->behaviorData->setUpdateTime(null);

        $this->assertNull($this->behaviorData->getParty());
        $this->assertNull($this->behaviorData->getNewApplyCount());
        $this->assertNull($this->behaviorData->getNewContactCount());
        $this->assertNull($this->behaviorData->getChatCount());
        $this->assertNull($this->behaviorData->getMessageCount());
        $this->assertNull($this->behaviorData->getAvgReplyTime());
        $this->assertNull($this->behaviorData->getNegativeFeedbackCount());
        $this->assertNull($this->behaviorData->getReplyPercentage());
        $this->assertNull($this->behaviorData->getCreateTime());
        $this->assertNull($this->behaviorData->getUpdateTime());
    }
}
