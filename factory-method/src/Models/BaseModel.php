<?php

namespace Styde\Models;

abstract class BaseModel
{
    public $wasRecentlyCreated;

    protected $attributes = [];

    protected $unguarded = false;

    protected $fillable = [];

//    public static function create(array $attributes)
//    {
//        $model = new static;
//
//        $model->setAttributes($attributes);
//
//        $model->save();
//
//        return $model;
//    }
//
//    public static function forceCreate(array $attributes)
//    {
//        $model = new static;
//
//        $model->unguard();
//
//        $model->setAttributes($attributes);
//
//        $model->reguard();
//
//        $model->save();
//
//        return $model;
//    }

    public function __construct(array $attributes = [])
    {
        $this->setAttributes($attributes);
    }

    public function fill(array $attributes)
    {
        return $this->setAttributes($attributes);
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
