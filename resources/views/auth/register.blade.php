@extends('layouts.app')

@section('titulo')
    Registrate en Devstagram
@endsection

@section('contenido')
    <div class="lg:flex md:justify-center md:gap-10 md:items-center ">
        <div class="md:w-6/6 bg-white p-6 rounded-lg shadow-xl">
            <img src="{{ asset('img/registrar.jpg')}}" alt="Imagen registo de usuarios">
        </div>
        <div class="md:w-4/4">
            <form class="md:p-3 p-6" action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray font-bold text-gray-500">Nombre</label>
                    <input type="text" name="name" id="name" placeholder="Tu nombre" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" value="{{ old('name') }}">
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray font-bold text-gray-500">username</label>
                    <input type="text" name="username" id="username" placeholder="Tu nombre de usuario" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value="{{ old('username') }}">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray font-bold text-gray-500">Email</label>
                    <input type="email" name="email" id="email" placeholder="Tu Email de Registro" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray font-bold text-gray-500">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password de Registro" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray font-bold text-gray-500">Repetir Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repite tu Password" class="border p-3 w-full rounded-lg">
                </div>

                <input type="submit" value="Crear Cuenta" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-b-lg">
            </form>
            <div class="flex items-center justify-center">
                <p>¿Ya tienes cuenta? <a class="text-indigo-500" href="{{ route('login') }}">Inicia Sesion aqui</a></p>
            </div>
        </div>
    </div>
@endsection