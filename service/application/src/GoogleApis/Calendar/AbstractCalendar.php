<?php
namespace Application\GoogleApis\Calendar;

use Application\GoogleApis\Calendar\Dtos\CalendarDto;
use Google\Exception;
use Application\GoogleApis\ClientFactory;
use Google\Service\Calendar as CalendarService;

abstract class AbstractCalendar implements CalendarInterface
{
    protected ClientFactory $clientFactory;

    public function __construct()
    {
        $this->clientFactory = new ClientFactory();
    }

    abstract public function getEvents(string $id): CalendarDto;

    /**
     * @throws Exception
     */
    protected function getPublicService(): CalendarService
    {
        return new CalendarService($this->clientFactory->getPublicClient());
    }

    protected function getUserService(): CalendarService
    {
        return new CalendarService($this->clientFactory->getUserClient());
    }

    protected function getEventsFromApi(string $id, CalendarService $service): CalendarDto
    {
        $results = $service->events->listEvents($id, [
            'maxResults' => 10,
            'orderBy' => 'startTime',
            'singleEvents' => true,
        ]);
        return new CalendarDto($results);
    }
}