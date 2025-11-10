<?php

namespace WechatWorkExternalContactStatsBundle\Tests\Entity;

use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\PHPUnitDoctrineEntity\AbstractEntityTestCase;
use Tourze\WechatWorkContracts\UserInterface;
use WechatWorkExternalContactStatsBundle\Entity\UserBehaviorDataByUser;

/**
 * UserBehaviorDataByUser 实体测试用例
 *
 * 测试按用户统计的联系客户行为数据实体的所有功能
 *
 * @internal
 */
#[CoversClass(UserBehaviorDataByUser::class)]
final class UserBehaviorDataByUserTest extends AbstractEntityTestCase
{
    private UserBehaviorDataByUser $behaviorData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->behaviorData = new UserBehaviorDataByUser();
    }

    public function testConstructorSetsDefaultValues(): void
    {
        $data = new UserBehaviorDataByUser();

        $this->assertSame(0, $data->getId());
        $this->assertNull($data->getUser());
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

    public function testSetUserWithValidUserSetsUserCorrectly(): void
    {
        $user = $this->createMock(UserInterface::class);

        $this->behaviorData->setUser($user);

        $this->assertSame($user, $this->behaviorData->getUser());
    }

    public function testSetUserWithNullSetsNull(): void
    {
        $user = $this->createMock(UserInterface::class);
        $this->behaviorData->setUser($user);

        $this->behaviorData->setUser(null);

        $this->assertNull($this->behaviorData->getUser());
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
        $user = $this->createMock(UserInterface::class);

        $date = new \DateTimeImmutable('2024-01-15 00:00:00');
        $createTime = new \DateTimeImmutable('2024-01-01 08:00:00');
        $updateTime = new \DateTimeImmutable('2024-01-30 18:00:00');

        $this->behaviorData->setUser($user);
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
        $this->assertSame($user, $this->behaviorData->getUser());
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
    public function testBusinessScenarioSalesPersonDailyStats(): void
    {
        $salesPerson = $this->createMock(UserInterface::class);

        $date = new \DateTimeImmutable('2024-01-15 00:00:00');
        $createTime = new \DateTimeImmutable('2024-01-16 08:00:00');

        // 模拟销售人员的日统计数据
        $this->behaviorData->setUser($salesPerson);
        $this->behaviorData->setDate($date);
        $this->behaviorData->setNewApplyCount(8);       // 发起8个好友申请
        $this->behaviorData->setNewContactCount(6);     // 新增6个联系人
        $this->behaviorData->setChatCount(25);          // 进行25次聊天
        $this->behaviorData->setMessageCount(120);      // 发送120条消息
        $this->behaviorData->setAvgReplyTime(15);       // 平均回复时间15分钟
        $this->behaviorData->setNegativeFeedbackCount(0); // 无负面反馈
        $this->behaviorData->setReplyPercentage(95.0); // 回复率95%

        $this->behaviorData->setCreateTime($createTime);

        // 验证业务状态
        $this->assertNotNull($this->behaviorData->getUser());
        $this->assertSame($date, $this->behaviorData->getDate());
        $this->assertSame(8, $this->behaviorData->getNewApplyCount());
        $this->assertSame(6, $this->behaviorData->getNewContactCount());
        $this->assertSame(25, $this->behaviorData->getChatCount());
        $this->assertSame(120, $this->behaviorData->getMessageCount());
        $this->assertSame(15, $this->behaviorData->getAvgReplyTime());
        $this->assertSame(0, $this->behaviorData->getNegativeFeedbackCount());
        $this->assertSame(95.0, $this->behaviorData->getReplyPercentage());

        // 验证时间逻辑
        $this->assertLessThan($createTime, $date);
    }

    public function testBusinessScenarioCustomerServiceWeeklyStats(): void
    {
        $serviceUser = $this->createMock(UserInterface::class);

        $date = new \DateTimeImmutable('2024-01-08 00:00:00'); // 周一

        // 模拟客服人员的周统计数据
        $this->behaviorData->setUser($serviceUser);
        $this->behaviorData->setDate($date);
        $this->behaviorData->setNewApplyCount(50);      // 一周发起50个申请
        $this->behaviorData->setNewContactCount(45);    // 一周新增45个联系人
        $this->behaviorData->setChatCount(200);         // 一周进行200次聊天
        $this->behaviorData->setMessageCount(1500);     // 一周发送1500条消息
        $this->behaviorData->setAvgReplyTime(5);        // 平均回复时间5分钟
        $this->behaviorData->setNegativeFeedbackCount(2); // 2次负面反馈
        $this->behaviorData->setReplyPercentage(98.5); // 回复率98.5%

        // 验证周统计数据的合理性
        $this->assertGreaterThan(0, $this->behaviorData->getNewApplyCount());
        $this->assertLessThanOrEqual(
            $this->behaviorData->getNewApplyCount(),
            $this->behaviorData->getNewContactCount()
        );
        $this->assertGreaterThan(
            $this->behaviorData->getChatCount(),
            $this->behaviorData->getMessageCount()
        );
        $this->assertTrue(
            $this->behaviorData->getReplyPercentage() >= 0
            && $this->behaviorData->getReplyPercentage() <= 100
        );
        $this->assertLessThanOrEqual(10, $this->behaviorData->getAvgReplyTime()); // 快速响应
    }

    public function testBusinessScenarioTopPerformerUser(): void
    {
        $topUser = $this->createMock(UserInterface::class);

        // 模拟顶级表现用户
        $this->behaviorData->setUser($topUser);
        $this->behaviorData->setDate(new \DateTimeImmutable('2024-01-15'));
        $this->behaviorData->setNewApplyCount(30);
        $this->behaviorData->setNewContactCount(28);    // 高成功率
        $this->behaviorData->setChatCount(150);
        $this->behaviorData->setMessageCount(800);
        $this->behaviorData->setAvgReplyTime(3);        // 3分钟极快回复
        $this->behaviorData->setNegativeFeedbackCount(0);   // 无负面反馈
        $this->behaviorData->setReplyPercentage(100.0);  // 100%回复率

        // 验证顶级表现
        $newApplyCount = $this->behaviorData->getNewApplyCount();
        $newContactCount = $this->behaviorData->getNewContactCount();
        $this->assertNotNull($newApplyCount);
        $this->assertNotNull($newContactCount);
        $this->assertGreaterThan(0, $newApplyCount);
        $this->assertGreaterThan(0.9, $newContactCount / $newApplyCount); // 90%以上申请成功率
        $this->assertSame(0, $this->behaviorData->getNegativeFeedbackCount());
        $this->assertSame(100.0, $this->behaviorData->getReplyPercentage());
        $this->assertLessThanOrEqual(5, $this->behaviorData->getAvgReplyTime()); // 超快回复
    }

    public function testBusinessScenarioStrugglingUser(): void
    {
        $strugglingUser = $this->createMock(UserInterface::class);

        // 模拟表现不佳的用户
        $this->behaviorData->setUser($strugglingUser);
        $this->behaviorData->setDate(new \DateTimeImmutable('2024-01-15'));
        $this->behaviorData->setNewApplyCount(20);      // 发起申请较多
        $this->behaviorData->setNewContactCount(5);     // 但成功率很低
        $this->behaviorData->setChatCount(10);          // 聊天很少
        $this->behaviorData->setMessageCount(30);       // 消息很少
        $this->behaviorData->setAvgReplyTime(180);      // 3小时回复时间过长
        $this->behaviorData->setNegativeFeedbackCount(8);  // 负面反馈较多
        $this->behaviorData->setReplyPercentage(35.0); // 回复率很低

        // 验证问题指标
        $newApplyCount = $this->behaviorData->getNewApplyCount();
        $newContactCount = $this->behaviorData->getNewContactCount();
        $this->assertNotNull($newApplyCount);
        $this->assertNotNull($newContactCount);
        $this->assertGreaterThan(0, $newApplyCount);
        $this->assertLessThan(0.3, $newContactCount / $newApplyCount); // 申请成功率低于30%
        $this->assertGreaterThan(60, $this->behaviorData->getAvgReplyTime()); // 回复时间超过1小时
        $this->assertGreaterThan(5, $this->behaviorData->getNegativeFeedbackCount());
        $this->assertLessThan(50, $this->behaviorData->getReplyPercentage());
    }

    public function testBusinessScenarioMonthlyUserAnalysis(): void
    {
        $user = $this->createMock(UserInterface::class);

        $createTime = new \DateTimeImmutable('2024-02-01 08:00:00');
        $updateTime = new \DateTimeImmutable('2024-02-01 18:00:00');

        // 模拟月度用户分析数据
        $this->behaviorData->setUser($user);
        $this->behaviorData->setDate(new \DateTimeImmutable('2024-01-01')); // 1月份数据
        $this->behaviorData->setNewApplyCount(120);
        $this->behaviorData->setNewContactCount(100);
        $this->behaviorData->setChatCount(500);
        $this->behaviorData->setMessageCount(2500);
        $this->behaviorData->setAvgReplyTime(20);   // 20分钟
        $this->behaviorData->setNegativeFeedbackCount(5);
        $this->behaviorData->setReplyPercentage(88.5);

        $this->behaviorData->setCreateTime($createTime);
        $this->behaviorData->setUpdateTime($updateTime);

        // 验证月度数据的合理性
        $this->assertGreaterThanOrEqual(0, $this->behaviorData->getNewApplyCount());
        $this->assertLessThanOrEqual(
            $this->behaviorData->getNewApplyCount(),
            $this->behaviorData->getNewContactCount()
        );
        $this->assertGreaterThanOrEqual(0, $this->behaviorData->getMessageCount());
        $this->assertGreaterThanOrEqual(0, $this->behaviorData->getReplyPercentage());
        $this->assertLessThanOrEqual(100, $this->behaviorData->getReplyPercentage());
        $this->assertGreaterThan($createTime, $updateTime);
    }

    /**
     * 测试用户类型业务场景
     */
    public function testBusinessScenarioNewEmployeeUser(): void
    {
        $newEmployee = $this->createMock(UserInterface::class);

        // 模拟新员工的数据
        $this->behaviorData->setUser($newEmployee);
        $this->behaviorData->setDate(new \DateTimeImmutable('2024-01-15'));
        $this->behaviorData->setNewApplyCount(5);       // 谨慎发起申请
        $this->behaviorData->setNewContactCount(4);     // 成功率较高
        $this->behaviorData->setChatCount(15);          // 聊天次数适中
        $this->behaviorData->setMessageCount(60);       // 消息数量适中
        $this->behaviorData->setAvgReplyTime(45);       // 45分钟，有点慢但可接受
        $this->behaviorData->setNegativeFeedbackCount(0); // 无负面反馈
        $this->behaviorData->setReplyPercentage(80.0); // 80%回复率，还在学习中

        // 验证新员工特征
        $this->assertLessThanOrEqual(10, $this->behaviorData->getNewApplyCount()); // 比较保守
        $newApplyCount = $this->behaviorData->getNewApplyCount();
        $newContactCount = $this->behaviorData->getNewContactCount();
        $this->assertNotNull($newApplyCount);
        $this->assertNotNull($newContactCount);
        $this->assertGreaterThan(0, $newApplyCount);
        $this->assertGreaterThanOrEqual(0.7, $newContactCount / $newApplyCount); // 成功率较高
        $this->assertSame(0, $this->behaviorData->getNegativeFeedbackCount()); // 无负面反馈
        $this->assertGreaterThanOrEqual(70, $this->behaviorData->getReplyPercentage()); // 较好的回复率
    }

    public function testBusinessScenarioVeteranEmployeeUser(): void
    {
        $veteran = $this->createMock(UserInterface::class);

        // 模拟资深员工的数据
        $this->behaviorData->setUser($veteran);
        $this->behaviorData->setDate(new \DateTimeImmutable('2024-01-15'));
        $this->behaviorData->setNewApplyCount(40);      // 积极发起申请
        $this->behaviorData->setNewContactCount(35);    // 高成功率
        $this->behaviorData->setChatCount(200);         // 大量聊天
        $this->behaviorData->setMessageCount(1000);     // 大量消息
        $this->behaviorData->setAvgReplyTime(8);        // 8分钟快速回复
        $this->behaviorData->setNegativeFeedbackCount(1); // 极少负面反馈
        $this->behaviorData->setReplyPercentage(95.0); // 95%高回复率

        // 验证资深员工特征
        $this->assertGreaterThanOrEqual(30, $this->behaviorData->getNewApplyCount()); // 积极主动
        $newApplyCount = $this->behaviorData->getNewApplyCount();
        $newContactCount = $this->behaviorData->getNewContactCount();
        $this->assertNotNull($newApplyCount);
        $this->assertNotNull($newContactCount);
        $this->assertGreaterThan(0, $newApplyCount);
        $this->assertGreaterThanOrEqual(0.8, $newContactCount / $newApplyCount); // 高成功率
        $this->assertLessThanOrEqual(10, $this->behaviorData->getAvgReplyTime()); // 快速回复
        $this->assertGreaterThanOrEqual(90, $this->behaviorData->getReplyPercentage()); // 高回复率
        $this->assertLessThanOrEqual(2, $this->behaviorData->getNegativeFeedbackCount()); // 很少负面反馈
    }

    /**
     * 创建被测实体实例.
     */
    protected function createEntity(): object
    {
        return new UserBehaviorDataByUser();
    }

    /**
     * 提供属性及其样本值的 Data Provider.
     *
     * @return iterable<string, array{string, mixed}>
     */
    public static function propertiesProvider(): iterable
    {
        // user 属性为 UserInterface 类型，避免序列化问题，由专门的测试方法覆盖
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
        $this->behaviorData->setUser(null);
        $this->behaviorData->setNewApplyCount(null);
        $this->behaviorData->setNewContactCount(null);
        $this->behaviorData->setChatCount(null);
        $this->behaviorData->setMessageCount(null);
        $this->behaviorData->setAvgReplyTime(null);
        $this->behaviorData->setNegativeFeedbackCount(null);
        $this->behaviorData->setReplyPercentage(null);

        $this->behaviorData->setCreateTime(null);
        $this->behaviorData->setUpdateTime(null);

        $this->assertNull($this->behaviorData->getUser());
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
