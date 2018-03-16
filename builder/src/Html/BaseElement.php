<?php

namespace Styde\Html;

abstract class BaseElement implements Element
{
    /**
     * @var \Styde\Html\Element
     */
    protected $parent;

    /**
     * @var \Styde\Html\HtmlAttributes
     */
    protected $attributes;

    /**
     * @var string
     */
    protected $cachedHtml;

    public function __construct(array $attributes = [])
    {
        $this->attributes = new HtmlAttributes($attributes);
    }

    abstract public function tagName();

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
