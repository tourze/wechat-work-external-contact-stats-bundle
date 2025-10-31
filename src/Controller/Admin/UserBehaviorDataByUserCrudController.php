<?php

declare(strict_types=1);

namespace WechatWorkExternalContactStatsBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminCrud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\DateTimeFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use WechatWorkExternalContactStatsBundle\Entity\UserBehaviorDataByUser;

#[AdminCrud(
    routePath: '/wechat-work-external-contact-stats/user-behavior-data-by-user',
    routeName: 'wechat_work_external_contact_stats_user_behavior_data_by_user'
)]
final class UserBehaviorDataByUserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserBehaviorDataByUser::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('用户行为数据')
            ->setEntityLabelInPlural('用户行为数据')
            ->setPageTitle('index', '用户行为数据管理')
            ->setPageTitle('detail', '用户行为数据详情')
            ->setPageTitle('edit', '编辑用户行为数据')
            ->setPageTitle('new', '新增用户行为数据')
            ->setDefaultSort(['date' => 'DESC', 'id' => 'DESC'])
            ->setPaginatorPageSize(20)
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('user', '用户'))
            ->add(DateTimeFilter::new('date', '日期'))
            ->add('newApplyCount')
            ->add('newContactCount')
            ->add('chatCount')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'ID')
            ->onlyOnIndex()
        ;

        yield AssociationField::new('user', '用户')
            ->setRequired(true)
            ->setHelp('选择统计对象用户')
        ;

        yield DateField::new('date', '统计日期')
            ->setRequired(true)
            ->setHelp('行为数据统计的日期')
        ;

        yield IntegerField::new('newApplyCount', '发起申请数')
            ->setHelp('成员主动向客户发起的好友申请数量')
            ->hideOnIndex()
        ;

        yield IntegerField::new('newContactCount', '新增客户数')
            ->setHelp('成员新添加的客户数量')
        ;

        yield IntegerField::new('chatCount', '聊天总数')
            ->setHelp('成员有主动发送过消息的单聊总数')
        ;

        yield IntegerField::new('messageCount', '发送消息数')
            ->setHelp('成员在单聊中发送的消息总数')
            ->hideOnIndex()
        ;

        yield NumberField::new('replyPercentage', '已回复聊天占比')
            ->setNumDecimals(2)
            ->setHelp('客户主动发起聊天后成员回复的聊天占比')
            ->hideOnIndex()
        ;

        yield IntegerField::new('avgReplyTime', '平均首次回复时长')
            ->setHelp('平均首次回复时长，单位：分钟')
            ->hideOnIndex()
        ;

        yield IntegerField::new('negativeFeedbackCount', '删除/拉黑数')
            ->setHelp('删除/拉黑成员的客户数')
            ->hideOnIndex()
        ;
    }
}
