<?php
namespace Application\GoogleApis;

use Google\Client;

interface ClientFactoryInterface
{
    public function getPublicClient(): Client;
    public function getUserClient(): Client;
}