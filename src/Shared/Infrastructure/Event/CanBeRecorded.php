<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Event;

use App\Shared\Domain\Event\EventInterface;

trait CanBeRecorded
{
    private EventCollection $events;

    public function record(EventInterface $event): void
    {
        if (!isset($this->events)) {
            $this->events = new EventCollection();
        }

        $this->events->add($event);
    }

    public function getEvents(): EventCollection
    {
        return $this->events;
    }
}
