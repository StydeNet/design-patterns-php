<?php

namespace Styde;

class User
{
    private $attributes;

    public static function create(array $attributes)
    {
        return new static($attributes);
    }

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function __get($attribute)
    {
        return $this->attributes[$attribute] ?? null;
    }
}
