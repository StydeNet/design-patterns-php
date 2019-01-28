<?php

namespace Styde;

class ResizeDecorator implements Image
{
    protected $image;
    protected $width;
    protected $height;

    public function __construct(Image $image, $width, $height)
    {
        $this->image = $image;

        $this->width = $width;
        $this->height = $height;
    }

    public function draw()
    {
        return imagescale($this->image->draw(), $this->width, $this->height);
    }
}