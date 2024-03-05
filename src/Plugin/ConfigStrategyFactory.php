<?php

declare(strict_types=1);

namespace Zenith\Plugin;

use Zenith\AppConfig;
use Mosaic\Strategy;
use Mosaic\StrategyFactory;

readonly class ConfigStrategyFactory implements StrategyFactory
{
    public function __construct(private AppConfig $config)
    {
    }

    public function create(Strategy $next): Strategy
    {
        $strategy = new ConfigStrategy($next);
        $strategy->setConfig($this->config);
        return $strategy;
    }
}