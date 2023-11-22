<?php

declare(strict_types=1);

namespace Robs\Component\AppTest;

use PHPUnit\Framework\TestCase;
use Robs\Component\App\Bootstrap;
use Robs\Component\Renderer\Helper\IncludeFile;
use Robs\Component\Renderer\Renderer;
use Robs\Component\Router\Route;
use Robs\Component\Router\RouteMethod;
use Robs\Component\Router\Router;
use Robs\Component\Router\RouteType;

class BootstrapTest extends TestCase
{
    public function testShouldRenderPageRoutes()
    {
        self::expectOutputString('Hello world!');

        $router = $this->createMock(Router::class);
        $route = new Route('path', __DIR__ . '/renderable.php', RouteType::PAGE, RouteMethod::GET);
        $router->method('match')->willReturn($route);
        $renderer = $this->createMock(Renderer::class);
        $renderer->method('render')->with(new IncludeFile($route->file))->willReturn('Hello world!');
        $bootstrap = new Bootstrap($router, $renderer);
        $bootstrap->run('/', 'GET');
    }

    public function testShouldRenderPageRoutesWithLayout()
    {
        self::expectOutputString('Hello world!');

        $router = $this->createMock(Router::class);
        $route = new Route('path', __DIR__ . '/renderable.php', RouteType::PAGE, RouteMethod::GET, __DIR__ . '/renderable.php');
        $router->method('match')->willReturn($route);
        $renderer = $this->createMock(Renderer::class);
        $renderer->method('render')->with(new IncludeFile($route->layout), new IncludeFile($route->file))->willReturn('Hello world!');
        $bootstrap = new Bootstrap($router, $renderer);
        $bootstrap->run('/', 'GET');
    }
}