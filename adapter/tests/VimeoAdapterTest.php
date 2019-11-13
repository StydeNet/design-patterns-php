<?php

namespace Styde\Tests;

use Vimeo\Vimeo;
use Styde\Adapter\VimeoVideo;
use Styde\Adapter\VimeoAdapter;
use Styde\Adapter\VideoNotFoundException;

class VimeoAdapterTest extends TestCase
{
    /**
     * @var Vimeo
     */
    protected $vimeo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->vimeo = new VimeoAdapter(
            new Vimeo(VIMEO_CLIENT_ID, VIMEO_CLIENT_SECRET)
        );
    }

    /** @test */
    function get_the_stats_of_a_vimeo_video()
    {
        // TODO: Upload video first?

        $video = $this->vimeo->getVideo('3696');

        $this->assertInstanceOf(VimeoVideo::class, $video);

        $this->assertSame('3696', $video->getId());
        $this->assertSame('Helper ddd', $video->getTitle());
        $this->assertSame('03:45', $video->getLength());
        $this->assertSame(10, $video->getLikes());
        $this->assertSame(100, $video->getViews());
    }

    /** @test */
    function get_404_response_when_video_is_not_found()
    {
        try {
            $video = $this->vimeo->getVideo('invalid-id');
        } catch (VideoNotFoundException $exception) {
            $this->assertTrue(true);
            return;
        }

        $this->fail('VideoNotFoundException was not thrown');
    }
}
