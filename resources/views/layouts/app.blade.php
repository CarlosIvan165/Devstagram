<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @stack('styles')
        <title>DevStagram - @yield('titulo')</title>
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        @livewireStyles
    </head>
    <body class="bg-gray-100">
        <header class="px-4 sm:p-5 shadow bg-white">
            @auth  
                {{-- Mobile --}}
                <div class="flex sm:hidden justify-between items-center">
                    <a class="text-xl font-black" href="{{ route('home')}}">Devstagram</a>
                    <div class="flex items-center">
                        {{-- <div class="w-10">            
                        </div>  --}}
                        <div class="w-10">
                            <a href="{{ route('buscador.index') }}" class="flex items-center text-gray-600 font-bold w-12 p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </a>
                        </div>
                        <div class="w-14">
                            <a href="{{ route('posts.create')}}" class="flex items-center text-gray-600 font-bold w-12 p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                                </svg>
                            </a>
                        </div>
                        <div class="w-10">
                            <a class="flex gap-2 items-center font-bold text-gray-600 text-sm" href="{{ route('posts.index', auth()->user()->username)}}">
                                <img class="rounded-full" src="{{ auth()->user()->imagen ? asset('perfiles').'/'. auth()->user()->imagen : asset('img/usuario.svg')}}" alt="Imagen usuario">  
                                {{-- <span class="uppercase font-bold">{{ auth()->user()->username }}</span>   --}}
                            </a>
                        </div>
                    </div>                
                </div>
            @endauth
            {{-- Desktop menu --}}
            <div class="container mx-auto hidden sm:flex justify-between items-center">
                <a class="sm:text-2xl text-3xl font-black" href="{{ route('home')}}">Devstagram</a>
                @auth
                    <nav class="flex gap-2 items-center">
                        {{-- <a href="{{ route('buscador.index') }}" class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </a> --}}
                        <div class="w-l sm:w-l buscador justify-start">
                            <form method="GET" action="{{ route('usuarios.buscar',) }}" class="">
                                @csrf
                                <input type="text" name="usuario" placeholder="Buscar usuario..." class="border p-2 rounded w-1/2">
                                <button type="submit" class="border uppercase font-bold cursor-pointer px-4 py-2 rounded ml-2">Buscar</button>
                            </form>
                        </div>
                        <a class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer" href="{{ route('posts.create')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                            </svg>
                        </a>
                        <a class="font-bold text-gray-600 text-sm" href="{{ route('posts.index', auth()->user()->username)}}">
                            Hola: <span class="font-normal">{{ auth()->user()->username }}</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="font-bold uppercase text-gray-600 text-sm">Cerrar Sesion</button>
                        </form>
                        
                    </nav>
                @endauth
                @guest
                    <nav class="flex gap-2 items-center">
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">Login</a>
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">Crear Cuenta</a>
                    </nav>
                @endguest
                
            </div>
        </header>

        <main class="container mx-auto">
            <div>
                @yield('menu')
            </div>
            <h2 class="font-black text-center text-3xl mb-5 mt-5">
                @yield('titulo')
            </h2>
            @yield('contenido')
        </main>

        <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
            Devstagram - Todos los derechos reservados {{ now()->year }}
        </footer>
        @livewireScripts
    </body>
</html>