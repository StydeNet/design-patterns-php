<?php

namespace Styde\Html;

abstract class VoidElement extends BaseElement
{
    use HasAttributes;

    public function getComposite()
    {
        $composite = new Div;

        $composite->add($this);

        return $composite;
    }

    public function render()
    {
        return '<'.$this->tagName().$this->attributes().'>';
    }
}