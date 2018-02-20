<?php

namespace Styde\Html;

class Legend extends PairedElement
{
    public function __construct(string $text)
    {
        $this->add(new TextElement($text));
    }

    public function tagName()
    {
        return 'legend';
    }
}