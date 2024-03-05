<?php

declare(strict_types=1);

namespace Zenith\Plugin;

use Closure;
use Zenith\AppConfig;
use Mosaic\Exception\RenderException;
use Mosaic\FragmentCollection;
use Mosaic\Renderer;
use Throwable;

readonly class Config
{
    /**
     * @param Closure(AppConfig $config): mixed $closure
     */
    public function __construct(private Closure $closure)
    {
    }

    /**
     * @throws Throwable
     * @throws RenderException
     */
    public function call(Renderer $renderer, AppConfig $config, mixed $data): FragmentCollection
    {
        return $renderer->render(($this->closure)($config), $data);
    }
}