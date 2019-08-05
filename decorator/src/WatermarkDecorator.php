<?php


namespace Styde;


class WatermarkDecorator extends ImageDecorator
{
    private $leftMargin;
    private $rightMargin;

    public function __construct(Image $image, $bottonMargin = 0, $rightMargin = 0)
    {
        $this->bottonMargin = $bottonMargin;
        $this->rightMargin = $rightMargin;

        parent::__construct($image);
    }

    public function draw()
    {
        $im = $this->image->draw();
        $estampa = imagecreatefrompng(assets_path('img/depau.png'));

        $sx = imagesx($estampa);
        $sy = imagesy($estampa);

        imagecopy(
            $im,
            $estampa,
            imagesx($im) - $sx - $this->rightMargin,
            imagesy($im) - $sy - $this->bottonMargin,
            0,
            0,
            imagesx($estampa),
            imagesy($estampa)
        );

        return $im;
    }
}