<?php

declare(strict_types=1);

namespace Zenith\Components;

use Mosaic\Exception\RenderException;
use Mosaic\Fragment;
use Mosaic\Renderable;
use Mosaic\Renderer;
use Throwable;

readonly class Button implements Renderable
{
    public function __construct(private string $type, private mixed $children)
    {
    }

    /**
     * @param Renderer $renderer
     * @param mixed|null $data
     * @return iterable
     * @throws RenderException
     * @throws Throwable
     */
    public function render(Renderer $renderer, mixed $data = null): iterable
    {
        yield new Fragment(<<<HTML
<button type="$this->type">{$renderer->render($this->children)}</button>
HTML
        );
    }
}