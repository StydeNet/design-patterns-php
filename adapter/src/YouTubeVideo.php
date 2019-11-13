<?php

namespace Styde\Adapter;

use YouTube\Video as AdapteeVideo;

class YouTubeVideo implements Video
{
    /**
     * @var Video
     */
    private $video;

    public function __construct(AdapteeVideo $video)
    {
        $this->video = $video;
    }

    public function getId()
    {
        return $this->video->getId();
    }

    public function getTitle()
    {
        return $this->video->getTitle();
    }

    public function getLength(): int
    {
        return $this->video->getLength();
    }

    public function getLikes()
    {
        return $this->video->getLikes();
    }

    public function getViews()
    {
        return $this->video->getViews();
    }
}
