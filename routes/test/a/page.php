<?php

declare(strict_types=1);

use Zenith\Components\Button;
use Zenith\Components\Form;
use Zenith\Components\InputGroup;
use Zenith\Components\Link;
use Zenith\Plugin\Url;
use Compass\Reactive;

return #[Reactive] function (\Mosaic\Renderer $renderer) {
    yield $renderer->fragment('<h1>A</h1>');
    yield new Link(new Url('/test/a/2'));
    yield new Link(new Url('/test/a/1'));

    yield new Form(new Url('/test/a'), [
        new InputGroup('text', 'name', 'Say hello to?'),
        new Button('submit', 'Go!'),
    ]);
};