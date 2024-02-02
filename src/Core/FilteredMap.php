<?php

namespace Shopi\Core;

use http\Exception\InvalidArgumentException;

class FilteredMap
{
    private $map;

    public function __construct(array $baseMap)
    {
        $this->map = $baseMap;
    }

    public function has(string $name): bool
    {
        return !!$this->map[$name];
    }

    public function get(string $name)
    {
        return $this->map[$name] ?? null;
    }
}