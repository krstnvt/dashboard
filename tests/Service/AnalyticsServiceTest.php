<?php

namespace App\Tests\Service;

use App\Service\AnalyticsService;
use App\Repository\AnalyticsRepositoryInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class AnalyticsServiceTest extends TestCase
{
    private AnalyticsService $analyticsService;
    private AnalyticsRepositoryInterface|MockObject $analyticsRepository;

    protected function setUp(): void
    {
        $this->analyticsRepository = $this->createMock(AnalyticsRepositoryInterface::class);
        $this->analyticsService = new AnalyticsService($this->analyticsRepository);
    }

    public function testGetAnalyticsReturnsCorrectStructure(): void
    {
        $this->analyticsRepository
            ->expects($this->once())
            ->method('getTotalRevenue')
            ->willReturn(1000);

        $this->analyticsRepository
            ->expects($this->once())
            ->method('getTotalUsers')
            ->willReturn(100);

        $this->analyticsRepository
            ->expects($this->once())
            ->method('getClickThroughRate')
            ->willReturn(2.5);

        $this->analyticsRepository
            ->expects($this->once())
            ->method('getTotalSignups')
            ->willReturn(50);

        $result = $this->analyticsService->getAnalytics();

        $this->assertEquals(1000, $result->revenue);
        $this->assertEquals(100, $result->users);
        $this->assertEquals(2.5, $result->ctr);
        $this->assertEquals(50, $result->signups);
    }

    public function testGetRevenueDataReturnsData(): void
    {
        $expectedData = [
            ['month' => 'Jan', 'revenue' => 1000],
            ['month' => 'Feb', 'revenue' => 1500]
        ];

        $this->analyticsRepository
            ->expects($this->once())
            ->method('getRevenueByMonth')
            ->willReturn($expectedData);

        $result = $this->analyticsService->getRevenueData();

        $this->assertEquals($expectedData, $result);
    }

    public function testGetVisitsDataReturnsData(): void
    {
        $expectedData = [
            ['day' => 'Mon', 'value' => 100],
            ['day' => 'Tue', 'value' => 150]
        ];

        $this->analyticsRepository
            ->expects($this->once())
            ->method('getVisitsByDay')
            ->willReturn($expectedData);

        $result = $this->analyticsService->getVisitsData();

        $this->assertEquals($expectedData, $result);
    }

    public function testGetDevicesDataReturnsData(): void
    {
        $expectedData = [
            ['type' => 'desktop', 'value' => 60],
            ['type' => 'mobile', 'value' => 40]
        ];

        $this->analyticsRepository
            ->expects($this->once())
            ->method('getDeviceStats')
            ->willReturn($expectedData);

        $result = $this->analyticsService->getDevicesData();

        $this->assertEquals($expectedData, $result);
    }

    public function testGetActivityDataReturnsData(): void
    {
        $expectedData = [
            ['hour' => '9h', 'active' => 50],
            ['hour' => '10h', 'active' => 75]
        ];

        $this->analyticsRepository
            ->expects($this->once())
            ->method('getActivityByHour')
            ->willReturn($expectedData);

        $result = $this->analyticsService->getActivityData();

        $this->assertEquals($expectedData, $result);
    }
}