<?php

declare(strict_types=1);

namespace Zenith;

use Mosaic\Renderer;
use Compass\Router;
use Slim\App;

readonly class Bootstrap
{
    public function __construct(private AppConfig $config, private App $app, private Router $router, private Renderer $renderer)
    {
    }

    public function route(string $method, string $path, callable $handler, string $name): self
    {
        $this->app->map([$method], $path, $handler)->setName($name);
        return $this;
    }

    public function run(): void
    {
        $routes = $this->router->getRoutes();

        $this->app->addRoutingMiddleware();
        $this->app->addErrorMiddleware($this->config->is(AppConfig::ENVIRONMENT, 'development'), true, true);

        $this->app->post('/.deploy', new DeployAction($this->config, $this->router));

        foreach ($routes as $route) {
            $this->route('GET', $route->getPath(), new PageHandler($this->renderer, $route), $route->getName());
            if ($route->getAction()) {
                $this->route('POST', $route->getPath(), new ActionHandler($this->config, $route), $route->getName());
            }
        }

        $this->app->run();
    }
}