<?php

namespace Styde\Tests;

use Styde\Adapter\FakeVideoGateway;
use Styde\Adapter\VideoGateway;

class FakeVideoGatewayTest extends VideoGatewayTest
{
    protected function createVideoGateway(): VideoGateway
    {
        return (new FakeVideoGateway)
            ->addVideo($this->expectedAttributes());
    }

    protected function expectedAttributes(): array
    {
        return [
            'id' => '1234',
            'title' => 'Fake Video',
            'length' => 180,
            'views' => 100,
            'likes' => 10,
        ];
    }
}
