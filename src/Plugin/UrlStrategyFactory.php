<?php

declare(strict_types=1);

namespace Zenith\Plugin;


use Mosaic\Strategy;
use Mosaic\StrategyFactory;
use Slim\Routing\RouteParser;

readonly class UrlStrategyFactory implements StrategyFactory
{
    public function __construct(private RouteParser $routeParser)
    {
    }

    public function create(Strategy $next): Strategy
    {
        $strategy = new UrlStrategy($next);
        $strategy->setRouteParser($this->routeParser);
        return $strategy;
    }
}