<?php

namespace Styde;

class ResizeDecorator
{
    protected $image;
    protected $width;
    protected $height;

    public function __construct($filename, $width, $height)
    {
        $this->image = Image::make($filename);

        $this->width = $width;
        $this->height = $height;
    }

    public function draw()
    {
        return imagescale($this->image->draw(), $this->width, $this->height);
    }
}