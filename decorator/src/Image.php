<?php

namespace Styde;

class Image
{
    protected $path;
    private $width;
    private $height;
    private $grayscale;
    private $framed;

    public function __construct($path, $width = null, $height = null, $grayscale = false, $framed = false)
    {
        $this->path = $path;
        $this->width = $width;
        $this->height = $height;
        $this->grayscale = $grayscale;
        $this->framed = $framed;
    }

    public function draw()
    {
        $img = imagecreatefromjpeg($this->path);

        if ($this->width && $this->height) {
            $img = imagescale($img, $this->width, $this->height);
        }

        if ($this->grayscale) {
            imagefilter($img, IMG_FILTER_GRAYSCALE);
        }

        if ($this->framed) {
            for ($i = 0; $i < $this->framed; $i++) {
                imagerectangle($img, $i, $i, imagesx($img) - $i - 1, imagesy($img) - $i - 1, imagecolorallocate($img, 0, 0, 0));
            }

        }

        return $img;
    }
}