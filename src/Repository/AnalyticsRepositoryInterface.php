<?php

namespace App\Repository;

interface AnalyticsRepositoryInterface
{
    public function getTotalRevenue(): int;
    public function getTotalUsers(): int;
    public function getClickThroughRate(): float;
    public function getTotalSignups(): int;
    public function getRevenueByMonth(): array;
    public function getVisitsByDay(): array;
    public function getDeviceStats(): array;
    public function getActivityByHour(): array;
}