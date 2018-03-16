<?php

namespace Styde\Html;

class HtmlAttributes
{
    /**
     * @var array
     */
    public $attributes;

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function render(): string
    {
        return array_reduce(array_keys($this->attributes), function ($result, $attribute) {
            return $result . $this->renderAttribute($attribute);
        }, '');
    }

    protected function renderAttribute($attribute)
    {
        if (is_numeric($attribute)) {
            return ' '.$this->attributes[$attribute];
        }

        return ' '.$attribute.'="'.htmlentities($this->attributes[$attribute], ENT_QUOTES, 'UTF-8').'"'; // name="value"
    }
}
