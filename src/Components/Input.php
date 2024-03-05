<?php

declare(strict_types=1);

namespace Zenith\Components;

use Mosaic\Fragment;
use Mosaic\Renderable;
use Mosaic\Renderer;

readonly class Input implements Renderable
{
    public function __construct(private string $type, private string $name, private string $id = '')
    {
    }

    public function render(Renderer $renderer, mixed $data = null): iterable
    {
        if ($this->id) {
            yield new Fragment(<<<HTML
<input type="$this->type" name="$this->name" id="$this->id">
HTML
            );
        } else {
            yield new Fragment(<<<HTML
<input type="$this->type" name="$this->name">
HTML
            );
        }

    }
}