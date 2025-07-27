<?php

namespace App\Service;

use App\DTO\AnalyticsDTO;
use App\Repository\AnalyticsRepositoryInterface;

class AnalyticsService
{
    public function __construct(private AnalyticsRepositoryInterface $analyticsRepository)
    {
    }

    public function getAnalytics(): AnalyticsDTO
    {
        return new AnalyticsDTO(
            revenue: $this->analyticsRepository->getTotalRevenue(),
            users: $this->analyticsRepository->getTotalUsers(),
            ctr: $this->analyticsRepository->getClickThroughRate(),
            signups: $this->analyticsRepository->getTotalSignups()
        );
    }

    public function getRevenueData(): array
    {
        return $this->analyticsRepository->getRevenueByMonth();
    }

    public function getVisitsData(): array
    {
        return $this->analyticsRepository->getVisitsByDay();
    }

    public function getDevicesData(): array
    {
        return $this->analyticsRepository->getDeviceStats();
    }

    public function getActivityData(): array
    {
        return $this->analyticsRepository->getActivityByHour();
    }
}