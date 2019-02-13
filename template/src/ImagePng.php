<?php

namespace Styde;

class ImagePng extends Image
{
    protected function createResource()
    {
        return imagecreatefrompng($this->filename);
    }

    protected function contentType()
    {
        return 'image/png';
    }

    protected function doDisplay($img)
    {
        imagepng($img);
    }
}
