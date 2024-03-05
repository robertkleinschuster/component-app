<?php

declare(strict_types=1);

use Compass\Reactive;

return #[\Compass\Lazy] function (\Mosaic\Renderer $renderer) {
    yield $renderer->fragment('<h1>B</h1>');
};