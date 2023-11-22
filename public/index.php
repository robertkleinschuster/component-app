<?php

declare(strict_types=1);

use Robs\Component\App\Bootstrap;
use Robs\Component\Renderer\Renderer;
use Robs\Component\Router\Router;

require "../vendor/autoload.php";

$router = new Router(
    __DIR__ . '/../app',
    __DIR__ . '/../cache/routes.php'
);

$renderer = new Renderer();

$bootsrap = new Bootstrap($router, $renderer);
$bootsrap->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
