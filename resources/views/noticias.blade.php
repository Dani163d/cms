@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <!-- Hero Section con Efecto Parallax -->
    <div class="relative overflow-hidden mb-16">
        <div class="absolute inset-0 bg-[#02311a] opacity-90"></div>
        <div class="max-w-7xl mx-auto relative z-10 py-20 px-4">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 animate-fade-in">
                Últimas Noticias
                <div class="h-1 w-20 bg-[#0cad56] mt-4"></div>
            </h1>
            <p class="text-xl text-gray-200 max-w-2xl animate-fade-in-delay">
                Mantente informado con las últimas actualizaciones y noticias relevantes.
            </p>
        </div>
    </div>

    <!-- Grid de Noticias -->
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($allNews as $item)
            <article class="bg-white rounded-2xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-xl transform hover:-translate-y-1 flex flex-col group">
                <!-- Imagen destacada -->
                @php
                    $doc = new DOMDocument();
                    libxml_use_internal_errors(true);
                    $doc->loadHTML($item->content);
                    libxml_clear_errors();
                    $xpath = new DOMXPath($doc);
                    $imgNode = $xpath->query("//img")->item(0);
                @endphp

                <div class="relative h-48 overflow-hidden bg-gradient-to-r from-[#02311a] to-[#0cad56]">
                    @if($imgNode)
                        <img src="{{ $imgNode->getAttribute('src') }}" 
                             alt="Imagen de la noticia"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    @else
                        <div class="flex items-center justify-center h-full">
                            <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                    @endif
                    <!-- Overlay con fecha -->
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium text-gray-700">
                        {{ $item->created_at->format('d M, Y') }}
                    </div>
                </div>

                <!-- Contenido -->
                <div class="p-6 flex flex-col flex-grow">
                    <h2 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#0cad56] transition-colors">
                        {{ $item->title }}
                    </h2>

                    <div class="prose prose-sm text-gray-600 mb-4 flex-grow">
                        {!! Str::limit(strip_tags($item->content), 150) !!}
                    </div>

                    <!-- Footer -->
                    <div class="pt-4 border-t border-gray-100 mt-auto">
                        <div class="flex items-center justify-between">
                            <span class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"/>
                                </svg>
                                {{ $item->created_at->diffForHumans() }}
                            </span>

                            <button class="inline-flex items-center px-4 py-2 bg-[#02311a] text-white rounded-lg hover:bg-[#0cad56] transition-colors duration-300">
                                <span>Leer más</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Paginación -->
        @if(method_exists($allNews, 'links'))
        <div class="mt-12">
            {{ $allNews->links() }}
        </div>
        @endif
    </div>
</div>

<style>
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInDelay {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    50% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeIn 1s ease-out forwards;
}

.animate-fade-in-delay {
    animation: fadeInDelay 1.5s ease-out forwards;
}

.prose {
    max-width: 100%;
}

.prose img {
    max-width: 100%;
    height: auto;
    border-radius: 0.5rem;
    margin: 1rem 0;
}

article {
    animation: fadeIn 0.5s ease-out forwards;
    height: 100%;
}

/* Mejoras en la paginación */
.pagination {
    @apply flex justify-center items-center gap-2;
}

.pagination > * {
    @apply px-4 py-2 rounded-lg transition-colors duration-200;
}

.pagination > *:not(.disabled):hover {
    @apply bg-[#0cad56] text-white;
}

.pagination .active {
    @apply bg-[#02311a] text-white;
}

/* Efecto de hover en las cards */
.group:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Truncate text */
.prose-sm {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Animación de entrada escalonada para las cards
    const articles = document.querySelectorAll('article');
    articles.forEach((article, index) => {
        article.style.animationDelay = `${index * 0.1}s`;
    });

    // Efecto parallax en el hero
    window.addEventListener('scroll', () => {
        const hero = document.querySelector('.relative.overflow-hidden');
        const scrolled = window.pageYOffset;
        hero.style.transform = `translate3d(0, ${scrolled * 0.5}px, 0)`;
    });
});
</script>
@endpush
@endsection