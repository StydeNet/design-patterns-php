<?php

namespace Styde\Adapter;

abstract class AbstractVideo implements Video
{
    protected $id;

    protected $title;
    protected $length;
    protected $views;
    protected $likes;

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
