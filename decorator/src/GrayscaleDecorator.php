<?php


namespace Styde;


class GrayscaleDecorator extends ImageDecorator
{
    public function draw()
    {
        $img = $this->image->draw();

        imagefilter($img, IMG_FILTER_GRAYSCALE);

        return $img;
    }
}