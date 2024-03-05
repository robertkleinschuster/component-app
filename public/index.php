<?php

declare(strict_types=1);

use Zenith\BootstrapFactory;

chdir(dirname(__DIR__));

require "vendor/autoload.php";

$bootsrap = (new BootstrapFactory())->create(
    dirname(__DIR__) . '/routes',
    dirname(__DIR__) . '/config.php'
);
$bootsrap->run();
