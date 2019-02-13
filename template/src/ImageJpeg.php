<?php

namespace Styde;

class ImageJpeg
{
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function draw()
    {
        return imagecreatefromjpeg($this->path);
    }
}
