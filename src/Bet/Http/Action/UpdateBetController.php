<?php

declare(strict_types=1);

namespace App\Bet\Http\Action;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateBetController extends AbstractController
{
    #[Route('/show', methods: ['GET', 'HEAD'])]
    public function show(): Response
    {
        return new JsonResponse('success');
    }

    #[Route('/index', methods: ['GET', 'HEAD'])]
    public function index(): JsonResponse
    {
        return new JsonResponse('success');
    }
}
