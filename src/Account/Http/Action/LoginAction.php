<?php

declare(strict_types=1);

namespace App\Account\Http\Action;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Firebase\JWT\JWT;

class LoginAction extends AbstractController
{
    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(): Response
    {
        /** @var \App\Account\Domain\Resource\User */
        $user = $this->getUser();

        $accessToken = JWT::encode([
            'userId' => $user->getId(),
            'email' => $user->getEmail(),
            'exp' => time() + (60 * 60 * 24 * 3),
        ], $_ENV['JWT_KEY']);

        return $this->json([
            'accessToken' => $accessToken,
        ]);
    }
}
