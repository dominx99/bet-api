<?php

namespace App\EventListener;

use App\Shared\Domain\Exception\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof HttpException) {
            $event->setResponse(
                new JsonResponse(['message' => $exception->getMessage()], $exception->getCode()),
            );
        }

        if ($exception instanceof ValidationException) {
            $event->setResponse(new JsonResponse([
                'errors' => $exception->getMessages(),
            ], $exception->getCode()));
        }
    }
}
