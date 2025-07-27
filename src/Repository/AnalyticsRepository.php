<?php

namespace App\Repository;

use Doctrine\DBAL\Connection;

class AnalyticsRepository implements AnalyticsRepositoryInterface
{
    public function __construct(private Connection $connection)
    {
    }

    public function getTotalRevenue(): int
    {
        return (int) $this->connection->fetchOne('SELECT COALESCE(SUM(amount), 0) FROM revenue');
    }

    public function getTotalUsers(): int
    {
        return (int) $this->connection->fetchOne('SELECT COUNT(*) FROM "user"');
    }

    public function getClickThroughRate(): float
    {
        $result = $this->connection->fetchAssociative(
            "SELECT 
                COALESCE(SUM(CASE WHEN a.action = 'click' THEN a.value END), 0) as clicks,
                COALESCE(SUM(v.count), 1) as views
            FROM activity a 
            CROSS JOIN visit v"
        );
        
        return round(($result['clicks'] / $result['views']) * 100, 1);
    }

    public function getTotalSignups(): int
    {
        return (int) $this->connection->fetchOne(
            "SELECT COALESCE(SUM(value), 0) FROM activity WHERE action = 'signup'"
        );
    }

    public function getRevenueByMonth(): array
    {
        return $this->connection->fetchAllAssociative('SELECT month, amount as revenue FROM revenue ORDER BY month');
    }

    public function getVisitsByDay(): array
    {
        return $this->connection->fetchAllAssociative(
            "SELECT TO_CHAR(date, 'Dy') as day, count as value FROM visit ORDER BY date DESC LIMIT 7"
        );
    }

    public function getDeviceStats(): array
    {
        return $this->connection->fetchAllAssociative('SELECT device_type as type, count as value FROM device_stat');
    }

    public function getActivityByHour(): array
    {
        return $this->connection->fetchAllAssociative(
            "SELECT EXTRACT(HOUR FROM timestamp::timestamp) || 'h' as hour, SUM(value) as active FROM activity WHERE action = 'click' GROUP BY EXTRACT(HOUR FROM timestamp::timestamp) ORDER BY EXTRACT(HOUR FROM timestamp::timestamp)"
        );
    }
}