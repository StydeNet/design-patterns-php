<?php

namespace Styde\Adapter;

class FakeVideoGateway implements VideoGateway
{
    protected $videos = [];

    public function addVideo(array $attributes)
    {
        $this->videos[$attributes['id']] = new FakeVideo($attributes);

        return $this;
    }

    public function getVideo($id): Video
    {
        if (! array_key_exists($id, $this->videos)) {
            throw new VideoNotFoundException;
        }

        return $this->videos[$id];
    }
}
