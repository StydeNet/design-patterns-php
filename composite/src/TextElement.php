<?php

namespace Styde\Html;

class TextElement implements Element
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

    public function clearCache()
    {
        // TODO: add a test for this implementation.
        if ($this->parent) {
            $this->parent->clearCache();
        }
    }

    public function setParent(Element $parent)
    {
        $this->parent = $parent;
    }
}