<?php

declare(strict_types=1);

namespace Application\Routes;

use Concrete\Core\Routing\Route as ConcreteRoute;
use Concrete\Core\Routing\RouteMiddleware;
use Concrete\Core\Routing\Router;
use Symfony\Component\Routing\RouteCollection;

/**
 * Prettier way of creating routes...
 *
 * Class Route
 * @package Application\Routes
 */
class Route extends ConcreteRoute
{
    /**
     * @param mixed $action
     * @return $this
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setCustomName($name)
    {
        $this->customName = $name;
        return $this;
    }

    /**
     * @param RouteMiddleware $middleware
     * @return $this
     */
    public function addMiddleware(RouteMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
        return $this;
    }

    /**
     * @param string $name
     * @param Router $router
     * @return $this
     */
    public function updateName($name, Router $router)
    {
        /**
         * @var RouteCollection $routes
         */
        $routes = $router->getRoutes();
        /**
         * @var string $currentName
         */
        $currentName = $this->getName();
        $routes->remove($currentName);
        $this->setCustomName($name);
        $router->getRoutes()->add($name, $this);
        return $this;
    }
}
