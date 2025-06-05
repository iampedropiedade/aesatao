<?php

namespace Application\GoogleApis;

use Concrete\Core\Application\Application;
use Concrete\Core\Authentication\Type\Google\Factory\GoogleServiceFactory;
use Concrete\Core\Config\Repository\Repository;
use Concrete\Core\Support\Facade\Application as FacadeApplication;
use Google\Client;
use Google\Exception;
use Google\Service\Drive as DriveService;
use Google\Service\Calendar as CalendarService;


// https://console.cloud.google.com/apis/credentials?authuser=7&project=website-agrupamento-montenegro&supportedpurview=project
// https://console.cloud.google.com/iam-admin/serviceaccounts/details/100948701452580535753/keys?authuser=7&invt=AbvbnQ&project=website-agrupamento-montenegro
readonly class ClientFactory implements ClientFactoryInterface
{
    private const string CONFIG_AUTH_CONFIG = 'app.google_auth_config';
    private const string CONFIG_API_KEY = 'app.google_api_key';
    private Application $app;
    private Repository $config;

    public function __construct()
    {
        $this->app = FacadeApplication::getFacadeApplication();
        $this->config = $this->app->make('config');
    }

    /**
     * @throws Exception
     */
    public function getPublicClient(): Client
    {
        $client = new Client();
        $client->setAuthConfig($this->config->get(self::CONFIG_AUTH_CONFIG));
        $client->addScope([
            DriveService::DRIVE_METADATA_READONLY,
            CalendarService::CALENDAR_READONLY,
        ]);
        $client->setAccessType('offline');
        return $client;
    }

    public function getUserClient(): Client
    {
        $factory = $this->app->make(GoogleServiceFactory::class);
        $service = $factory->createService();
        $accessToken = $service->getStorage()
            ->retrieveAccessToken($service->service())
            ->getAccessToken();
        $client = new Client();
        $client->setAccessToken($accessToken);
        return $client;
    }

    /**
     * @throws Exception
     */
    public function getApiClient(): Client
    {
        $client = new Client();
        $client->addScope(DriveService::DRIVE_METADATA_READONLY);
        $client->setAccessType('offline');
        return $client;
    }

}
