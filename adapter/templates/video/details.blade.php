<div class="card">
    @if (is_array ($video) && isset($video['service']) && $video['service'] == 'vimeo')
        <div class="card-header">{{ $video['video_title'] }}</div>
        <div class="card-body">
            <p>
                Duración: {{ $video['video_length'] }}
            </p>
            <p>
                Likes: {{ $video['video_likes'] }}
            </p>
        </div>
    @elseif($video instanceof YouTube\Video)
        <div class="card-header">{{ $video->getTitle() }}</div>
        <div class="card-body">
            <p>
                Duración: {{ $video->getLength() }}
            </p>
            <p>
                Likes: {{ $video->getLikes() }}
            </p>
        </div>
    @endif
</div>
