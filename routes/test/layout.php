<?php

declare(strict_types=1);

use Zenith\Components\Link;
use Zenith\Plugin\Url;
use Mosaic\Renderer;
use Compass\Reactive;

return #[Reactive] function (Renderer $renderer, $children) {
    yield new Link(new Url('/test/a'));
    yield ' ';
    yield new Link(new Url('/test/b'));
    yield $children;
};