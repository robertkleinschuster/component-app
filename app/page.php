<?php

declare(strict_types=1);

use Robs\Component\Renderer\Renderer;

return fn(Renderer $renderer) => <<<HTML
  {$renderer->capture('meta.title', 'Hello world!')}
  {$renderer->capture('meta.language', 'en')}
  <h1>Hello world!</h1>
HTML;
