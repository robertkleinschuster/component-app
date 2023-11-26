<?php

declare(strict_types=1);

use Robs\Component\App\BootstrapFactory;

require "../vendor/autoload.php";

$bootsrap = (new BootstrapFactory())->create(dirname(__DIR__));
$bootsrap->run();
