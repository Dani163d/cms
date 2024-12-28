@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Hero Section más compacto -->
    <div class="relative overflow-hidden mb-8 mt-4">
        <div class="absolute inset-0 bg-gradient-to-r from-[#02311a] to-[#0cad56]"></div>
        <div class="absolute inset-0 opacity-20 bg-[url('data:image/svg+xml,...')] pattern-dots"></div>
        <div class="max-w-5xl mx-auto relative z-10 py-10 px-6">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-3 animate-fade-in">
                Últimas Noticias
                <div class="h-1 w-20 bg-[#0cad56] mt-2 rounded-full"></div>
            </h1>
            <p class="text-lg text-gray-100 max-w-2xl animate-fade-in-delay leading-relaxed">
                Mantente informado con las últimas actualizaciones.
            </p>
        </div>
    </div>

    <!-- News Grid con márgenes y más compacto -->
    <div class="max-w-6xl mx-auto px-6 pb-12">
        <div class="grid grid-cols-12 gap-6">
            @foreach ($allNews as $index => $item)
                @php
                    $cardSize = match($index % 7) {
                        0 => 'col-span-12 lg:col-span-7',
                        1 => 'col-span-12 md:col-span-6 lg:col-span-5',
                        2 => 'col-span-12 md:col-span-6 lg:col-span-6',
                        3 => 'col-span-12 md:col-span-6 lg:col-span-6',
                        4, 5, 6 => 'col-span-12 md:col-span-6 lg:col-span-4',
                        default => 'col-span-12 md:col-span-6 lg:col-span-4'
                    };

                    $imageHeight = match($index % 7) {
                        0 => 'h-72',
                        1, 2, 3 => 'h-56',
                        default => 'h-48'
                    };

                    $textLimit = match($index % 7) {
                        0 => 250,
                        1, 2, 3 => 150,
                        default => 100
                    };

                    $doc = new DOMDocument();
                    libxml_use_internal_errors(true);
                    $doc->loadHTML($item->content);
                    libxml_clear_errors();
                    $xpath = new DOMXPath($doc);
                    $imgNode = $xpath->query("//img")->item(0);
                @endphp

                <article class="{{ $cardSize }} group">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1 h-full flex flex-col">
                        <!-- Image Container -->
                        <div class="relative {{ $imageHeight }} overflow-hidden">
                            @if($imgNode)
                                <img src="{{ $imgNode->getAttribute('src') }}" 
                                     alt="Imagen de la noticia"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="flex items-center justify-center h-full bg-gradient-to-br from-[#02311a] to-[#0cad56]">
                                    <svg class="w-16 h-16 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium text-gray-700">
                                {{ $item->created_at->format('d M, Y') }}
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-4 flex flex-col flex-grow">
                            <h2 class="text-lg {{ $index % 7 === 0 ? 'md:text-xl' : '' }} font-bold text-gray-900 mb-3 group-hover:text-[#0cad56] transition-colors duration-300 line-clamp-2">
                                {{ $item->title }}
                            </h2>

                            <div class="prose prose-sm text-gray-600 mb-4 flex-grow">
                                {!! Str::limit(strip_tags($item->content), $textLimit) !!}
                            </div>

                            <!-- Footer -->
                            <div class="pt-3 border-t border-gray-100 mt-auto">
                                <div class="flex items-center justify-between">
                                    <span class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-1.5 text-[#0cad56]" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"/>
                                        </svg>
                                        {{ $item->created_at->diffForHumans() }}
                                    </span>

                                    <button 
    class="read-more-btn inline-flex items-center px-4 py-2 bg-[#02311a] text-white rounded-lg hover:bg-[#0cad56] transition-colors duration-300 text-sm"
    data-id="{{ $item->id }}"
    data-content="{{ htmlspecialchars($item->content) }}"
    data-title="{{ $item->title }}"
    data-image="{{ $imgNode ? $imgNode->getAttribute('src') : '' }}">
    <span>Leer más</span>
    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
    </svg>
</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        @if(method_exists($allNews, 'links'))
            <div class="mt-12">
                {{ $allNews->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Modal más compacto -->
<div id="newsModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden opacity-0 transition-opacity duration-300">
    <div class="flex items-center justify-center min-h-screen px-4 py-6">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-3xl sm:w-full m-4">
            <div class="p-6">
                <!-- Modal Header -->
                <div class="flex justify-between items-start mb-4">
                    <h2 id="modalTitle" class="text-2xl font-bold text-gray-900 leading-tight"></h2>
                    <button id="closeModalBtn" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Modal Image Container -->
                <div class="modal-image-container mb-4">
                    <img id="modalImage" class="w-full h-64 object-cover rounded-lg" style="display: none;" alt="Imagen de la noticia">
                </div>

                <!-- Modal Content -->
                <div id="modalContent" class="prose prose-sm max-w-none text-gray-700"></div>

                <!-- Modal Footer -->
                <div class="mt-6 flex justify-end">
                    <button id="closeModalBtn2" 
                            class="px-4 py-2 bg-[#02311a] text-white rounded-lg hover:bg-[#0cad56] transition-colors duration-300">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(0.5rem);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInDelay {
    0% {
        opacity: 0;
        transform: translateY(0.5rem);
    }
    50% {
        opacity: 0;
        transform: translateY(0.5rem);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

.animate-fade-in-delay {
    animation: fadeInDelay 1.2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

.pattern-dots {
    background-size: 16px 16px;
    background-position: 0 0, 8px 8px;
}

.prose img {
    @apply rounded-lg shadow-md my-6;
}

article {
    animation: fadeIn 0.5s cubic-bezier(0.4, 0, 0.2, 1) both;
    animation-delay: calc(var(--animation-order, 0) * 100ms);
}

.pagination {
    @apply flex justify-center items-center gap-2;
}

.pagination > * {
    @apply px-3 py-2 rounded-lg transition-all duration-300 text-gray-600 hover:text-[#0cad56];
}

.pagination > *:not(.disabled):hover {
    @apply bg-gray-50;
}

.pagination .active {
    @apply bg-[#02311a] text-white hover:bg-[#0cad56];
}

#modalContent img {
    @apply rounded-lg shadow-md mx-auto my-6 max-h-[400px] object-contain;
}

@media (max-width: 768px) {
    #modalContent img {
        @apply max-h-[250px];
    }
}

#modalImage {
    max-width: 100%;
    height: auto;
    max-height: 400px;
    object-fit: contain;
    margin: 0 auto;
    display: block;
}

.modal-image-container {
    width: 100%;
    max-height: 400px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Elementos del DOM
    const modal = document.getElementById('newsModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalContent = document.getElementById('modalContent');
    const modalImage = document.getElementById('modalImage');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const closeModalBtn2 = document.getElementById('closeModalBtn2');

    // Funciones de utilidad
    const decodeHTMLEntities = (text) => {
        const textarea = document.createElement('textarea');
        textarea.innerHTML = text;
        return textarea.value;
    };

    // Función para limpiar el contenido HTML y remover la primera imagen
    const cleanContent = (content) => {
        const div = document.createElement('div');
        div.innerHTML = content;
        
        // Remover la primera imagen ya que se mostrará en modalImage
        const firstImage = div.querySelector('img');
        if (firstImage) {
            firstImage.remove();
        }
        
        return div.innerHTML;
    };

    // Funciones del Modal
    const openModal = () => {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.style.opacity = '1';
        }, 10);
        document.body.style.overflow = 'hidden';
    };

    const closeModal = () => {
        modal.style.opacity = '0';
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            modalContent.innerHTML = '';
            modalTitle.textContent = '';
            modalImage.src = '';
            modalImage.style.display = 'none';
        }, 300);
    };

    // Event Listeners para los botones "Leer más"
    const readMoreButtons = document.querySelectorAll('.read-more-btn');
    readMoreButtons.forEach(button => {
        button.addEventListener('click', () => {
            const title = button.dataset.title;
            const content = button.dataset.content;
            const imageUrl = button.dataset.image;
            
            modalTitle.textContent = decodeHTMLEntities(title);
            
            // Primero mostrar la imagen principal si existe
            if (imageUrl && imageUrl !== 'undefined' && imageUrl !== '') {
                modalImage.src = imageUrl;
                modalImage.style.display = 'block';
            } else {
                modalImage.style.display = 'none';
            }

            // Luego mostrar el contenido sin la primera imagen
            const cleanedContent = cleanContent(decodeHTMLEntities(content));
            modalContent.innerHTML = cleanedContent;

            openModal();
        });
    });

    // Event Listeners para cerrar
    [closeModalBtn, closeModalBtn2].forEach(btn => {
        if (btn) {
            btn.addEventListener('click', closeModal);
        }
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
});
</script>
@endpush

@endsection