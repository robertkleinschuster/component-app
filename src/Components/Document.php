<?php

declare(strict_types=1);

namespace Zenith\Components;

use Mosaic\Exception\RenderException;
use Mosaic\Fragment;
use Mosaic\Renderable;
use Mosaic\Renderer;
use Throwable;

readonly class Document implements Renderable
{

    public function __construct(
        private string        $lang,
        private mixed         $children,
        private ?Dependencies $dependencies = null,
        private mixed         $title = null,
        private mixed         $description = null,
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
        yield new Fragment(<<<HTML
<html lang="$this->lang">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{$renderer->render($this->title ?? $renderer->placeholder('meta.title'), $renderer->args((array)$data))}</title>
        <meta name="description" content="{$renderer->render($this->description ?? $renderer->placeholder('meta.description'), $renderer->args((array)$data))}">
        {$renderer->conditional($this->dependencies, fn() => isset($this->dependencies), $renderer->args((array)$data))}
        {$renderer->placeholder('head')}
    </head>
    <body>
        {$renderer->render($this->children, $renderer->args((array)$data))}
    </body>
</html>
HTML
        );
    }
}