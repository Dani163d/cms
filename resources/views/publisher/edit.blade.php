@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col bg-[#f4f4f4] py-16">
    <h1 class="text-2xl font-semibold text-center mb-8">Editar Noticia</h1>

    {{-- Formulario para editar la noticia --}}
    <form action="{{ route('publisher.updateNews', $news->id) }}" method="POST">
        @csrf
        @method('POST')
        <div>
            <label for="title">Título de la noticia</label>
            <input type="text" id="title" name="title" value="{{ old('title', $news->title) }}" required>
        </div>
        <div>
            <label for="content">Contenido de la noticia</label>
            <textarea id="content" name="content" required>{{ old('content', $news->content) }}</textarea>
        </div>
        <button type="submit">Actualizar Noticia</button>
    </form>
</div>
@endsection
