<?php

namespace Styde;

abstract class ImageDecorator implements Image
{
    protected $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function draw()
    {
        return $this->image->draw();
    }
}
