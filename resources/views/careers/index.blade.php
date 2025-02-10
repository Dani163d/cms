{{-- resources/views/careers/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <!-- Encabezado -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#FF7F50] mb-2">Explorador de Carreras</h1>
            <p class="text-gray-600">Descubre las diferentes opciones de carreras universitarias disponibles.</p>
        </div>

        <!-- Buscador -->
        <div class="mb-8">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <form action="{{ route('careers.index') }}" method="GET" class="flex gap-4">
                    <div class="flex-1">
                        <input type="text" 
                               name="search" 
                               placeholder="Buscar carreras..." 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9F7D] focus:border-transparent"
                               value="{{ request('search') }}">
                    </div>
                    <button type="submit" 
                            class="bg-[#FF7F50] text-white px-6 py-2 rounded-lg hover:bg-[#FF9F7D] transition-colors duration-300">
                        Buscar
                    </button>
                </form>
            </div>
        </div>

        <!-- Lista de Carreras -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($careers ?? [] as $career)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-[#FF7F50] mb-2">{{ $career->name ?? 'Nombre de la Carrera' }}</h3>
                        <p class="text-gray-600 mb-4">{{ $career->description ?? 'Descripción de la carrera universitaria.' }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Duración: {{ $career->duration ?? '5 años' }}</span>
                            <a href="{{ route('careers.show', $career->id ?? 1) }}" 
                               class="text-[#FF7F50] hover:text-[#FF9F7D] font-medium">
                                Ver más →
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-8">
                    <div class="bg-[#FFF5F0] rounded-lg p-6 inline-block">
                        <svg class="w-12 h-12 text-[#FF7F50] mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-gray-600">No se encontraron carreras.</p>
                        <p class="text-sm text-gray-500 mt-2">Intenta con otros términos de búsqueda.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Paginación -->
        @if(isset($careers) && method_exists($careers, 'links'))
            <div class="mt-8">
                {{ $careers->links() }}
            </div>
        @endif
    </div>
</div>
@endsection