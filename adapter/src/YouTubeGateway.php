<?php

namespace Styde\Adapter;

use YouTube\Client;
use YouTube\YouTubeService;

class YouTubeGateway implements VideoGateway
{
    /**
     * @var YouTubeService
     */
    private $youTubeService;
    /**
     * @var Client
     */
    private $client;

    public function __construct(YouTubeService $youTubeService, Client $client)
    {
        $this->youTubeService = $youTubeService;
        $this->client = $client;
    }

    public function getVideo($id): Video
    {
        try {
            $video = $this->youTubeService->getVideo($id, $this->client);
        } catch (\YouTube\VideoNotFoundException $exception) {
            throw new VideoNotFoundException($exception->getMessage());
        }

        return new YouTubeVideo($video);
    }
}
