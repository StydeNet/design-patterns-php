<?php

namespace Styde\Adapter;

use YouTube\Video as AdapteeVideo;

class YouTubeVideo extends AbstractVideo
{
    public function __construct(AdapteeVideo $video)
    {
        $this->id = $video->getId();

        $this->title = $video->getTitle();

        $this->length = $video->getLength();

        $this->views = $video->getViews();

        $this->likes = $video->getLikes();
    }
}
