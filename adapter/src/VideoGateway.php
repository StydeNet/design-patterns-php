<?php

namespace Styde\Adapter;

interface VideoGateway
{
    public function getVideo($id): Video;
}
