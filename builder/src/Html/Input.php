<?php

namespace Styde\Html;

class Input extends VoidElement
{
    public function __construct($name, array $attributes = [])
    {
        parent::__construct(['name' => $name] + $attributes);
    }

    public function tagName()
    {
        return 'input';
    }
}
