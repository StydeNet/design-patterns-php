<?php

namespace Styde;

class GrayscaleDecorator extends ImageDecorator
{
    public function draw()
    {
        $img = parent::draw();

        imagefilter($img, IMG_FILTER_GRAYSCALE);

        return $img;
    }
}
