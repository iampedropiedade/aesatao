<?php
namespace Application\GoogleApis\Calendar\Dtos;

use Google\Service\Calendar\Event;

class EventDto
{
    private string $title;
    private string $start;
    private string $end;

    public function __construct(Event $event)
    {
        $this->title = $event->getSummary();
        $this->start = $event->getStart()->getDateTime();
        $this->end = $event->getEnd()->getDateTime();
    }
}
