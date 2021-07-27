<?php

declare(strict_types=1);

namespace App\Bet\Http\Action;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class CreateBetAction extends AbstractController
{
    #[Route('/api/v1/bet', methods: ['POST', 'HEAD'])]
    public function __invoke(Request $request)
    {
        $user = $this->getUser();

        return new JsonResponse(['message' => 'success']);
    }
}
