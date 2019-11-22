<?php

namespace Styde\Adapter;

class Video
{
    protected $id;

    protected $title;
    protected $length;
    protected $views;
    protected $likes;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];
        $this->title = $attributes['title'];
        $this->length = $attributes['length'];
        $this->views = $attributes['views'];
        $this->likes = $attributes['likes'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getLikes()
    {
        return $this->likes;
    }

    public function getViews()
    {
        return $this->views;
    }
}
