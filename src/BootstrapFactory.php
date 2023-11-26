<?php

declare(strict_types=1);

namespace Robs\Component\App;

use Robs\Component\Renderer\Renderer;
use Robs\Component\Router\Router;
use Slim\Factory\AppFactory;

class BootstrapFactory
{
    public function create(string $root): Bootstrap
    {
        $router = new Router(
            directory: $root . '/app',
            cache: $root . '/cache/routes.php'
        );

        return new Bootstrap(AppFactory::create(), $router, new Renderer());
    }
}
