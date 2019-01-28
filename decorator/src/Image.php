<?php

namespace Styde;

class Image
{
    protected $path;
    protected $framed;

    public static function make($path, $width = null, $height = null, $grayscale = false, $framed = false)
    {
        if ($width && $height) {
            return new ResizeDecorator($path, $width, $height, $framed);
        }

        if ($grayscale) {
            return new GrayscaleDecorator($path, $framed);
        }

        if ($framed) {
            return new FramedDecorator($path, $framed);
        }

        return new static($path, $framed);
    }

    protected function __construct($path, $framed = false)
    {
        $this->path = $path;
        $this->framed = $framed;
    }

    public function draw()
    {
        $img = imagecreatefromjpeg($this->path);

        return $img;
    }
}