@extends('layouts.app')

@section('titulo')
    Buscador
@endsection

@section('contenido')
    @auth
        <div class="grid justify-center">
            <div class=" ">
                <form method="GET" action="{{ route('usuarios.buscar',) }}">
                    @csrf
                    <input type="text" name="usuario" placeholder="Buscar usuario..." class="border p-2 rounded md:w-xl">
                    <button type="submit" class="border uppercase font-bold cursor-pointer px-4 py-2 rounded ml-2">Buscar</button>
                </form>
            </div>
            <div class="w-auto">
                @if(isset($usuario))
                    <h2 class="text-gray-500">Resultados para "{{ $usuario }}"</h2>

                    @if($username->count())
                        <ul class="mt-6 w-l">
                            @foreach($username as $usuario)
                                <li class="flex gap-3 mt-5">
                                    <a class="flex gap-3 items-center text-gray-600 text-sm" href="{{ route('posts.index', $usuario->username)}}">
                                        <img class="w-10 rounded-full" src="{{ $usuario->imagen ? asset('perfiles').'/'. $usuario->imagen : asset('img/usuario.svg')}}" alt="Imagen usuario">  
                                        <div class="w-44">
                                            <p class="font-bold uppercase">{{ $usuario->username }}</p>
                                            <span class="text-sm">{{ $usuario->name }}</span>
                                        </div>                      
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mt-10 text-gray-500 uppercase font-bold">No se encontraron resultados.</p>
                    @endif
                @endif
            </div>
        </div>
    @endauth
@endsection
