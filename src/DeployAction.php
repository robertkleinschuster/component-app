<?php

declare(strict_types=1);

namespace Zenith;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Compass\Router;

readonly class DeployAction
{
    public function __construct(private AppConfig $config, private Router $router)
    {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $params): ResponseInterface
    {
        $key = $request->getHeaderLine('Authorization');
        if ($key && $this->config->is(AppConfig::DEPLOY_KEY, $key)) {
            if (function_exists('opcache_reset')) {
                opcache_reset();
            }
            $this->router->clearCache();
            return $response->withStatus(200);
        } else {
            return $response->withStatus(403);
        }
    }
}