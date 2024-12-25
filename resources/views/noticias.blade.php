@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex flex-col bg-[#f4f4f4] py-16">
        <h1 class="text-2xl font-semibold text-center mb-8">Últimas Noticias</h1>

        @foreach ($allNews as $item)
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-md mb-8 p-6 hover:shadow-lg transition">
        <h3 class="text-xl font-semibold mb-4">{{ $item->title }}</h3>
        
        <div class="prose max-w-none">
            {!! $item->content !!}
        </div>
        
        <div class="mt-6 pt-4 border-t border-gray-200">
            <p class="text-sm text-gray-500">
                Publicado el: {{ $item->created_at->format('d/m/Y') }}
            </p>
        </div>
    </div>
@endforeach
    </div>

    <style>
    /* Estilos para las imágenes en el contenido */
    .prose img {
        max-width: 100%;
        height: auto;
        margin: 1rem 0;
        border-radius: 0.375rem;
        display: block;
    }
    
    .ck-editor__editable {
        min-height: 300px !important;
    }
    
    /* Asegurarse de que las imágenes del editor también se muestren correctamente */
    .ck-content img {
        max-width: 100%;
        height: auto;
    }
</style>
@endsection