<?php

namespace Styde\Tests;

use Styde\Adapter\VideoGateway;
use Vimeo\Vimeo;
use Styde\Adapter\VimeoGateway;

class VimeoGatewayTest extends VideoGatewayTest
{
    protected function createVideoGateway(): VideoGateway
    {
        return new VimeoGateway(
            new Vimeo(VIMEO_CLIENT_ID, VIMEO_CLIENT_SECRET)
        );
    }

    protected function expectedAttributes(): array
    {
        return [
            'id' => '3696',
            'title' => 'Helper ddd',
            'length' => 225,
            'likes' => 10,
            'views' => 100,
        ];
    }
}
