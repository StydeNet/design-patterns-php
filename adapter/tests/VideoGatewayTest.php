<?php

namespace Styde\Tests;

use Styde\Adapter\Video;
use Styde\Adapter\VideoGateway;
use Styde\Adapter\VideoNotFoundException;

abstract class VideoGatewayTest extends TestCase
{
    /**
     * @var VideoGateway
     */
    protected $videoGateway;

    protected function setUp(): void
    {
        parent::setUp();

        $this->videoGateway = $this->createVideoGateway();
    }

    abstract protected function createVideoGateway(): VideoGateway;

    /** @test */
    function get_the_stats_of_a_video()
    {
        // TODO: Upload video first?

        $expectedAttributes = $this->expectedAttributes();

        $video = $this->videoGateway->getVideo($expectedAttributes['id']);

        $this->assertInstanceOf(Video::class, $video);

        $this->assertSame($expectedAttributes['id'], $video->getId());
        $this->assertSame($expectedAttributes['title'], $video->getTitle());
        $this->assertSame($expectedAttributes['length'], $video->getLength()); // '03:45'
        $this->assertSame($expectedAttributes['likes'], $video->getLikes());
        $this->assertSame($expectedAttributes['views'], $video->getViews());
    }

    abstract protected function expectedAttributes(): array;

    /** @test */
    function throw_video_not_found_exception()
    {
        try {
            $video = $this->videoGateway->getVideo('invalid-id');
        } catch (VideoNotFoundException $exception) {
            $this->assertTrue(true);
            return;
        }

        $this->fail('VideoNotFoundException was not thrown');
    }
}
