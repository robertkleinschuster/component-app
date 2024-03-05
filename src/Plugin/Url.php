<?php

declare(strict_types=1);

namespace Zenith\Plugin;

readonly class Url
{
    public function __construct(private string $route, private array $params = [], private array $queryParmas = [])
    {
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getQueryParmas(): array
    {
        return $this->queryParmas;
    }
}