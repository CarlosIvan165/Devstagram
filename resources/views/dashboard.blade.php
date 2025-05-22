@extends('layouts.app')

@section('menu')
    <div class="sm:hidden block">
        <div class="">
            <div class="flex justify-between">
                <button type="button" class="inline-flex ml-auto w-15 justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
                 <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                </button>
            </div>
        </div>
        <!--
            Dropdown menu, show/hide based on menu state.

            Entering: "transition ease-out duration-100"
            From: "transform opacity-0 scale-95"
            To: "transform opacity-100 scale-100"
            Leaving: "transition ease-in duration-75"
            From: "transform opacity-100 scale-100"
            To: "transform opacity-0 scale-95"
        -->
        <div class="hidden absolute right-0 z-10 mt-1 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-hidden" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
            <div class="py-1" role="none">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-red-700">Cerrar Sesion</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('titulo')
    Perfil: {{$user->username}}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                    <img class="rounded-full" src="{{ $user->imagen ? asset('perfiles').'/'. $user->imagen : asset('img/usuario.svg')}}" alt="Imagen usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py10">
                
                <p class="text-gray-700 text-2xl mb-2">{{ $user->username }}</p>
                @if (!$user->description)
                    <p class="text-gray-700 text-sm mb-2">No hay descripcion</p>
                @else
                    <p class="text-gray-700 text-sm mb-2">{{ $user->description }}</p>
                @endif
                

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->followers()->count()}} <span class="font-normal">@choice('seguidor|seguidores', $user->followers()->count())</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->followings()->count()}} <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $posts->count()}} <span class="font-normal">Posts</span>
                </p>

                @auth
                    @if ($user->id === auth()->user()->id)
                        <a href="{{ route('perfil.index', $user) }}" class="flex text-center gap-2 p-1 text-gray-500 hover:text-gray-600 cursor-pointer">
                            <span class="">Editar Perfil</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>
                    @endif
                @endauth

                @auth
                        @if ($user->id !== auth()->user()->id)
                            @if (!$user->siguiendo(auth()->user()))
                                <form action="{{ route('users.follow', $user) }}" method="POST">
                                    @csrf
                                    <input type="submit" class="bg-zinc-500 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Seguir">
                                </form>  
                            @else
                                <form action="{{ route('users.unfollow', $user) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" class="bg-red-500 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Dejar de seguir">
                                </form>
                            @endif                            
                        @endif
                    
                @endauth
                

            </div>
        </div>
    </div>

    <section class="container mx-auto mt-5">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
        <x-listar-post :posts="$posts" />
    </section>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const menuButton = document.getElementById('menu-button');
    const dropdownMenu = menuButton.closest('.sm\\:hidden').querySelector('div[role="menu"]');

    dropdownMenu.style.display = 'none'; // Oculta el menú inicialmente

    menuButton.addEventListener('click', function () {
        const isVisible = dropdownMenu.style.display === 'block';

        dropdownMenu.style.display = isVisible ? 'none' : 'block';
        menuButton.setAttribute('aria-expanded', !isVisible);
    });

    // Opcional: cerrar el menú si se hace clic fuera de él
    document.addEventListener('click', function (e) {
        if (!menuButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.style.display = 'none';
            menuButton.setAttribute('aria-expanded', 'false');
        }
    });
});
</script>