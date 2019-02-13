<?php

require_once __DIR__.'/../bootstrap/app.php';

$img = imagecreatefromjpeg(assets_path('img/tower-bridge.jpg'));
header('Content-Type: image/jpeg');
imagejpeg($img);
