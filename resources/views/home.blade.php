@extends('layouts.app')

@section('titulo')
@endsection

@section('contenido')
    @if($posts->count())
        <div class="grid p-2 md:grid-cols-1 justify-center">
            @foreach ($posts as $post)
                <div class="justify-items-center">
                    <div class="shadow bg-white p-5">
                        <a href="{{ route('posts.show', ['post'=>$post, 'user'=>$post->user]) }}">
                            <img class="w-xl" src="{{ asset('uploads').'/'.$post->imagen}}" alt="imagen del post {{$post->titulo}}">
                        </a>
                        <div class="p-3 flex items-center gap-2">
                            @auth
                                <livewire:like-post :post="$post" />
                                <livewire:comment-post :post="$post" />
                            @endauth
                        </div> 
                        <div>
                            <a href="{{ route('posts.index', $post->user->username )}}" class="cursor-pointer">
                                <p class="font-bold">{{ $post->user->username }} </p>
                            </a>
                            <p class="mb-5">{{ $post->descripcion}}</p>
                            <p class="text-sm text-gray-600">{{ $post->created_at->diffForHumans()}}</p>
                            <div>
                                @if ($post->comentarios->count())
                                    @foreach ($post->comentarios as $comentario)
                                        <div class="p-5 border-gray-300 border-b">
                                            <a class="font-bold" href="{{ route('posts.index', $comentario->user) }}">{{ $comentario->user->username }}</a>
                                            <p>{{ $comentario->comentario }}</p>
                                            <p class="text-sm text-gray-600">{{ $comentario->created_at->diffForHumans() }}</p>
                                        </div>
                                        @break
                                    @endforeach
                                @else
                                    <p class="p-10 text-center">No hay Comentarios</p>
                                @endif
                            </div>     
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="my-5">
            {{ $posts->links() }}
        </div>      
    @else
        <p class="text-center">No hay posts</p>
    @endif

<script>
    dropzone.on('success', function(file, response){
    console.log(response.imagen);
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on('removedfile', function(){
    document.querySelector('[name="imagen"]').value = "";
});

  function abrirModal() {
    document.getElementById('miModal').style.display = 'block';
  }

  function cerrarModal() {
    document.getElementById('miModal').style.display = 'none';
  }

  // Cerrar si se hace clic fuera del modal
  window.onclick = function(event) {
    const modal = document.getElementById('miModal');
    if (event.target == modal) {
      cerrarModal();
    }
  }

</script>
@endsection

