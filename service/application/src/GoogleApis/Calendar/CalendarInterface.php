<?php
namespace Application\GoogleApis\Calendar;

use Application\GoogleApis\Calendar\Dtos\CalendarDto;

interface CalendarInterface
{
    public function getEvents(string $id): CalendarDto;
}