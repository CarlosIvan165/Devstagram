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

<!-- Modal -->
<div id="miModal" class="modal">
  <div class="modal-contenido">
    <span class="cerrar" onclick="cerrarModal()">&times;</span>
        <div class="shadow bg-white p-5 mb-5">
                <div class="bg-white shadow mt-5 mb-5 max-h-96 overflow-y-scroll">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a class="font-bold" href="{{ route('posts.index', $comentario->user) }}">{{ $comentario->user->username }}</a>
                                <p>{{ $comentario->comentario }}</p>
                                <p class="text-sm text-gray-600">{{ $comentario->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay Comentarios</p>
                    @endif
                </div>
                {{-- @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>
                    @if(session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center text-sm uppercase font-bold">
                            {{session('mensaje')}}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('comentario.store', ['post'=>$post, 'user' => auth()->id()]) }}">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Añade un Comentario</label>
                            <textarea name="comentario" id="comentario" placeholder="Agrega un Comentario" class="border p-3 w-full rounded-lg @error('titulo') border-red-500 @enderror"></textarea>
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        <input type="submit" value="Comentar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-b-lg">
                    </form>    
                @endauth --}}
            </div>
    </div>
</div>

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

