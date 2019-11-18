<?php

namespace YouTube;

class YouTubeService
{
    /**
     * Get a video.
     *
     * @param $videoId
     * @return Video
     * @throws VideoNotFoundException
     */
    public function getVideo($videoId, Client $client): Video
    {
        sleep(rand(1, 2));

        $client->connect();

        if ($videoId == 'woHypKQ0yBg') {
            return new Video([
                'id' => 'woHypKQ0yBg',
                'title' => 'Mejora el estilo de tu código PHP automáticamente',
                'length' => 460,
                'likes' => 42,
                'views' => 611,
            ]);
        }

        if ($videoId == 'NJCUrDbUEN4') {
            return new Video([
                'id' => 'woHypKQ0yBg',
                'title' => 'Mejora el estilo de tu código PHP automáticamente',
                'length' => 225,
                'likes' => 14,
                'views' => 430,
            ]);
        }

        throw new VideoNotFoundException;
    }
}
