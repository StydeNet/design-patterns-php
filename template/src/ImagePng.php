<?php

namespace Styde;

class ImagePng
{
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function draw()
    {
        return imagecreatefrompng($this->filename);
    }
}
