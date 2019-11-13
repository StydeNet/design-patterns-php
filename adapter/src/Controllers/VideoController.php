<?php

use Vimeo\Vimeo;
use Framework\Request;
use YouTube\YouTubeService;
use YouTube\Client as YouTubeClient;

class VideoController extends Controller
{
    public function show(\Styde\Adapter\VimeoAdapter $vimeo, YouTubeService $youtube, YouTubeClient $youTubeClient, Request $request)
    {
        // TODO: add validation here.

        if ($request->get('service') == 'vimeo') {
            try {
                $video = $vimeo->getVideo($request->get('video_id'));
            } catch (\Styde\Adapter\VideoNotFoundException $exception) {
                abort('There was a problem fetching the video information', 404);
            }
        } elseif ($request->get('service') == 'youtube') {
            try {
                $video = $youtube->getVideo($request->get('video_id'), $youTubeClient);
            } catch (\YouTube\VideoNotFoundException $exception) {
                abort('There was a problem fetching the video information', 404);
            }
        } else {
            abort('Invalid Service', 404);
        }

        return view('video/details', ['video' => $video]);
    }

    public function stats(User $user)
    {
        $videos = $user->getVideos(); // Get all videos from YouTube and Vimeo and merge the result.

        $likes = array_reduce($videos, function ($carry, $video) {
            if (is_array($video) && isset ($video['video_likes'])) {
                return $carry + $video['video_likes'];
            } elseif ($video instanceof \YouTube\Video) {
                return $carry + $video->getLikes();
            } else {
                return $carry;
            }
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
