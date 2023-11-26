<?php

declare(strict_types=1);

namespace Robs\Component\App;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Robs\Component\App\Exception\UnknownRouteTypeException;
use Robs\Component\Renderer\Exception\RenderException;
use Robs\Component\Renderer\Renderer;
use Robs\Component\Router\Exception\RouterException;
use Robs\Component\Router\Route;
use Robs\Component\Router\RouteType;

readonly class RouteHandler
{
    public function __construct(private Route $route, private Renderer $renderer)
    {
    }

    /**
     * @throws UnknownRouteTypeException
     * @throws RouterException
     * @throws RenderException
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args)
    {
        if ($this->route->type->is(RouteType::PAGE)) {
            $handler = $this->route->createHandler();
            if ($this->route->layout) {
                $layout = require $this->route->layout;

                $response->getBody()->write(
                    $this->renderer->render(
                        $layout,
                        $this->renderer->args([
                            'model' => $handler->model,
                            'meta' => $handler->meta,
                            'args' => (object)$args,
                            'children' => $handler->handler
                        ])
                    )
                );
            } else {
                $response->getBody()->write(
                    $this->renderer->render(
                        $handler->handler,
                        $this->renderer->args([
                            'model' => $handler->model,
                            'meta' => $handler->meta,
                            'args' => (object)$args
                        ])
                    )
                );
            }


            return $response->withHeader('Content-Type', 'text/html');
        }
        if ($this->route->type->is(RouteType::HANDLER)) {
            return ($this->route)(
                request: $request,
                response: $response,
                args: $args
            );
        }
        throw new UnknownRouteTypeException(sprintf('Type: %s', $this->route->type->name));
    }
}