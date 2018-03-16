<?php

namespace Styde\Html;

interface Element
{
    public function setParent(Element $parent);

    public function clearCache();

    public function getComposite();

    public function render();
}
