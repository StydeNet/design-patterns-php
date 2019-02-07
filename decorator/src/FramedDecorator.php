<?php

namespace Styde;

class FramedDecorator extends ImageDecorator
{
    protected $thickness;

    public function __construct(Image $image, $thickness = 1)
    {
        parent::__construct($image);

        $this->thickness = $thickness;
    }

    public function draw()
    {
        return $this->addBorder(parent::draw());
    }

    protected function addBorder($img)
    {
        for ($i = 0; $i < $this->thickness; $i++) {
            imagerectangle($img, $i, $i, imagesx($img) - $i - 1, imagesy($img) - $i - 1, imagecolorallocate($img, 0, 0, 0));
        }

        return $img;
    }
}