<?php

namespace Styde\Html;

abstract class BaseElement
{
    protected $parent;

    protected $cachedHtml;

    abstract public function tagName();
    
    abstract public function render();
    
    abstract public function getComposite();

    public function setParent(BaseElement $parent)
    {
        $this->parent = $parent;
    }

    public function clearCache()
    {
        $this->cachedHtml = null;

        if ($this->parent) {
            $this->parent->clearCache();
        }
    }
}
