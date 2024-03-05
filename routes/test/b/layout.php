<?php

declare(strict_types=1);

use Zenith\Components\Link;
use Zenith\Plugin\Url;
use Mosaic\Renderer;
use Compass\Reactive;

return function (Renderer $renderer, $children) {
    yield 'B Layout';
    yield $children;
};