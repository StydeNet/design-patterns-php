<?php

namespace Styde\Adapter;

class VimeoVideo extends AbstractVideo
{
    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];

        $this->title = $attributes['video_title'];

        $this->length = strtotime('1970-01-01 00:'.$attributes['video_length']);

        $this->views = $attributes['video_views'];

        $this->likes = $attributes['video_likes'];
    }
}




