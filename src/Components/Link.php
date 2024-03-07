<?php

declare(strict_types=1);

namespace Zenith\Components;

use Zenith\Plugin\Url;
use Mosaic\Exception\RenderException;
use Mosaic\Renderable;
use Mosaic\Renderer;
use Throwable;

readonly class Link implements Renderable
{
    public function __construct(private Url $url, private mixed $children = null)
    {
    }

    /**
     * @param Renderer $renderer
     * @param mixed|null $data
     * @return iterable
     * @throws RenderException
     * @throws Throwable
     */
    public function render(Renderer $renderer, mixed $data): iterable
    {
        $url = $renderer->render($this->url);
        $children = $this->children ?? $url;
        return $renderer->fragment(<<<HTML
<a href="$url">{$renderer->render($children)}</a>
HTML
);
    }
}