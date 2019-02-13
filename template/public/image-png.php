<?php

require_once __DIR__.'/../bootstrap/app.php';

$img = imagecreatefrompng(assets_path('img/tower-bridge.png'));
header('Content-Type: image/png');
imagepng($img);
