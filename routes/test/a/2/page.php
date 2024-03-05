<?php

declare(strict_types=1);

use Zenith\Components\Link;
use Zenith\Plugin\Url;
use Compass\Reactive;

return #[Reactive] function (\Mosaic\Renderer $renderer) {
    yield $renderer->fragment('<h1>A 2</h1>');
    yield new Link(new Url('/test/a'));
    yield new Link(new Url('/test/a/1'));
};