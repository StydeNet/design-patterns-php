<?php

namespace Styde\Html;

abstract class VoidElement
{
    abstract public function tagName();

    public function renderTag()
    {
        return '<'.$this->tagName().$this->attributes().'>';
    }

    public function attributes()
    {
        return '';
    }
}