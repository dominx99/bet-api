<?php

declare(strict_types = 1);

namespace App\Bet\Http\Action;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class CreateBetAction extends AbstractController
{
    #[Route('/api/v1/bet', methods: ['POST', 'HEAD'])]
    public function __invoke()
    {
        $this->dispatchMessage(new CreateBetCommand());

        return new JsonResponse('success');
    }
}
