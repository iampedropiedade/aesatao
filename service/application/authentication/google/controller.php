<?php
namespace Application\Authentication\Google;

defined('C5_EXECUTE') or die('Access Denied');

use Application\Authentication\Type\Google\Factory\GoogleServiceFactory;
use Concrete\Authentication\Google\Controller as GoogleController;

class Controller extends GoogleController
{
    public function getService()
    {
        if (!$this->service) {
            /** @var GoogleServiceFactory $factory */
            $factory = $this->app->make(GoogleServiceFactory::class);
            $this->service = $factory->createService();
        }

        return $this->service;
    }

}
