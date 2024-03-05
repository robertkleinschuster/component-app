<?php

declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;

return function(ServerRequestInterface $request) {
    throw new HttpNotFoundException($request);
};