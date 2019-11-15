<?php

namespace Styde\Tests;

use Styde\Adapter\VideoGateway;
use Styde\Adapter\YouTubeGateway;
use YouTube\Client;
use YouTube\YouTubeService;

class YouTubeGatewayTest extends VideoGatewayTest
{
    protected function createVideoGateway(): VideoGateway
    {
        return new YouTubeGateway(
            new YouTubeService(), $this->createYouTubeClient()
        );
    }

    protected function createYouTubeClient()
    {
        $youTubeClient = new Client;
        $youTubeClient->setClientId(GOOGLE_CLIENT_ID);
        $youTubeClient->setClientSecret(GOOGLE_CLIENT_SECRET);

        return $youTubeClient;
    }

    protected function expectedAttributes(): array
    {
        return [
            'id' => 'woHypKQ0yBg',
            'title' => 'Mejora el estilo de tu código PHP automáticamente',
            'length' => 460,
            'likes' => 42,
            'views' => 611,
        ];
    }
}
