<?php

declare(strict_types=1);

namespace Zenith\Components;

use Mosaic\Fragment;
use Mosaic\Renderable;
use Mosaic\Renderer;

readonly class Script implements Renderable
{
    public function __construct(private string $src)
    {
    }

    public function render(Renderer $renderer, mixed $data = null): iterable
    {
        yield new Fragment(<<<HTML
<script src="$this->src"></script>
HTML
);
    }
}