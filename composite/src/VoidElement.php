<?php

namespace Styde\Html;

abstract class VoidElement extends BaseElement
{
    public function render()
    {
        return '<'.$this->tagName().$this->attributes().'>';
    }
}