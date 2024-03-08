<?php

declare(strict_types=1);

namespace Zenith;

use Compass\RouteCollector;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

readonly class DeployAction
{
    public function __construct(private AppConfig $config, private RouteCollector $router)
    {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $params): ResponseInterface
    {
        $key = $request->getHeaderLine('Authorization');
        if ($key && $this->config->is(AppConfig::DEPLOY_KEY, $key)) {
            if (function_exists('opcache_reset')) {
                opcache_reset();
            }
            $this->router->buildCache();
            return $response->withStatus(200);
        } else {
            return $response->withStatus(403);
        }
    }
}