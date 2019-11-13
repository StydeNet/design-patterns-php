<?php

namespace Styde\Adapter;

use Vimeo\Vimeo;

class VimeoAdapter
{
    /**
     * @var Vimeo
     */
    private $vimeo;

    public function __construct(Vimeo $vimeo)
    {
        $this->vimeo = $vimeo;
    }

    public function getVideo($id)
    {
        $response = $this->vimeo->request("vimeo/{$id}", [], 'GET');

        if ($response->status != 200) {
            throw new VideoNotFoundException;
        }

        return new VimeoVideo($response->body);
    }
}
