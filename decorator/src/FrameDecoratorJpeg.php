<?php


namespace Styde;


class FrameDecoratorJpeg extends ImageDecorator
{
    protected $thickness;

    public function __construct($thickness = 1)
    {
        $this->thickness = $thickness;
    }

    public function draw($image)
    {
        return $this->addBorder($image);
    }

    public function addBorder($img)
    {
        for ($i = 0; $i < $this->thickness; $i++) {
            imagerectangle($img, $i, $i, imagesx($img) - $i - 1, imagesy($img) - $i - 1, imagecolorallocate($img, 255, 255, 255));
        }

        return $img;
    }
}