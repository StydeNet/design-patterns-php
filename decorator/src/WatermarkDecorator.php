<?php


namespace Styde;


class WatermarkDecorator extends ImageDecorator
{
    private $bottonMargin;
    private $rightMargin;

    public function __construct($bottonMargin = 0, $rightMargin = 0)
    {
        $this->bottonMargin = $bottonMargin;
        $this->rightMargin = $rightMargin;
    }

    public function draw($image)
    {
        $estampa = imagecreatefrompng(assets_path('img/depau.png'));

        $sx = imagesx($estampa);
        $sy = imagesy($estampa);

        imagecopy(
            $image,
            $estampa,
            imagesx($image) - $sx - $this->rightMargin,
            imagesy($image) - $sy - $this->bottonMargin,
            0,
            0,
            imagesx($estampa),
            imagesy($estampa)
        );

        return $image;
    }
}