<?php


namespace Styde;


class ImageJpeg extends Image
{
    protected $path;
    protected $image;

    public function __construct($path)
    {
        $this->path = $path;
        $this->image = imagecreatefromjpeg($this->path);
    }

    public function draw()
    {
        parent::draw();
        return $this->image;
    }
}