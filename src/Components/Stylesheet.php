<?php

declare(strict_types=1);

namespace Zenith\Components;

use Mosaic\Fragment;
use Mosaic\Renderable;
use Mosaic\Renderer;

readonly class Stylesheet implements Renderable
{
    public function __construct(private string $href)
    {
    }

    public function render(Renderer $renderer, mixed $data): iterable
    {
        yield new Fragment(<<<HTML
<link rel="stylesheet" href="$this->href">
HTML
);
    }
}