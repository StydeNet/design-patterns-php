<?php

require_once __DIR__.'/../bootstrap/app.php';

use Styde\ImageJpeg;

$image = new ImageJpeg(assets_path('img/tower-bridge.jpg'));

$image->display();
