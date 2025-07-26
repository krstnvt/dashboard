<?php

namespace App\Service;

class AnalyticsService
{
    public function getAnalytics(): array
    {
        return [
            'revenue' => 42000,
            'users' => 15320,
            'ctr' => 4.8,
            'signups' => 1120,
        ];
    }
}