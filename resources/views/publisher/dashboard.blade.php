@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col bg-[#f4f4f4] py-16">
    <h1 class="text-2xl font-semibold text-center mb-8">Bienvenido, Publicador</h1>

    {{-- Mostrar mensaje de éxito si la noticia fue publicada --}}
    @if (session('success'))
        <div class="text-green-600 text-center mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulario para publicar noticias --}}
    <form action="{{ route('publisher.storeNews') }}" method="POST">
        @csrf
        <div>
            <label for="title">Título de la noticia</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="content">Contenido de la noticia</label>
            <textarea id="content" name="content" required></textarea>
        </div>
        <button type="submit">Publicar Noticia</button>
    </form>

    {{-- Mostrar las noticias publicadas por el publicador --}}
    <div>
        <h2 class="text-xl font-semibold mb-4">Tus Noticias Publicadas</h2>

        @foreach ($news as $item)
            <div class="max-w-xl mx-auto bg-white shadow-md rounded-md mb-4 p-6">
                <h3 class="text-xl font-semibold mb-2">{{ $item->title }}</h3>
                <p class="text-gray-700">{{ $item->content }}</p>
                <p class="text-sm text-gray-500 mt-4">Publicado el: {{ $item->created_at->format('d/m/Y') }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
