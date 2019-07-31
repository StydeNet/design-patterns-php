<?php

namespace Styde\Strategy;

interface ConfigInterface
{
    public function initialize(array $items = []);

    public function set($key, $value);

    public function get($key, $default = null);

    public function has($key);
}
