<?php

declare(strict_types=1);

use Zenith\AppConfig;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

return function (AppConfig $config, array $params, array $queryParams, array $parsedBody) {
    return new Response(302, new Headers(['Location' => '/test/a/greeting/' . $parsedBody['name']]));
};