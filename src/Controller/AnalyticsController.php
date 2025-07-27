<?php

namespace App\Controller;

use App\Service\AnalyticsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnalyticsController extends AbstractController
{
    public function __construct(private AnalyticsService $analyticsService)
    {
    }

    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login');
        }
        
        return $this->render('analytics/index.html.twig');
    }

    #[Route('/api/analytics', name: 'api_analytics', methods: ['GET'])]
    public function summary(): JsonResponse
    {
        $analytics = $this->analyticsService->getAnalytics();
        return $this->json($analytics->toArray());
    }

    #[Route('/api/analytics/revenue', name: 'api_analytics_revenue', methods: ['GET'])]
    public function revenue(): JsonResponse
    {
        return $this->json($this->analyticsService->getRevenueData());
    }

    #[Route('/api/analytics/visits', name: 'api_analytics_visits', methods: ['GET'])]
    public function visits(): JsonResponse
    {
        return $this->json($this->analyticsService->getVisitsData());
    }

    #[Route('/api/analytics/devices', name: 'api_analytics_devices', methods: ['GET'])]
    public function devices(): JsonResponse
    {
        return $this->json($this->analyticsService->getDevicesData());
    }

    #[Route('/api/analytics/activity', name: 'api_analytics_activity', methods: ['GET'])]
    public function activity(): JsonResponse
    {
        return $this->json($this->analyticsService->getActivityData());
    }
}
