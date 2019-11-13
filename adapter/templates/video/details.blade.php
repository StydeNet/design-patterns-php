<div class="card">
    <div class="card-header">{{ $video->getTitle() }}</div>
    <div class="card-body">
        <p>
            Duración: {{ $video->getFormattedLength() }}
        </p>
        <p>
            Likes: {{ $video->getLikes() }}
        </p>
    </div>
</div>
