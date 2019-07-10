<?php

namespace Styde\Strategy;

use InvalidArgumentException;

abstract class Manager
{
    protected $defaultDriver;

    public function driver($driver = null)
    {
        if ($driver == null) {
            $driver = $this->getDefaultDriver();
        }

        if (method_exists($this, $method = 'create' . ucfirst($driver) . 'Driver')) {
            return $this->{$method}();
        }

        throw new InvalidArgumentException('Driver [invalid] not found.');
    }

    protected function getDefaultDriver()
    {
        return $this->defaultDriver;
    }
}
