<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__.'/../vendor/autoload.php';

use Styde\ImageJpeg;
use Styde\FramedDecorator;
use Styde\ResizeDecorator;
use Styde\GrayscaleDecorator;

$image = new ImageJpeg(assets_path('img/decorator.jpeg'));
$image = new ResizeDecorator($image, 1000, 666);
$image = new GrayscaleDecorator($image);
$image = new FramedDecorator($image, 10);

header('Content-Type: image/jpeg');
imagejpeg($image->draw());