@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#f8f9fa] to-[#FFF5F0] py-8">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header Mejorado -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-[#02311a] relative inline-block">
                Explorador de Carreras
                <div class="absolute -bottom-1 left-0 w-full h-1 bg-gradient-to-r from-[#0cad56] to-[#02311a]"></div>
            </h1>
            <p class="text-gray-600 mt-4 text-lg">Descubre tu futuro profesional con nuestras opciones académicas</p>
        </div>

        <!-- Buscador Mejorado -->
        <div class="max-w-3xl mx-auto mb-12">
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                <form action="{{ route('careers.index') }}" method="GET" class="relative">
                    <div class="flex items-center gap-4">
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text" 
                                   name="search" 
                                   placeholder="Busca la carrera de tus sueños..." 
                                   class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#0cad56] focus:border-transparent transition-all duration-300"
                                   value="{{ request('search') }}">
                        </div>
                        <button type="submit" 
                                class="bg-gradient-to-r from-[#0cad56] to-[#02311a] text-white px-8 py-3 rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                            Buscar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Lista de Carreras -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($careers ?? [] as $career)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 group">
                    <div class="p-6">
                        <!-- Ícono de la carrera -->
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-[#0cad56]/10 to-[#02311a]/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-[#0cad56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-[#0cad56] transition-colors duration-300">
                            {{ $career->name ?? 'Nombre de la Carrera' }}
                        </h3>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $career->description ?? 'Descripción de la carrera universitaria.' }}
                        </p>

                        <div class="pt-4 border-t border-gray-100">
                            <div class="flex items-center mb-4">
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-5 h-5 mr-2 text-[#0cad56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $career->duration ?? '5' }} años</span>
                                </div>
                            </div>

                            <a href="{{ route('careers.branches', $career->id) }}" 
                               class="block w-full text-center py-3 bg-gradient-to-r from-[#0cad56] to-[#02311a] text-white rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                                Ver Ramas de la Carrera
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white rounded-2xl shadow-lg p-8 text-center max-w-2xl mx-auto border border-gray-100">
                        <div class="w-16 h-16 rounded-xl bg-gradient-to-r from-[#0cad56]/10 to-[#02311a]/10 flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-[#0cad56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">No se encontraron carreras</h3>
                        <p class="text-gray-600 mb-6">Lo sentimos, no pudimos encontrar carreras que coincidan con tu búsqueda.</p>
                        <a href="{{ route('careers.index') }}" 
                           class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-[#0cad56] to-[#02311a] text-white rounded-xl hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver al inicio
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Paginación Mejorada -->
        @if(isset($careers) && method_exists($careers, 'links'))
            <div class="mt-12">
                {{ $careers->links() }}
            </div>
        @endif
    </div>
</div>

<style>
/* Animaciones para hover */
.group:hover .group-hover\:scale-110 {
    transform: scale(1.1);
}

/* Estilos para la paginación */
.pagination {
    @apply flex justify-center items-center gap-2;
}

.pagination > * {
    @apply px-4 py-2 rounded-lg border border-gray-200 text-gray-700 hover:bg-[#0cad56] hover:text-white transition-colors duration-300;
}

.pagination .active {
    @apply bg-[#0cad56] text-white border-[#0cad56];
}
</style>
@endsection