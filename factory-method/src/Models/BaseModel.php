<?php

namespace Styde\Models;

class BaseModel
{
    public $wasRecentlyCreated;

    protected $attributes = [];

    protected $unguarded = false;

    protected $fillable = [];

    public function __construct(array $attributes = [])
    {
        $this->setAttributes($attributes);
    }

    public function setAttributes(array $attributes)
    {
        if ($this->unguarded) {
            $this->attributes = $attributes;
        } else {
            $this->attributes = array_intersect_key($attributes, array_flip($this->fillable));
        }
    }

    public function unguard()
    {
        $this->unguarded = true;
    }

    public function reguard()
    {
        $this->unguarded = false;
    }

    public function save()
    {
        $this->wasRecentlyCreated = true;
    }

    public function __get($key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }
}
