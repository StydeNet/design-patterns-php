<?php

namespace Styde\Adapter;

class FakeVideo implements Video
{
    /**
     * @var array
     */
    private $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function getTitle()
    {
        return $this->attributes['title'];
    }

    public function getLength(): int
    {
        return $this->attributes['length'];
    }

    public function getLikes()
    {
        return $this->attributes['likes'];
    }

    public function getViews()
    {
        return $this->attributes['views'];
    }
}
