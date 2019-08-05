<?php
require __DIR__ . '/../vendor/autoload.php';

use Styde\ImageJpeg;

$image = ImageJpeg::make(assets_path('img/decorator.jpeg'),1000,666,false,20);

header('Content-type: jpeg');
imagejpeg($image->draw());