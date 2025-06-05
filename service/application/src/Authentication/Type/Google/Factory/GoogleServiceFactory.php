<?php

namespace Application\Authentication\Type\Google\Factory;

use Concrete\Core\Application\ApplicationAwareInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Service\ServiceInterface;
use OAuth\Common\Storage\SymfonySession;
use OAuth\OAuth2\Service\Google;
use OAuth\ServiceFactory;
use Concrete\Core\Authentication\Type\Google\Factory\GoogleServiceFactory as CoreGoogleServiceFactory;

class GoogleServiceFactory extends CoreGoogleServiceFactory implements ApplicationAwareInterface
{

    /**
     * Create a service object given a ServiceFactory object
     *
     * @return ServiceInterface
     * @throws BindingResolutionException
     */
    public function createService()
    {
        $appId = $this->config->get('auth.google.appid');
        $appSecret = $this->config->get('auth.google.secret');

        /** @var ServiceFactory $factory */
        $factory = $this->app->make('oauth/factory/service');

        // Get the callback url
        $callbackUrl = $this->urlResolver->resolve(['/ccm/system/authentication/oauth2/google/callback/']);
        if ($callbackUrl->getHost() == '') {
            $callbackUrl = $callbackUrl->setHost($this->request->getHost());
            $callbackUrl = $callbackUrl->setScheme($this->request->getScheme());
        }

        // Create a credential object with our ID, Secret, and callback url
        $credentials = new Credentials($appId, $appSecret, (string) $callbackUrl);

        // Create a new session storage object and pass it the active session
        $storage = new SymfonySession($this->session, false);

        // Create the service using the oauth service factory
        return $factory->createService('google', $credentials, $storage, [Google::SCOPE_EMAIL, Google::SCOPE_PROFILE, Google::SCOPE_GOOGLEDRIVE, Google::SCOPE_CALENDAR_READ_ONLY]);
    }

}


