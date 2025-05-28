@extends('layouts.app')

@section('titulo')
    Buscador
@endsection

@section('contenido')
    @auth
        <livewire:buscador-post />
    @endauth
@endsection
