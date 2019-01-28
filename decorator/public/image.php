<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__.'/../vendor/autoload.php';

use Styde\ImageJpeg;

$image = ImageJpeg::make(assets_path('img/decorator.jpeg'), 1000, 666, true, 10);

header('Content-Type: image/jpeg');
imagejpeg($image->draw());