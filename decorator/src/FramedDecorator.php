<?php

namespace Styde;

class FramedDecorator implements Image
{
    protected $image;
    protected $thickness;

    public function __construct(Image $image, $thickness = 1)
    {
        $this->image = $image;

        $this->thickness = $thickness;
    }

    public function draw()
    {
        return $this->addBorder($this->image->draw());
    }

    protected function addBorder($img)
    {
        for ($i = 0; $i < $this->thickness; $i++) {
            imagerectangle($img, $i, $i, imagesx($img) - $i - 1, imagesy($img) - $i - 1, imagecolorallocate($img, 0, 0, 0));
        }

        return $img;
    }
}