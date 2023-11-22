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

class Bootstrap
{
    public function __construct(private readonly Router $router, private readonly Renderer $renderer)
    {
    }

    /**
     * @throws RenderException
     * @throws RouterException
     */
    public function run(string $uri, string $method): void
    {
        $path = parse_url($uri, PHP_URL_PATH);

        $routeMethod = match ($method) {
            'GET' => RouteMethod::GET,
            'POST' => RouteMethod::POST,
            'PUT' => RouteMethod::PUT,
            'PATCH' => RouteMethod::PATCH,
            'CONNECT' => RouteMethod::CONNECT,
            'DELETE' => RouteMethod::DELETE,
            'HEAD' => RouteMethod::HEAD,
            'OPTIONS' => RouteMethod::OPTIONS,
            'TRACE' => RouteMethod::TRACE,
        };

        $route = $this->router->match($routeMethod, $path);

        if ($route->type == RouteType::PAGE) {
            if ($route->layout) {
                echo $this->renderer->render(
                    new IncludeFile($route->layout),
                    $this->renderer->args([
                        'children' => new IncludeFile($route->file)
                    ])
                );
            } else {
                echo $this->renderer->render(new IncludeFile($route->file));
            }
        }

        if ($route->type == RouteType::HANDLER) {
            $route->getHandler()();
        }
    }
}