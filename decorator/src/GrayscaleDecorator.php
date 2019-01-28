<?php

namespace Styde;

class GrayscaleDecorator extends Image
{
    public function draw()
    {
        $img = parent::draw();

        imagefilter($img, IMG_FILTER_GRAYSCALE);

        return $img;
    }
}
