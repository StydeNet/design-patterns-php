<?php

namespace Styde\Html;

class TextElement implements Element
{
    public $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function render()
    {
        return $this->text;
    }
}