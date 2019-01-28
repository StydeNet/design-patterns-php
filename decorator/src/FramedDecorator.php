<?php

namespace Styde;

class FramedDecorator
{
    protected $image;
    protected $thickness;

    public function __construct($filename, $thickness)
    {
        $this->image = Image::make($filename);

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