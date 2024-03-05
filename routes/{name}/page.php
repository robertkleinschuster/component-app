<?php

declare(strict_types=1);


use Compass\Lazy;

return #[Lazy] fn(array $params) => "Hello $params[name]!";