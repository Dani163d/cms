@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex flex-col bg-[#f4f4f4] py-16">
        <h1 class="text-2xl font-semibold text-center mb-8">Últimas Noticias</h1>

        @foreach ($allNews as $item)
            <div class="max-w-xl mx-auto bg-white shadow-md rounded-md mb-4 p-6">
                <h3 class="text-xl font-semibold mb-2">{{ $item->title }}</h3>
                
                <div class="text-gray-700 prose max-w-none">{!! $item->content !!}</div>
                <p class="text-sm text-gray-500 mt-4">Publicado el: {{ $item->created_at->format('d/m/Y') }}</p>
            </div>
        @endforeach
    </div>
@endsection