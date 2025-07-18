@extends('layouts.app')

@section('titulo')
    Inicia Sesion en Devstagram
@endsection

@section('contenido')
    <div class="lg:flex lg:justify-center lg:gap-10 lg:items-center">
        <div class="lg:w-6/6 bg-white p-6 rounded-lg shadow-xl">
            <img src="{{ asset('img/login.jpg')}}" alt="Imagen registo de usuarios">
        </div>
        <div class="lg:w-4/4">
            <form class="p-6 lg:p-3" method="POST" action="{{ route('login') }}" novalidate>
                @csrf
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje')}}</p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray font-bold">Email</label>
                    <input type="email" name="email" id="email" placeholder="Tu Email de Registro" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray font-bold">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password de Registro" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember" id=""> <label class="text-gray text-sm" for=""> mantener mi sesion abierta</label>
                </div>

                <input type="submit" value="Iniciar Sesion" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-b-lg">
            </form>
            <div class="flex items-center justify-center">
                <p>¿No te haz registrado? <a class="text-indigo-500" href="{{ route('register') }}">Registrate aqui</a></p>
            </div>
        </div>
    </div>
@endsection