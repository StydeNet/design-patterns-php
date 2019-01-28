<?php

namespace Styde;

class GrayscaleDecorator
{
    protected $image;

    public function __construct($filename)
    {
        $this->image = Image::make($filename);
    }

    public function draw()
    {
        $img = $this->image->draw();

        imagefilter($img, IMG_FILTER_GRAYSCALE);

        return $img;
    }
}
