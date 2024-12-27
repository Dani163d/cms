@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 pt-16">
    <!-- Hero Section con Efecto Parallax -->
    <div class="relative overflow-hidden mb-16 hero-section">
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
    <div class="max-w-7xl mx-auto px-4">
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
                    <h2 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#0cad56] transition-colors line-clamp-2">
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

                            <button 
                                class="read-more-btn inline-flex items-center px-4 py-2 bg-[#02311a] text-white rounded-lg hover:bg-[#0cad56] transition-colors duration-300"
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

<!-- Modal -->
<div id="newsModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden opacity-0 transition-opacity duration-300">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-4xl sm:w-full m-4">
            <div class="p-6">
                <!-- Header del modal -->
                <div class="flex justify-between items-start mb-4">
                    <h2 id="modalTitle" class="text-2xl font-bold text-gray-900 pr-4"></h2>
                    <button id="closeModal" class="text-gray-500 hover:text-gray-700 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Contenedor de imagen principal -->
                <div id="modalImage" class="hidden">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="" alt="Imagen de la noticia" class="w-full h-full object-contain bg-gray-100 rounded-lg">
                    </div>
                </div>

                <!-- Contenido -->
                <div id="modalContent" class="prose max-w-none mt-6 text-gray-600"></div>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos base */
.hero-section {
    position: relative;
    z-index: 1;
}

nav.bg-white {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 40;
}

/* Animaciones */
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

/* Estilos del contenido */
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

/* Paginación */
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

/* Cards */
.group:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Modal */
#modalImage {
    max-width: 800px;
    margin: 0 auto 1.5rem;
}

.aspect-w-16.aspect-h-9 {
    position: relative;
    padding-bottom: 40%;
    height: 0;
    background-color: #f3f4f6;
    border-radius: 0.5rem;
    overflow: hidden;
}

.aspect-w-16.aspect-h-9 img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: contain;
}

#modalContent img {
    display: block;
    max-width: 600px;
    max-height: 400px;
    width: auto;
    height: auto;
    margin: 1rem auto;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    object-fit: contain;
}

#modalContent p:has(img) {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 1rem 0;
}

/* Responsive */
@media (max-width: 768px) {
    #modalImage {
        max-width: 100%;
    }

    .aspect-w-16.aspect-h-9 {
        padding-bottom: 50%;
    }

    #modalContent img {
        max-width: 100%;
        max-height: 300px;
    }
}

/* Modal container */
#newsModal .bg-white {
    max-width: 900px;
    width: 90%;
    margin: 2rem auto;
    max-height: 85vh;
}

#modalContent {
    max-width: 800px;
    margin: 0 auto;
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('newsModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalContent = document.getElementById('modalContent');
    const modalImage = document.getElementById('modalImage');
    const closeModal = document.getElementById('closeModal');
    const articles = document.querySelectorAll('article');
    const hero = document.querySelector('.hero-section');

    // Animaciones de entrada
    articles.forEach((article, index) => {
        article.style.animationDelay = `${index * 0.1}s`;
    });

    // Funciones del Modal
    const openModal = () => {
        modal.classList.remove('hidden');
        requestAnimationFrame(() => {
            modal.style.opacity = '1';
            modal.querySelector('.bg-white').style.transform = 'scale(1)';
        });
        document.body.style.overflow = 'hidden';
    };

    const closeModalWithAnimation = () => {
        modal.style.opacity = '0';
        modal.querySelector('.bg-white').style.transform = 'scale(0.9)';
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            modalContent.innerHTML = '';
            modalTitle.textContent = '';
            modalImage.querySelector('img').src = '';
            modalImage.classList.add('hidden');
        }, 300);
    };

    // Event Listeners
    document.querySelectorAll('.read-more-btn').forEach(button => {
        button.addEventListener('click', () => {
            const title = button.dataset.title;
            const content = button.dataset.content;
            const image = button.dataset.image;
            
            modalTitle.textContent = title;
            modalContent.innerHTML = content;

            if (image && image !== 'undefined' && image !== '') {
                const modalImg = modalImage.querySelector('img');
                modalImg.src = image;
                modalImage.classList.remove('hidden');
            } else {
                modalImage.classList.add('hidden');
            }

            openModal();
            modal.querySelector('.bg-white').scrollTop = 0;
        });
    });

    closeModal.addEventListener('click', (e) => {
        e.preventDefault();
        closeModalWithAnimation();
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModalWithAnimation();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModalWithAnimation();
        }
    });

    // Parallax Effect
    let ticking = false;
    let lastScrollY = window.scrollY;
    const parallaxFactor = 0.5;

    window.addEventListener('scroll', () => {
        lastScrollY = window.scrollY;
        
        if (!ticking) {
            window.requestAnimationFrame(() => {
                if (hero) {
                    hero.style.transform = `translate3d(0, ${lastScrollY * parallaxFactor}px, 0)`;
                }
                ticking = false;
            });
            ticking = true;
        }
    });
});
</script>
@endpush

@endsection