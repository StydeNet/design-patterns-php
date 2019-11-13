<?php

namespace Styde\Tests;

use Styde\Adapter\YouTubeGateway;
use Styde\Adapter\YouTubeVideo;
use YouTube\Client;
use Styde\Adapter\VideoNotFoundException;
use YouTube\YouTubeService;

class YouTubeGatewayTest extends TestCase
{
    /**
     * @var YouTubeService
     */
    protected $youTube;

    protected function setUp(): void
    {
        parent::setUp();

        $youTubeClient = new Client;
        $youTubeClient->setClientId(GOOGLE_CLIENT_ID);
        $youTubeClient->setClientSecret(GOOGLE_CLIENT_SECRET);

        $this->youTube = new YouTubeGateway(
            new YouTubeService(), $youTubeClient
        );
    }

    /** @test */
    function get_the_stats_of_a_youtube_video()
    {
        // TODO: Upload video first?

        $video = $this->youTube->getVideo('woHypKQ0yBg');

        $this->assertInstanceOf(YouTubeVideo::class, $video);

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
            $video = $this->youTube->getVideo('invalid-id');
        } catch (VideoNotFoundException $exception) {
            $this->assertTrue(true);
            return;
        }

        $this->fail('VideoNotFoundException was not thrown');
    }
}
