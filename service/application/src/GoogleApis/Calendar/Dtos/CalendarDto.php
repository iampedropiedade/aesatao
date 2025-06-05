<?php
namespace Application\GoogleApis\Calendar\Dtos;

use Google\Service\Calendar\Events;

class CalendarDto
{
    private string $title;
    /**
     * @var EventDto[]
     */
    private array $events;

    public function __construct(Events $events)
    {
        $this->title = $events->getSummary();
        foreach ($events->getItems() as $event) {
            $this->events[] = new EventDto($event);
        }
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getEvents(): array
    {
        return $this->events;
    }
}
