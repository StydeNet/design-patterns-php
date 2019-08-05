<?php


namespace Styde;


class GrayscaleDecorator extends ImageDecorator
{
    public function draw($image)
    {
        imagefilter($image, IMG_FILTER_GRAYSCALE);

        return $image;
    }
}