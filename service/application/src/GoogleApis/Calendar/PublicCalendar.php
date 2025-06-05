<?php
namespace Application\GoogleApis\Calendar;

use Application\GoogleApis\Calendar\Dtos\CalendarDto;
use Google\Exception;

class PublicCalendar extends AbstractCalendar implements CalendarInterface
{
    /**
     * @throws Exception
     */
    public function getEvents(string $id): CalendarDto
    {
        return $this->getEventsFromApi($id, $this->getPublicService());
    }


}