<?php

declare(strict_types=1);

namespace Application\Routes;

use Application\Controller\Api\PagesController;
use Application\Controller\Api\FilesController;
use Application\Controller\Api\UserController;
use Application\Controller\Api\GoogleDriveController;
use Application\Controller\Api\SearchController;
use Concrete\Core\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;

class Router
{
    public const string ROUTE_PAGES = '/api/pages';
    public const string ROUTE_FILES = '/api/files';
    public const string ROUTE_USER_AUTH = '/api/user';
    public const string ROUTE_GOOGLE_DRIVE = '/api/google/drive';
    public const string ROUTE_SEARCH = '/api/search';

    /** @var RouterInterface */
    private $router;

    /** @var Route[]|array */
    private $routes = [];

    /**
     * Router constructor.
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function create(): void
    {
        $this->routes[] = (new Route(self::ROUTE_PAGES))
            ->setCustomName('api_pages')
            ->setAction(PagesController::class . '::index')
            ->setMethods(Request::METHOD_GET);
        $this->routes[] = (new Route(self::ROUTE_FILES))
            ->setCustomName('api_files')
            ->setAction(FilesController::class . '::index')
            ->setMethods(Request::METHOD_GET);
        $this->routes[] = (new Route(self::ROUTE_USER_AUTH))
            ->setCustomName('api_user_auth')
            ->setAction(UserController::class . '::authStatus')
            ->setMethods(Request::METHOD_GET);

        $this->routes[] = (new Route(self::ROUTE_GOOGLE_DRIVE))
            ->setCustomName('api_google_drive')
            ->setAction(GoogleDriveController::class . '::index')
            ->setMethods(Request::METHOD_GET);

        $this->routes[] = (new Route(self::ROUTE_SEARCH))
            ->setCustomName('api_search')
            ->setAction(SearchController::class . '::index')
            ->setMethods(Request::METHOD_GET);

        $this->register();
    }

    private function register(): void
    {
        foreach ($this->routes as $route) {
            $this->router->addRoute($route);
        }
    }
}
