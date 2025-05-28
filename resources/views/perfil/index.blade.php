@extends('layouts.app')

@section('titulo')
    Editar perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg:white shadow p-6">
            <form method="POST" action="{{ route('perfil.store') }}" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray font-bold text-gray-500">Nombre de usuario</label>
                    <input type="text" name="username" id="username" placeholder="Tu nombre de usuario" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value="{{ auth()->user()->username }}">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray font-bold text-gray-500">Nombre de usuario</label>
                    <input type="text" name="name" id="name" placeholder="Tu nombre de usuario" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror" value="{{ auth()->user()->name }}">
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="description" class="mb-2 block uppercase text-gray-500 font-bold">Tu Descripcion</label>
                    <textarea name="description" id="description" placeholder="description de tu perfil" class="border p-3 w-full rounded-lg @error('titulo') border-red-500 @enderror">{{ auth()->user()->description }}</textarea>
                    @error('description')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray font-bold text-gray-500">Foto de Perfil</label>
                    <input type="file" name="imagen" id="imagen" class="border p-3 w-full rounded-lg" value="" accept=".jpg, .jpeg, .png">
                </div>
                <input type="submit" value="Guardar Cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-b-lg">
            </form>
        </div>
    </div>
@endsection