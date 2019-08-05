<?php


namespace Styde;


class ResizeDecorator extends ImageDecorator
{
    protected $width;
    protected $height;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function draw($image)
    {
        return imagescale($image, $this->width, $this->height);
    }
}