<?php

declare(strict_types=1);

namespace Zenith;

use Zenith\Plugin\ConfigStrategyFactory;
use Zenith\Plugin\UrlStrategyFactory;
use Mosaic\Renderer;
use Mosaic\StrategyPipelineFactory;
use Compass\Router;
use Compass\RoutesCache;
use Slim\Factory\AppFactory;

class BootstrapFactory
{
    public function create(string $routes, string $config, string $cache = null): Bootstrap
    {
        $config = new AppConfig($config);
        $router = new Router(
            directory: $routes,
            cache: $cache && $config->is(AppConfig::ENVIRONMENT, 'production') ? new RoutesCache($cache) : null,
        );

        $app = AppFactory::create();
        $renderer = new Renderer(
            (new StrategyPipelineFactory())->create(
                new UrlStrategyFactory($app->getRouteCollector()->getRouteParser()),
                new ConfigStrategyFactory($config)
            )
        );
        return new Bootstrap($config, $app, $router, $renderer);
    }
}
