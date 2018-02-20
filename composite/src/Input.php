<?php

namespace Styde\Html;

class Input extends VoidElement
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function tagName()
    {
        return 'input';
    }

    public function attributes()
    {
        return sprintf(' name="%s"', $this->name);
    }
}