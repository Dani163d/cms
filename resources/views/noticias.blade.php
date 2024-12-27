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

                <!-- Modal Image -->
                <img id="modalImage" class="w-full h-64 object-cover rounded-lg mb-4" />

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

});
</script>
<script>

document.addEventListener('DOMContentLoaded', () => {
    // Elementos del DOM
    const modal = document.getElementById('newsModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalContent = document.getElementById('modalContent');
    const modalImage = document.getElementById('modalImage');
    const closeModal = document.getElementById('closeModal');
    const articles = document.querySelectorAll('article');
    const hero = document.querySelector('.hero-section');

    // Función para decodificar entidades HTML
    const decodeHTMLEntities = (text) => {
        const textarea = document.createElement('textarea');
        textarea.innerHTML = text;
        return textarea.value;
    };

    // Función para limpiar HTML y mantener formato básico
    const cleanHTML = (html) => {
        // Crear un elemento temporal
        const temp = document.createElement('div');
        temp.innerHTML = html;

        // Remover scripts y estilos
        const scripts = temp.getElementsByTagName('script');
        const styles = temp.getElementsByTagName('style');
        for (let el of [...scripts, ...styles]) {
            el.remove();
        }

        // Procesar imágenes
        const images = temp.getElementsByTagName('img');
        for (let img of images) {
            const figure = document.createElement('figure');
            const imgClone = img.cloneNode(true);
            figure.appendChild(imgClone);
            if (img.alt) {
                const figcaption = document.createElement('figcaption');
                figcaption.textContent = img.alt;
                figure.appendChild(figcaption);
            }
            img.parentNode.replaceChild(figure, img);
        }

        // Obtener el texto limpio
        let cleanText = temp.innerHTML
            .replace(/<\/?[^>]+(>|$)/g, "")  // Remover todas las etiquetas HTML
            .replace(/&nbsp;/g, " ")         // Reemplazar &nbsp; por espacios
            .replace(/\s+/g, " ")            // Normalizar espacios
            .trim();

        // Formatear el texto en párrafos
        return cleanText.split('\n')
            .filter(line => line.trim() !== '')
            .map(line => `<p>${line.trim()}</p>`)
            .join('');
    };

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
            if (modalImage.querySelector('img')) {
                modalImage.querySelector('img').src = '';
            }
            modalImage.classList.add('hidden');
        }, 300);
    };

    // Event Listeners
    document.querySelectorAll('.read-more-btn').forEach(button => {
        button.addEventListener('click', () => {
            const title = button.dataset.title;
            const content = button.dataset.content;
            const image = button.dataset.image;
            
            // Establecer título decodificado
            modalTitle.textContent = decodeHTMLEntities(title);
            
            // Limpiar y establecer contenido
            const cleanedContent = cleanHTML(decodeHTMLEntities(content));
            modalContent.innerHTML = cleanedContent;

            // Manejar imagen
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


    // Función para manejar imágenes en el contenido
    const processContentImages = () => {
        const images = modalContent.getElementsByTagName('img');
        for (let img of images) {
            img.classList.add('content-image');
            const wrapper = document.createElement('div');
            wrapper.className = 'image-wrapper';
            img.parentNode.insertBefore(wrapper, img);
            wrapper.appendChild(img);
        }
    };

    // Observer para monitorear cambios en el contenido
    const observer = new MutationObserver(() => {
        processContentImages();
    });

    observer.observe(modalContent, {
        childList: true,
        subtree: true
    });
});


</script>
@endpush

@endsection