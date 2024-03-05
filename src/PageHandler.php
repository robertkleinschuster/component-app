<?php

declare(strict_types=1);

namespace Zenith;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Mosaic\Exception\RenderException;
use Mosaic\Renderer;
use Compass\Page;
use Compass\Route;
use Slim\Exception\HttpException;
use Throwable;

readonly class PageHandler
{
    public function __construct(private AppConfig $config, private Renderer $renderer, private Route $route)
    {
    }

    /**
     * @throws RenderException|Throwable
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $params): ResponseInterface
    {
        if ($request->getHeaderLine('Accept') === 'application/x.no-content') {
            return $response->withStatus(204);
        }

        try {
            $page = new Page(
                route: $this->route,
                uri: (string)$request->getUri(),
                params: $params,
                queryParams: $request->getQueryParams()
            );

            $response->getBody()->write(
                (string)$this->renderer->render($page, config: $this->config, request: $request, response: $response)
            );
            return $response->withHeader('Content-Type', 'text/html');
        } catch (RenderException $exception) {
            if ($exception->getPrevious() instanceof HttpException) {
                throw $exception->getPrevious();
            }
            $exception = new HttpException($request, $exception->getMessage(), 500, $exception);
            $exception->setTitle('500 Internal Server Error');
            throw $exception;
        }
    }
}