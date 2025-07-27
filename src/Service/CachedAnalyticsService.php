<?php

namespace App\Service;

use App\DTO\AnalyticsDTO;
use App\Repository\AnalyticsRepositoryInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class CachedAnalyticsService extends AnalyticsService
{
    public function __construct(
        private AnalyticsRepositoryInterface $analyticsRepository,
        private CacheInterface $cache
    ) {
        parent::__construct($analyticsRepository);
    }

    public function getAnalytics(): AnalyticsDTO
    {
        return $this->cache->get('analytics_summary', function (ItemInterface $item) {
            $item->expiresAfter(300); // 5 minutes
            return parent::getAnalytics();
        });
    }

    public function getRevenueData(): array
    {
        return $this->cache->get('analytics_revenue', function (ItemInterface $item) {
            $item->expiresAfter(3600); // 1 hour
            return parent::getRevenueData();
        });
    }

    public function getVisitsData(): array
    {
        return $this->cache->get('analytics_visits', function (ItemInterface $item) {
            $item->expiresAfter(300); // 5 minutes
            return parent::getVisitsData();
        });
    }

    public function getDevicesData(): array
    {
        return $this->cache->get('analytics_devices', function (ItemInterface $item) {
            $item->expiresAfter(3600); // 1 hour
            return parent::getDevicesData();
        });
    }

    public function getActivityData(): array
    {
        return $this->cache->get('analytics_activity', function (ItemInterface $item) {
            $item->expiresAfter(300); // 5 minutes
            return parent::getActivityData();
        });
    }
}