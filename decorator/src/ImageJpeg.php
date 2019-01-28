<?php

namespace Styde;

class ImageJpeg implements Image
{
    protected $path;

    public static function make($path, $width = null, $height = null, $grayscale = false, $framed = false)
    {
        $image = new static($path);

        if ($width && $height) {
            $image = new ResizeDecorator($image, $width, $height);
        }

        if ($grayscale) {
            $image = new GrayscaleDecorator($image);
        }

        if ($framed) {
            $image = new FramedDecorator($image, $framed);
        }

        return $image;
    }

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function draw()
    {
        $img = imagecreatefromjpeg($this->path);

        return $img;
    }
}