<?php

declare(strict_types=1);

namespace Zenith\Components;

use Zenith\Plugin\Url;
use Mosaic\Exception\RenderException;
use Mosaic\Renderable;
use Mosaic\Renderer;
use Throwable;

readonly class Form implements Renderable
{
    public function __construct(
        private Url     $action,
        private mixed   $children,
        private ?string $target = null
    )
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
        $attributes = [];

        if (isset($this->target)) {
            $attributes[] = sprintf('target="%s"', $this->target);
        }

        $attributes = implode(' ', $attributes);

        if ($attributes !== '') {
            $attributes = ' ' . $attributes;
        }

        yield $renderer->fragment(<<<HTML
<form action="{$renderer->render($this->action)}" method="post"$attributes">
    {$renderer->render($this->children)}
</form>
HTML
        );
    }
}