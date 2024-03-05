<?php

declare(strict_types=1);

namespace Zenith;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Compass\Action;
use Compass\Exception\InvalidActionException;
use Compass\Route;

readonly class ActionHandler
{
    public function __construct(private AppConfig $config, private Route $route)
    {
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $params
     * @return ResponseInterface
     * @throws InvalidActionException
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $params): ResponseInterface
    {
        $parsedBody = $request->getParsedBody();
        if ($parsedBody === null) {
            if ($request->getHeaderLine('Content-Type') === 'application/json') {
                $parsedBody = json_decode($request->getBody()->getContents(), true);
            } else {
                $parsedBody = [];
            }
        }
        $action = new Action(
            route: $this->route,
            params: $params,
            queryParams: $request->getQueryParams(),
            parsedBody: $parsedBody
        );
        return $action->call(config: $this->config, request: $request, response: $response);
    }
}