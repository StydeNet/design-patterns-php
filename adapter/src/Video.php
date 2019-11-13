<?php

namespace Styde\Adapter;

interface Video
{
    public function getId();

    public function getTitle();

    public function getLength(): int;

//    public function getFormattedLength(): string;

    public function getLikes();

    public function getViews();
}
