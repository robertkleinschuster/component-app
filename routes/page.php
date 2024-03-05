<?php

declare(strict_types=1);

use Zenith\AppConfig;
use Zenith\Components\Button;
use Zenith\Components\Form;
use Zenith\Components\InputGroup;
use Zenith\Plugin\Config;
use Zenith\Plugin\Url;
use Mosaic\Fragment;
use Mosaic\Renderer;

return #[\Compass\Reactive] function (Renderer $renderer) {
    yield $renderer->capture('meta.title', 'Hello world!');
    yield $renderer->capture('meta.description', 'Hello to the world!');
    yield $renderer->fragment('<h1>Hello world!</h1>');
    yield new Config(fn(AppConfig $config) => new Fragment("<h2>Env: {$config->get(AppConfig::ENVIRONMENT)}</h2>"));
    yield new Form(new Url('/'), [
        new InputGroup('text', 'name', 'Say hello to?'),
        new Button('submit', 'Go!'),
    ]);
};
