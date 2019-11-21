<?php

namespace Styde\Adapter;

class FakeVideo extends AbstractVideo
{
    public function __construct(array $attributes)
    {
        $this->id = $attributes['id'];

        $this->title = $attributes['title'];

        $this->length = $attributes['length'];

        $this->views = $attributes['views'];

        $this->likes = $attributes['likes'];
    }
}
