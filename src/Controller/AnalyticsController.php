<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\AnalyticsService;


class AnalyticsController extends AbstractController
{
    private AnalyticsService $analyticsService;

    public function __construct(AnalyticsService $analyticsService)
    {
        $this->analyticsService = $analyticsService;
    }

    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {
        return $this->render('analytics/index.html.twig');
    }

    #[Route('/api/analytics', name: 'api_analytics', methods: ['GET'])]
    public function summary(): JsonResponse
    {
        $data = $this->analyticsService->getAnalytics();

        return $this->json($data);
    }
}
