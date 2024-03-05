<?php

declare(strict_types=1);

use Zenith\Components\Document;
use Mosaic\Renderer;

return fn($children, Renderer $renderer, array $params, array $queryParams) => new Document(
    lang: 'de',
    children: $children
);
