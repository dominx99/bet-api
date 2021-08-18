<?php

declare(strict_types=1);

namespace App\Account\Http\Action;

use App\Account\Application\Create\CreateUserCommand;
use App\Account\Domain\Validation\CreateUserValidatorInterface;
use App\Account\Domain\Validation\Rules\User\CreateUserRules;
use App\Shared\Domain\Validator\ValidatorInterface;
use App\Shared\Http\Response\SuccessResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\UuidV4;

final class RegisterAction extends AbstractController
{
    public function __construct(
        private ValidatorInterface $validator,
        private CreateUserValidatorInterface $createUserValidator,
    ) {
    }

    #[Route('/api/v1/auth/register', name: 'register', methods: ['POST', 'HEAD'])]
    public function __invoke(Request $request): JsonResponse
    {
        $params = $request->request->all();

        $this->createUserValidator->validate($params, CreateUserRules::getRules());

        $this->dispatchMessage(new CreateUserCommand(
            (string) new UuidV4(),
            $params['email'],
            $params['password'],
            $params['name'],
        ));

        return new SuccessResponse();
    }
}
