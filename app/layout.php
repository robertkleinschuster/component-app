<?php

declare(strict_types=1);

use Robs\Component\Renderer\Renderer;
use Robs\Component\Router\Meta;

return fn($children, Renderer $renderer, ?Meta $meta, ?object $args) => <<<HTML
<html lang="{$meta?->language}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{$meta?->title}</title>
        <meta name="description" content="{$meta?->description}">
    </head>
    <body>
        {$renderer->render($children, $renderer->args(['args' => $args]))}
    </body>
</html>
HTML;
