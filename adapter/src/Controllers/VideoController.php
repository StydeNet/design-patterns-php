<?php

use Vimeo\Vimeo;
use Framework\Request;
use YouTube\YouTubeService;
use YouTube\Client as YouTubeClient;

class VideoController extends Controller
{
    public function show(\Styde\Adapter\VimeoGateway $vimeo, \Styde\Adapter\YouTubeGateway $youtube, Request $request)
    {
        if ($request->get('service') == 'vimeo') {
            $gateway = $vimeo;
        } elseif ($request->get('service') == 'youtube') {
            $gateway = $youtube;
        } else {
            abort('Invalid video gateway', 404);
        }

        try {
            $video = $gateway->getVideo($request->get('video_id'));
        } catch (\Styde\Adapter\VideoNotFoundException $exception) {
            abort('There was a problem fetching the video information', 404);
        }

        return view('video/details', ['video' => $video]);
    }

    public function stats(User $user)
    {
        $videos = $user->getVideos(); // Get all videos from YouTube and Vimeo and merge the result.

        $likes = array_reduce($videos, function ($carry, $video) {
            return $carry + $video->getLikes();
        }, 0);
    }
}












function abort($message, $status)
{
    //...
}

function view($template, $parameters)
{
    return '';
}
