<?php

namespace Styde\Html;

class Legend extends PairedElement
{
    public function __construct($text)
    {
        $this->add($text);
    }

    public function tagName()
    {
        return 'legend';
    }
}