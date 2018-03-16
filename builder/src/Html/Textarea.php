<?php

namespace Styde\Html;

class Textarea extends PairedElement
{
    public function __construct($name)
    {
        parent::__construct(['name' => $name]);
    }

    public function tagName()
    {
        return 'textarea';
    }
}
