<?php


namespace Styde;


class Image
{
    protected $image;
    protected $decorators = [];

    public function setDecorator(ImageDecorator $decorator)
    {
        $this->decorators[] = $decorator;
    }

    public function draw()
    {
        foreach ($this->decorators as $decorator){
            $this->image = $decorator->draw($this->image);
        }
    }
}