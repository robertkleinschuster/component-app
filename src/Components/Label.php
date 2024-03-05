<?php

declare(strict_types=1);

namespace Zenith\Components;

use Mosaic\Exception\RenderException;
use Mosaic\Fragment;
use Mosaic\Renderable;
use Mosaic\Renderer;
use Throwable;

readonly class Label implements Renderable
{
    public function __construct(private mixed $children, private string $for = '')
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
        if ($this->for) {
            yield new Fragment(<<<HTML
<label for="$this->for">{$renderer->render($this->children)}</label>
HTML
            );
        } else {
            yield new Fragment(<<<HTML
<label>{$renderer->render($this->children)}</label>
HTML
            );
        }

    }
}