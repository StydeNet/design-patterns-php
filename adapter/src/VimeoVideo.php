<?php

namespace Styde\Adapter;

class VimeoVideo implements Video
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
        return $this->attributes['video_title'];
    }

    public function getLength(): int
    {
        return strtotime('1970-01-01 00:'.$this->attributes['video_length']);
    }

    public function getLikes()
    {
        return $this->attributes['video_likes'];
    }

    public function getViews()
    {
        return $this->attributes['video_views'];
    }
}




