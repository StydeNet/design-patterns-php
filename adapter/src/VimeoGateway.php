<?php

namespace Styde\Adapter;

use Vimeo\Vimeo;

class VimeoGateway implements VideoGateway
{
    /**
     * @var Vimeo
     */
    private $vimeo;

    public function __construct(Vimeo $vimeo)
    {
        $this->vimeo = $vimeo;
    }

    public function getVideo($id): Video
    {
        $response = $this->vimeo->request("vimeo/{$id}", [], 'GET');

        if ($response->status != 200) {
            throw new VideoNotFoundException;
        }

        return $this->createVideo($response->body);
    }

    protected function createVideo(array $attributes)
    {
        return new Video([
            'id' => $attributes['id'],
            'title' => $attributes['video_title'],
            'length' => strtotime('1970-01-01 00:'.$attributes['video_length']),
            'views' => $attributes['video_views'],
            'likes' => $attributes['video_likes'],
        ]);
    }
}
