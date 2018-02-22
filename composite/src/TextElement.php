<?php

namespace Styde\Html;

class TextElement extends BaseElement
{
    protected $text;

    protected $parent;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function replaceText($text)
    {
        // TODO: Add a test for this implementation.

        $this->text = $text;

        $this->clearCache();
    }

    public function getComposite()
    {
        return null;
    }

    public function render()
    {
        return $this->text;
    }

    public function tagName()
    {
        return '#text';
    }
}