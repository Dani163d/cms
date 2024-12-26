@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <!-- Encabezado Hero -->
    <div class="max-w-7xl mx-auto text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-bold text-[#02311a] mb-4">
            Últimas Noticias
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
            Mantente informado con las últimas actualizaciones y noticias relevantes.
        </p>
    </div>

    <!-- Grid de Noticias -->
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($allNews as $item)
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl transform hover:-translate-y-1 flex flex-col">
                <!-- Bloque verde para el título -->
                <div class="bg-[#02311a] text-white p-4">
                    <!-- Título -->
                    <h2 class="text-xl font-bold hover:text-[#1d4b2b] transition-colors">
                        {{ $item->title }}
                    </h2>
                </div>

                <!-- Contenido de la noticia -->
                <div class="p-6 flex flex-col flex-grow">
                    <!-- Fecha -->
                    <div class="text-sm text-[#02311a] mb-2">
                        {{ $item->created_at->format('d M, Y') }}
                    </div>

                    <!-- Extracto del contenido -->
                    <div class="prose prose-sm text-gray-600 mb-4 flex-grow">
                        {!! Str::limit(strip_tags($item->content), 150) !!}
                    </div>

                    <!-- Footer -->
                    <div class="pt-4 border-t border-[#02311a] mt-auto">
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center text-sm text-[#6c757d]">
                                <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                {{ $item->created_at->diffForHumans() }}
                            </span>

                            <button class="text-sm text-[#02311a] hover:text-[#1d4b2b] font-medium inline-flex items-center">
                                Leer más
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Imagen destacada (si existe) -->
                @if(preg_match('/<img[^>]+>/i', $item->content, $matches))
                    <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                        {!! $matches[0] !!}
                    </div>
                @endif
            </article>
            @endforeach
        </div>

        <!-- Paginación si existe -->
        @if(method_exists($allNews, 'links'))
        <div class="mt-12">
            {{ $allNews->links() }}
        </div>
        @endif
    </div>
</div>

<style>
    /* Estilo para las imágenes dentro de las cards */
    .aspect-w-16.aspect-h-9 img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
    }

    .aspect-w-16.aspect-h-9:hover img {
        transform: scale(1.05);
    }

    /* Estilos para el contenido del editor */
    .prose {
        max-width: 100%;
    }

    .prose img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1rem 0;
    }

    /* Animaciones para las cards */
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

    article {
        animation: fadeIn 0.5s ease-out forwards;
    }

    /* Asegurar que las cards tengan la misma altura */
    article {
        height: 100%;
    }

    /* Responsive tweaks */
    @media (max-width: 768px) {
        .grid {
            gap: 1.5rem;
        }
    }

    /* Estilo para la paginación */
    .pagination {
        @apply flex justify-center items-center space-x-2;
    }

    .pagination > div {
        @apply px-3 py-1 rounded-md bg-white shadow-sm hover:bg-gray-50;
    }

    /* Hover effects */
    article:hover {
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
    // Animación de entrada escalonada para las cards
    document.addEventListener('DOMContentLoaded', () => {
        const articles = document.querySelectorAll('article');
        articles.forEach((article, index) => {
            article.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
@endpush
@endsection
