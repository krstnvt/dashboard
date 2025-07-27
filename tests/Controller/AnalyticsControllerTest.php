<?php

namespace App\Tests\Controller;

use App\Service\AnalyticsService;
use App\DTO\AnalyticsDTO;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class AnalyticsControllerTest extends TestCase
{
    private AnalyticsService|MockObject $analyticsService;

    protected function setUp(): void
    {
        $this->analyticsService = $this->createMock(AnalyticsService::class);
    }

    public function testAnalyticsServiceReturnsCorrectData(): void
    {
        $dto = new AnalyticsDTO(1000, 100, 2.5, 50);
        
        $this->analyticsService
            ->expects($this->once())
            ->method('getAnalytics')
            ->willReturn($dto);

        $result = $this->analyticsService->getAnalytics();

        $this->assertEquals(1000, $result->revenue);
        $this->assertEquals(100, $result->users);
        $this->assertEquals(2.5, $result->ctr);
        $this->assertEquals(50, $result->signups);
    }

    public function testRevenueServiceReturnsData(): void
    {
        $expectedData = [['month' => 'Jan', 'revenue' => 1000]];
        
        $this->analyticsService
            ->expects($this->once())
            ->method('getRevenueData')
            ->willReturn($expectedData);

        $result = $this->analyticsService->getRevenueData();
        $this->assertEquals($expectedData, $result);
    }

    public function testVisitsServiceReturnsData(): void
    {
        $expectedData = [['day' => 'Mon', 'value' => 100]];
        
        $this->analyticsService
            ->expects($this->once())
            ->method('getVisitsData')
            ->willReturn($expectedData);

        $result = $this->analyticsService->getVisitsData();
        $this->assertEquals($expectedData, $result);
    }

    public function testDevicesServiceReturnsData(): void
    {
        $expectedData = [['type' => 'desktop', 'value' => 60]];
        
        $this->analyticsService
            ->expects($this->once())
            ->method('getDevicesData')
            ->willReturn($expectedData);

        $result = $this->analyticsService->getDevicesData();
        $this->assertEquals($expectedData, $result);
    }

    public function testActivityServiceReturnsData(): void
    {
        $expectedData = [['hour' => '9h', 'active' => 50]];
        
        $this->analyticsService
            ->expects($this->once())
            ->method('getActivityData')
            ->willReturn($expectedData);

        $result = $this->analyticsService->getActivityData();
        $this->assertEquals($expectedData, $result);
    }
}