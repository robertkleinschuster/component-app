<?php

declare(strict_types=1);

namespace Zenith;

class AppConfig
{
    public const ENVIRONMENT = 'ENVIRONMENT';
    public const DEPLOY_KEY = 'DEPLOY_KEY';
    private array $config;

    private array $default = [
        self::ENVIRONMENT => 'development'
    ];

    public function __construct(string $path)
    {
        $this->config = require $path;
    }

    public function get(string $key): string
    {
        $key = strtoupper($key);
        return $this->config[$key] ?? $this->default[$key];
    }

    public function is(string $key, string $value): bool
    {
        $key = strtoupper($key);
        return isset($this->config[$key]) && $this->config[$key] === $value
            || isset($this->default[$key]) && $this->default[$key] == $value;
    }
}