<?php

require_once __DIR__.'/../bootstrap/app.php';

use Styde\ImagePng;

$image = new ImagePng(assets_path('img/tower-bridge.png'));

$image->display();