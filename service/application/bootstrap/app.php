<?php
use Application\Routes\Router;
use Concrete\Core\Routing\Router as CoreRouter;

/* @var Concrete\Core\Application\Application $app */
/* @var Concrete\Core\Console\Application $console only set in CLI environment */
include sprintf('%s/%s/vendor/autoload.php', DIR_APPLICATION, DIRNAME_CLASSES);

if ($this->app->isInstalled() === true) {
    (new Router($this->app->make(CoreRouter::class)))->create();
}

$config = $this->app->make('config');

if (strtolower($config->get('app.sentry.environment')) !== 'development') {
    \Sentry\init([
        'dsn' => 'https://1e6c8ac9d1ad5bba650ddc44eb9e71d7@o4507111295025152.ingest.de.sentry.io/4509441589510224',
        'traces_sample_rate' => 1.0,
        'profiles_sample_rate' => 1.0,
    ]);
}

Core::bind('manager/view/pagination', function($app) {
    return new \Application\Search\Pagination\View\Manager($app);
});

$app->make(Application\Providers\SerializerServiceProvider::class)->register();

ini_set('max_execution_time', '120'); // For GD and stuff