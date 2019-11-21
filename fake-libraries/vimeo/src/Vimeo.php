<?php

namespace Vimeo;

class Vimeo
{
    /**
     * @var string
     */
    private $client_id;

    /**
     * @var string
     */
    private $client_secret;

    /**
     * Vimeo constructor.
     *
     * @param string $client_id
     * @param string $client_secret
     */
    public function __construct(string $client_id, string $client_secret)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
    }

    /**
     * @param string $url
     * @param array $parameters
     * @param string $method
     * @return Response
     */
    public function request(string $url, array $parameters = [], $method = 'GET')
    {
//        sleep(rand(1, 2));

        if ($url == 'vimeo/3696') {
            return new Response([
                'id' => '3696',
                'video_title' => 'Helper ddd',
                'video_length' => '03:45',
                'video_likes' => 10,
                'video_views' => 100,
            ], 200);
        }

        return new Response([], 404);
    }
}
