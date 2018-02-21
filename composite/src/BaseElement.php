<?php

namespace Styde\Html;

abstract class BaseElement implements Element
{
    protected $parent;

    protected $cachedHtml;

    abstract public function tagName();
    
    public function attributes()
    {
        return '';
    }

    public function setParent(Element $parent)
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
