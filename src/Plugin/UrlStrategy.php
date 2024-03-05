<?php

declare(strict_types=1);

namespace Zenith\Plugin;

use Mosaic\Fragment;
use Mosaic\FragmentCollection;
use Mosaic\Renderer;
use Mosaic\Strategy\Base\PipelineStrategy;
use Slim\Routing\RouteParser;

class UrlStrategy extends PipelineStrategy
{
    private RouteParser $routeParser;

    public function setRouteParser(RouteParser $routeParser): void
    {
        $this->routeParser = $routeParser;
    }

    public function execute(mixed $view, Renderer $renderer, mixed $data): FragmentCollection
    {
        if ($view instanceof Url) {
            $url = $this->routeParser->urlFor($view->getRoute(), $view->getParams(), $view->getQueryParmas());
            return new FragmentCollection(new Fragment($url));
        }
        return $this->next($view, $renderer, $data);
    }
}