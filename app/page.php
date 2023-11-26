<?php

declare(strict_types=1);

use Robs\Component\Renderer\Renderer;

return page(
    view: fn(Renderer $renderer) => <<<HTML
  <h1>Hello world!</h1>
HTML,
    meta: meta(
        language: 'en',
        title: 'Hello world',
        description: 'Description'
    )
);
