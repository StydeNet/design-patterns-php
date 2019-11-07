<?php

namespace Styde\Tests;

use Vimeo\Vimeo;

class VimeoTest extends TestCase
{
    /**
     * @var Vimeo
     */
    protected $vimeo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->vimeo = new Vimeo(VIMEO_CLIENT_ID, VIMEO_CLIENT_SECRET);
    }

    /** @test */
    function get_the_stats_of_a_vimeo_video()
    {
        // TODO: Upload video first?

        $response = $this->vimeo->request('vimeo/3696', [], 'GET');

        $this->assertSame(200, $response->status);

        $expectedBody = [
            'id' => '3696',
            'video_title' => 'Helper ddd',
            'video_length' => '03:45',
            'video_likes' => 10,
            'video_views' => 100,
        ];
        $this->assertSame($expectedBody, $response->body);
    }

    /** @test */
    function get_404_response_when_video_is_not_found()
    {
        $response = $this->vimeo->request('vimeo/invalid-id', [], 'GET');

        $this->assertSame(404, $response->status);
        $this->assertSame([], $response->body);
    }
}
