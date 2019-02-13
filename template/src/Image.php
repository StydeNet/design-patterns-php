<?php

namespace Styde;

abstract class Image
{
    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function display()
    {
        $img = $this->createResource();
        $this->sendHeaders();
        $this->beforeDisplay($img);
        $this->doDisplay($img);
    }

    protected function beforeDisplay($img)
    {
        //...
    }

    abstract protected function createResource();

    protected function sendHeaders()
    {
        header('Content-Type: '.$this->contentType());
    }

    abstract protected function contentType();

    abstract protected function doDisplay($img);
}
