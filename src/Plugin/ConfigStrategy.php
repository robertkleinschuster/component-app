<?php

declare(strict_types=1);

namespace Zenith\Plugin;

use Zenith\AppConfig;
use Mosaic\FragmentCollection;
use Mosaic\Renderer;
use Mosaic\Strategy\Base\PipelineStrategy;

class ConfigStrategy extends PipelineStrategy
{
    private AppConfig $config;

    public function setConfig(AppConfig $config): void
    {
        $this->config = $config;
    }

    public function execute(mixed $view, Renderer $renderer, mixed $data): FragmentCollection
    {
        if ($view instanceof Config) {
            return $view->call($renderer, $this->config, $data);
        }

        return $this->next($view, $renderer, $data);
    }
}