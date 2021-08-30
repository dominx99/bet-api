<?php

declare(strict_types=1);

namespace App\Bet\Http\Action;

use App\Bet\Application\Create\CreateBetCommand;
use App\Bet\Domain\Validation\CreateBetValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\UuidV4;

final class CreateBetAction extends AbstractController
{
    public function __construct(
        private CreateBetValidatorInterface $createBetValidator,
    ) {
    }

    #[Route('/api/v1/bet', methods: ['POST', 'HEAD'])]
    public function __invoke(Request $request)
    {
        /** @var \App\Account\Domain\Resource\User */
        $user = $this->getUser();

        $this->createBetValidator->validate($request->request->all());

        $this->dispatchMessage(new CreateBetCommand(
            (string) new UuidV4(),
            $user->getId(),
            $request->request->get('title'),
            $request->request->get('startDate'),
            $request->request->get('endDate'),
        ));

        return new JsonResponse(['message' => 'success']);
    }
}
