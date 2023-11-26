<?php

declare(strict_types=1);

namespace Robs\Component\App;

use Robs\Component\Renderer\Exception\RenderException;
use Robs\Component\Renderer\Helper\IncludeFile;
use Robs\Component\Renderer\Renderer;
use Robs\Component\Router\Exception\RouterException;
use Robs\Component\Router\RouteMethod;
use Robs\Component\Router\Router;
use Robs\Component\Router\RouteType;
use Slim\App;

readonly class Bootstrap
{
    public function __construct(private App $app, private Router $router, private Renderer $renderer)
    {
    }

    /**
     * @throws RenderException
     * @throws RouterException
     */
    public function run(): void
    {
        $routes = $this->router->getAllRoutes();

        $this->app->addRoutingMiddleware();
        $this->app->addErrorMiddleware(true, true, true);

        foreach ($routes as $route) {
            $this->app->map(
                [$route->method->name],
                $route->path,
                new RouteHandler($route, $this->renderer)
            )->setName($route->name);
        }

        $this->app->run();
    }
}