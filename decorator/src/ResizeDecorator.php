<?php

namespace Styde;

class ResizeDecorator extends ImageDecorator
{
    protected $width;
    protected $height;

    public function __construct(Image $image, $width, $height)
    {
        parent::__construct($image);

        $this->width = $width;
        $this->height = $height;
    }

    public function draw()
    {
        return imagescale(parent::draw(), $this->width, $this->height);
    }
}
