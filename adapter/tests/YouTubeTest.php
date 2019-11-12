<?php

namespace Styde\Tests;

use YouTube\Client;
use YouTube\VideoNotFoundException;
use YouTube\YouTubeService;

class YouTubeTest extends TestCase
{
    /**
     * @var YouTubeService
     */
    protected $youTube;
    /**
     * @var Client
     */
    protected $youTubeClient;

    protected function setUp(): void
    {
        parent::setUp();

        $this->youTubeClient = new Client;
        $this->youTubeClient->setClientId(GOOGLE_CLIENT_ID);
        $this->youTubeClient->setClientSecret(GOOGLE_CLIENT_SECRET);

        $this->youTube = new YouTubeService();
    }

    /** @test */
    function get_the_stats_of_a_youtube_video()
    {
        // TODO: Upload video first?

        $video = $this->youTube->getVideo('woHypKQ0yBg', $this->youTubeClient);

        $this->assertSame('woHypKQ0yBg', $video->getId());
        $this->assertSame('Mejora el estilo de tu código PHP automáticamente', $video->getTitle());
        $this->assertSame(460, $video->getLength());
        $this->assertSame(42, $video->getLikes());
        $this->assertSame(611, $video->getViews());
    }

    /** @test */
    function throw_video_not_found_exception()
    {
        try {
            $video = $this->youTube->getVideo('invalid-id', $this->youTubeClient);
        } catch (VideoNotFoundException $exception) {
            $this->assertTrue(true);
            return;
        }

        $this->fail('VideoNotFoundException was not thrown');
    }
}
