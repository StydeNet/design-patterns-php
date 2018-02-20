<?php

namespace Styde\Html;

use Exception;

abstract class PairedElement
{
    protected $children = [];

    abstract public function tagName();
    
    public function add($element)
    {
        $this->children[] = $element;
    }

    public function getChild($index)
    {
        return $this->children[$index];
    }

    public function remove($element)
    {
        $index = array_search($element, $this->children, true);

        if (is_int($index)) {
            array_splice($this->children, $index, 1);
        }
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function render()
    {
        $html = '<'.$this->tagName().$this->attributes().'>';

        foreach ($this->children as $child) {
            if (is_string($child)) {
                $html .= $child;
            } else if ($child instanceof PairedElement) {
                $html .= $child->render();
            } else if ($child instanceof VoidElement) {
                $html .= $child->renderTag();
            } else {
                throw new Exception('Format not supported: '.get_class($child));
            }
        }
        
        $html .= '</'.$this->tagName().'>';

        return $html;
    }

    public function attributes()
    {
        return '';
    }
}