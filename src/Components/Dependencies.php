<?php

declare(strict_types=1);

namespace Zenith\Components;

use Mosaic\Renderable;
use Mosaic\Renderer;

readonly class Dependencies implements Renderable
{
    /**
     * @param string[] $scripts
     * @param string[] $stylesheets
     */
    public function __construct(private array $scripts, private array $stylesheets)
    {
    }

    public function render(Renderer $renderer, mixed $data): iterable
    {
        foreach ($this->scripts as $script) {
            yield new Script($script);
        }
        foreach ($this->stylesheets as $style) {
            yield new Stylesheet($style);
        }
    }
}