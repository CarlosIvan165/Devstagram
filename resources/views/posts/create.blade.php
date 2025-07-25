@extends('layouts.app')

@section('titulo')
    Crea una nueva Publicacion
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />    
@endpush

@section('contenido')
    <div class="lg:flex lg:justify-center lg:gap-10 lg:items-center">
        <div class="lg:w-1/2 px-10">
            <form action="{{ route('imagenes.store')}}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        <div class="lg:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 lg_mt-0">
            <form id="dropzone" action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">Titutlo</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Titulo de la Publicacion" class="border p-3 w-full rounded-lg @error('titulo') border-red-500 @enderror" value="{{ old('titulo') }}">
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" placeholder="Descripcion de la publicacion" class="border p-3 w-full rounded-lg @error('titulo') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="hidden" name="imagen" value="{{ old('imagen') }}">
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <input type="submit" value="Publicar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-b-lg">
            </form>
        </div>
    </div>

    <script>
        dropzone.on('success', function(file, response){
            console.log(response.imagen);
            document.querySelector('[name="imagen"]').value = response.imagen;
        });
    </script>
@endsection