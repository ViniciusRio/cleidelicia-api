<?php

namespace Core;

class Container
{
    protected array $bindings = [];

    public function bind($key, $fn): void
    {
        $this->bindings[$key] = $fn;
    }

    public function resolve($key)
    {
        return call_user_func($this->bindings[$key]);
    }
}