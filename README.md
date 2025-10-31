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

A Symfony bundle for collecting and managing WeChat Work external contact statistics data.

## Features

- Collect user behavior statistics for WeChat Work external contacts
- Support both user-level and department-level statistics
- Automatic data synchronization via cron jobs
- Comprehensive data entities and repositories
- Statistical analysis for contact applications, messages, and reply rates

## Requirements

- PHP 8.1+
- Symfony 6.4+
- Doctrine ORM 3.0+
- WeChat Work API access

## Installation

```bash
composer require tourze/wechat-work-external-contact-stats-bundle
```

## Configuration

Add the bundle to your `config/bundles.php`:

```php
<?php

return [
    // ... other bundles
    WechatWorkExternalContactStatsBundle\WechatWorkExternalContactStatsBundle::class => ['all' => true],
];
```

## Usage

### Entities

The bundle provides two main entities:

#### UserBehaviorDataByUser
Tracks individual user behavior statistics:
- New application count
- New contact count  
- Chat count
- Message count
- Average reply time
- Negative feedback count
- Reply percentage

#### UserBehaviorDataByParty
Tracks department-level behavior statistics with the same metrics as user-level data.

### Commands

#### Sync User Behavior Data

```bash
# Sync user behavior statistics data
php bin/console wechat-work:sync-user-behavior-by-user
```

This command runs automatically via cron job at 6:14 AM daily.

## Repository Usage

```php
use WechatWorkExternalContactStatsBundle\Entity\UserBehaviorDataByUser;
use WechatWorkExternalContactStatsBundle\Entity\UserBehaviorDataByParty;
use WechatWorkExternalContactStatsBundle\Repository\UserBehaviorDataByUserRepository;
use WechatWorkExternalContactStatsBundle\Repository\UserBehaviorDataByPartyRepository;

// Get user behavior data
$userRepository = $entityManager->getRepository(UserBehaviorDataByUser::class);
$userStats = $userRepository->findBy(['user' => $user]);

// Get department behavior data
$partyRepository = $entityManager->getRepository(UserBehaviorDataByParty::class);
$departmentStats = $partyRepository->findBy(['party' => $department]);
```

## Advanced Usage

### API Integration

The bundle integrates with WeChat Work API to fetch:
- Follow user lists
- User behavior statistics
- Contact interaction data

### Custom Queries

You can create custom queries using the repository methods:

```php
// Find statistics for a specific date range
$stats = $userRepository->createQueryBuilder('u')
    ->where('u.date BETWEEN :start AND :end')
    ->setParameter('start', $startDate)
    ->setParameter('end', $endDate)
    ->getQuery()
    ->getResult();
```

## Dependencies

- `tourze/wechat-work-bundle` - Core WeChat Work functionality
- `tourze/wechat-work-external-contact-bundle` - External contact management
- `tourze/symfony-cron-job-bundle` - Cron job scheduling

## Contributing

Please see [CONTRIBUTING.md](https://github.com/tourze/php-monorepo/blob/master/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email security@tourze.com instead of using the issue tracker.

## License

This bundle is released under the MIT license. See the [LICENSE](LICENSE) file for details.