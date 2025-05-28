<div>
    @if($posts->count())
        <div class="grid grid-cols-2 p-1 md:grid-cols-3 gap-2">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['post'=>$post, 'user'=>$post->user]) }}">
                        <img src="{{ asset('uploads').'/'.$post->imagen}}" alt="imagen del post {{$post->titulo}}">
                    </a>
                </div>
            @endforeach
        </div>
        <div class="my-5">
            {{ $posts->links() }}
        </div>      
    @else
        <p class="text-center">No hay posts</p>
    @endif
</div>