<?php

declare(strict_types=1);

use Mosaic\Renderer;
use Compass\Reactive;

return #[Reactive] function (Renderer $renderer, $children) {
    yield 'A Layout';
    yield $children;
};