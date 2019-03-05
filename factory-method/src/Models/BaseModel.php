<?php

namespace Styde\Models;

abstract class BaseModel
{
    public $wasRecentlyCreated;

    protected $attributes = [];

    protected $unguarded = false;

    protected $fillable = [];

    public static function create(array $attributes)
    {
        $user = new static;

        $user->setAttributes($attributes);

        $user->save();

        return $user;
    }

    public static function forceCreate(array $attributes)
    {
        $user = new static;

        $user->unguard();

        $user->setAttributes($attributes);

        $user->reguard();

        $user->save();

        return $user;
    }

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

        return $this;
    }

    public function unguard()
    {
        $this->unguarded = true;

        return $this;
    }

    public function reguard()
    {
        $this->unguarded = false;

        return $this;
    }

    public function save()
    {
        $this->wasRecentlyCreated = true;

        return $this;
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
