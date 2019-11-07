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
    protected $youtube;

    protected function setUp(): void
    {
        parent::setUp();

        $googleClient = new Client;
        $googleClient->setClientId(GOOGLE_CLIENT_ID);
        $googleClient->setClientSecret(GOOGLE_CLIENT_SECRET);

        $this->youtube = new YouTubeService($googleClient);
    }

    /** @test */
    function get_the_stats_of_a_youtube_video()
    {
        // TODO: Upload video first?

        $video = $this->youtube->getVideo('woHypKQ0yBg');

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
            $video = $this->youtube->getVideo('invalid-id');
        } catch (VideoNotFoundException $exception) {
            $this->assertTrue(true);
            return;
        }

        $this->fail('VideoNotFoundException was not thrown');
    }
}
