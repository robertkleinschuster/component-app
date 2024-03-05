<?php

declare(strict_types=1);

namespace Zenith\Components;

use Mosaic\Renderable;
use Mosaic\Renderer;

readonly class InputGroup implements Renderable
{
    public function __construct(private string $type, private string $name, private string $label)
    {
    }

    public function render(Renderer $renderer, mixed $data = null): iterable
    {
        yield new Label([
            $this->label,
            new Input($this->type, $this->name)
        ]);
    }
}