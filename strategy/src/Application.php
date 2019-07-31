<?php

namespace Styde\Strategy;

class Application
{
    protected $bootstrappers = [
        LoadConfiguration::class
    ];

    public function bootstrap()
    {
        foreach ($this->bootstrappers as $bootstrapper) {
            (new $bootstrapper)->bootstrap($this);
        }
    }
}
