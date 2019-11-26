<?php

namespace Styde\Tests;

use Vimeo\Response;
use Vimeo\Vimeo;
use Mockery as m;
use Styde\Adapter\Video;
use Styde\Adapter\VimeoGateway;
use Styde\Adapter\VideoNotFoundException;

class MockVimeoGatewayTest extends TestCase
{
    /**
     * @var Vimeo
     */
    protected $gateway;

    /**
     * @var m\LegacyMockInterface|m\MockInterface|Vimeo
     */
    protected $vimeo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->vimeo = m::mock(Vimeo::class);

        $this->gateway = new VimeoGateway($this->vimeo);
    }

    /** @test */
    function get_the_stats_of_a_vimeo_video()
    {
        $this->vimeo
            ->shouldReceive('request')
            ->with('vimeo/3696', [], 'GET')
            ->once()
            ->andReturn(new Response([
                'id' => '3696',
                'video_title' => 'Helper ddd',
                'video_length' => '03:45',
                'video_likes' => 10,
                'video_views' => 100,
            ], 200));

        $video = $this->gateway->getVideo('3696');

        $this->assertInstanceOf(Video::class, $video);

        $this->assertSame('3696', $video->getId());
        $this->assertSame('Helper ddd', $video->getTitle());
        $this->assertSame(225, $video->getLength()); // '03:45'
        $this->assertSame(10, $video->getLikes());
        $this->assertSame(100, $video->getViews());
    }

    /** @test */
    function get_404_response_when_video_is_not_found()
    {
        $this->vimeo->shouldReceive('request')
            ->with('vimeo/invalid-id', [], 'GET')
            ->once()
            ->andReturn(new Response([], 404));

        try {
            $video = $this->gateway->getVideo('invalid-id');
        } catch (VideoNotFoundException $exception) {
            $this->assertTrue(true);
            return;
        }

        $this->fail('VideoNotFoundException was not thrown');
    }
}
