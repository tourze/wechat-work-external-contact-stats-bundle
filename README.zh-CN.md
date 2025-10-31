# WechatWorkExternalContactStatsBundle

[English](README.md) | [中文](README.zh-CN.md)

[![Latest Version](https://img.shields.io/packagist/v/tourze/wechat-work-external-contact-stats-bundle.svg?style=flat-square)]
(https://packagist.org/packages/tourze/wechat-work-external-contact-stats-bundle)
[![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/github/actions/workflow/status/tourze/php-monorepo/ci.yml?branch=master&style=flat-square)]
(https://github.com/tourze/php-monorepo/actions)
[![Code Coverage](https://img.shields.io/codecov/c/github/tourze/php-monorepo?style=flat-square)]
(https://codecov.io/gh/tourze/php-monorepo)
[![PHP Version Require](https://img.shields.io/packagist/php-v/tourze/wechat-work-external-contact-stats-bundle.svg?style=flat-square)]
(https://packagist.org/packages/tourze/wechat-work-external-contact-stats-bundle)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/wechat-work-external-contact-stats-bundle.svg?style=flat-square)]
(https://packagist.org/packages/tourze/wechat-work-external-contact-stats-bundle)

用于收集和管理企业微信外部联系人统计数据的 Symfony Bundle。

## 功能特性

- 收集企业微信外部联系人的用户行为统计数据
- 支持用户级别和部门级别的统计
- 通过 cron 任务自动同步数据
- 完善的数据实体和仓储类
- 提供联系人申请、消息、回复率等统计分析

## 系统要求

- PHP 8.1+
- Symfony 6.4+
- Doctrine ORM 3.0+
- 企业微信 API 访问权限

## 安装

```bash
composer require tourze/wechat-work-external-contact-stats-bundle
```

## 配置

在 `config/bundles.php` 中添加 Bundle：

```php
<?php

return [
    // ... 其他 bundles
    WechatWorkExternalContactStatsBundle\WechatWorkExternalContactStatsBundle::class => ['all' => true],
];
```

## 使用方法

### 实体类

Bundle 提供两个主要实体：

#### UserBehaviorDataByUser
跟踪个人用户行为统计：
- 新增申请数量
- 新增联系人数量
- 聊天次数
- 消息数量
- 平均回复时间
- 负面反馈次数
- 回复率

#### UserBehaviorDataByParty
跟踪部门级别行为统计，指标与用户级别数据相同。

### 命令行工具

#### 同步用户行为数据

```bash
# 同步用户行为统计数据
php bin/console wechat-work:sync-user-behavior-by-user
```

此命令通过 cron 任务每日早上 6:14 自动运行。

## 仓储使用

```php
use WechatWorkExternalContactStatsBundle\Entity\UserBehaviorDataByUser;
use WechatWorkExternalContactStatsBundle\Entity\UserBehaviorDataByParty;
use WechatWorkExternalContactStatsBundle\Repository\UserBehaviorDataByUserRepository;
use WechatWorkExternalContactStatsBundle\Repository\UserBehaviorDataByPartyRepository;

// 获取用户行为数据
$userRepository = $entityManager->getRepository(UserBehaviorDataByUser::class);
$userStats = $userRepository->findBy(['user' => $user]);

// 获取部门行为数据
$partyRepository = $entityManager->getRepository(UserBehaviorDataByParty::class);
$departmentStats = $partyRepository->findBy(['party' => $department]);
```

## 高级用法

### API 集成

Bundle 与企业微信 API 集成以获取：
- 关注用户列表
- 用户行为统计
- 联系人交互数据

### 自定义查询

您可以使用仓储方法创建自定义查询：

```php
// 查找特定日期范围的统计数据
$stats = $userRepository->createQueryBuilder('u')
    ->where('u.date BETWEEN :start AND :end')
    ->setParameter('start', $startDate)
    ->setParameter('end', $endDate)
    ->getQuery()
    ->getResult();
```

## 依赖包

- `tourze/wechat-work-bundle` - 核心企业微信功能
- `tourze/wechat-work-external-contact-bundle` - 外部联系人管理
- `tourze/symfony-cron-job-bundle` - Cron 任务调度

## 贡献

详情请参阅 [CONTRIBUTING.md](https://github.com/tourze/php-monorepo/blob/master/CONTRIBUTING.md)。

## 安全

如果您发现任何安全相关的问题，请发送邮件至 security@tourze.com，而不是使用问题跟踪器。

## 许可证

此 Bundle 基于 MIT 许可证发布。详见 [LICENSE](LICENSE) 文件。
