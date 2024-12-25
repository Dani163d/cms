@extends('layouts.app')

@section('content')
<section id="intro" class="grid md:grid-cols-2 gap-16 items-center px-4 md:px-16 py-16 min-h-screen">
    <div class="text-center md:text-left">
        <h1 class="text-5xl font-extrabold text-[#02311a] mb-4">Tu Guía <span class="text-[#0cad56]">para Decisiones</span> Universitarias</h1>
        <p class="text-gray-700 mb-8 text-lg">
            Ayudamos a estudiantes a encontrar su verdadera vocación mediante análisis personalizados, 
            pruebas de interés y orientación profesional.
        </p>
        <div class="space-x-4">
            <a href="#servicios" class="border border-[#02311a] text-[#02311a] px-8 py-4 rounded-lg hover:bg-[#dafee9] transition-all ease-in-out duration-300">
                Más Información
            </a>
        </div>
    </div>
    <div class="hidden md:flex md:items-center md:justify-center">
        <img src="{{ asset('img/Thesis-amico.svg') }}" alt="Orientación Vocacional" class="rounded-lg shadow-xl w-full max-w-md">
    </div>
</section>

<section id="servicios" class="mt-16 text-center px-4 md:px-16 py-16 min-h-screen">
    <h2 class="text-4xl font-bold text-[#02311a] mb-10">Nuestros Servicios</h2>
    <div class="grid sm:grid-cols-1 md:grid-cols-3 gap-12">
        <div class="bg-white p-8 rounded-2xl shadow-lg transition-transform hover:scale-105">
            <h3 class="text-xl font-semibold text-[#02311a] mb-4">Test de Intereses</h3>
            <p class="text-gray-600">
                Evaluaciones detalladas para descubrir tus pasiones y afinidades profesionales.
            </p>
        </div>
        <div class="bg-white p-8 rounded-2xl shadow-lg transition-transform hover:scale-105">
            <h3 class="text-xl font-semibold text-[#02311a] mb-4">Análisis de Carreras</h3>
            <p class="text-gray-600">
                Información completa sobre diferentes carreras universitarias y sus perspectivas.
            </p>
        </div>
        <div class="bg-white p-8 rounded-2xl shadow-lg transition-transform hover:scale-105">
            <h3 class="text-xl font-semibold text-[#02311a] mb-4">Asesoría Personalizada</h3>
            <p class="text-gray-600">
                Consultas individuales para orientar tu elección académica y profesional.
            </p>
        </div>
    </div>
</section>

<section id="nosotros" class="container mx-auto px-4 py-16 bg-[#02311a] min-h-screen" data-show-on-scroll>
    <div class="text-center mb-12">
        <h1 class="text-5xl font-extrabold text-white mb-6 leading-tight">
            Sobre Nosotros
        </h1>
        <p class="text-white text-xl mb-8 max-w-3xl mx-auto">
            Somos un equipo comprometido con ayudar a jóvenes a descubrir su verdadera vocación y potencial profesional.
        </p>
    </div>

    <div class="text-center max-w-3xl mx-auto mt-16">
        <h2 class="text-4xl font-semibold text-white mb-6">Nuestra Misión</h2>
        <p class="text-white mb-6 leading-relaxed text-lg">
            Guiamos a estudiantes en su journey académico, proporcionando herramientas de autoconocimiento, 
            análisis profesional y orientación personalizada para tomar decisiones informadas sobre su futuro.
        </p>
        <p class="text-white leading-relaxed text-lg">
            Creemos que cada estudiante tiene un camino único y nuestro objetivo es ayudarle a descubrirlo 
            con claridad, confianza y apoyo profesional.
        </p>
    </div>
</section>

<section id="vision" class="mt-16 px-4 py-16 min-h-screen">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-semibold text-[#02311a] mb-6">Nuestra Visión</h2>
        <p class="text-gray-700 max-w-2xl mx-auto">
            Aspiramos a ser líderes en orientación educativa y vocacional, expandiendo nuestro alcance a nivel global 
            para empoderar a más estudiantes en la toma de decisiones sobre su futuro académico y profesional.
        </p>
    </div>
</section>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif
<section id="contacto" class="mt-16 px-4 py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto max-w-lg">
        <h2 class="text-3xl font-semibold text-[#02311a] mb-8 text-center">Contáctanos</h2>
        <form action="{{ route('contact.store') }}" method="POST" class="bg-white p-8 rounded-2xl shadow-xl">
            @csrf
            <div class="mb-6">
                <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56]"
                       placeholder="Tu nombre completo">
            </div>

            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
                <input type="email" id="email" name="email" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56]"
                       placeholder="tucorreo@ejemplo.com">
            </div>

            <div class="mb-6">
                <label for="telefono" class="block text-gray-700 font-semibold mb-2">Teléfono (Opcional)</label>
                <input type="tel" id="telefono" name="telefono" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56]"
                       placeholder="10 dígitos">
            </div>

            <div class="mb-6">
                <label for="mensaje" class="block text-gray-700 font-semibold mb-2">Tu Mensaje</label>
                <textarea id="mensaje" name="mensaje" rows="4" required 
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56]"
                          placeholder="Escribe aquí tus dudas o consultas"></textarea>
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="politicas" required class="mr-2">
                    <span class="text-gray-700 text-sm">Acepto las políticas de privacidad</span>
                </label>
            </div>

            <div class="text-center">
                <button type="submit" 
                        class="bg-[#0cad56] text-white px-8 py-4 rounded-lg hover:bg-[#02311a] transition-all duration-300">
                    Enviar Mensaje
                </button>
            </div>
        </form>
    </div>
</section>

<style>
[data-show-on-scroll] {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

[data-show-on-scroll].is-visible {
    opacity: 1;
    transform: translateY(0);
}

/* Hacer que cada sección ocupe toda la pantalla */
section {
    min-height: 100vh;
    padding-top: 50px;
}
</style>

<script>
// Scroll suave entre secciones
document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('[data-show-on-scroll]').forEach(el => {
        observer.observe(el);
    });

    // Detener el scroll y hacerlo por bloques
    let isScrolling = false;

    window.addEventListener('wheel', function(e) {
        if (isScrolling) return;

        isScrolling = true;

        let delta = e.deltaY;
        if (delta > 0) {
            // Desplazar hacia abajo
            scrollToNextSection();
        } else {
            // Desplazar hacia arriba
            scrollToPrevSection();
        }
    });

    function scrollToNextSection() {
        const nextSection = getNextSection();
        if (nextSection) {
            window.scrollTo({
                top: nextSection.offsetTop,
                behavior: 'smooth'
            });
            setTimeout(() => { isScrolling = false; }, 1000); // Evitar scroll rápido
        }
    }

    function scrollToPrevSection() {
        const prevSection = getPrevSection();
        if (prevSection) {
            window.scrollTo({
                top: prevSection.offsetTop,
                behavior: 'smooth'
            });
            setTimeout(() => { isScrolling = false; }, 1000); // Evitar scroll rápido
        }
    }

    function getNextSection() {
        const sections = document.querySelectorAll('section');
        let currentIndex = 0;

        sections.forEach((section, index) => {
            if (section.getBoundingClientRect().top < window.innerHeight / 2) {
                currentIndex = index;
            }
        });

        return sections[currentIndex + 1];
    }

    function getPrevSection() {
        const sections = document.querySelectorAll('section');
        let currentIndex = 0;

        sections.forEach((section, index) => {
            if (section.getBoundingClientRect().top < window.innerHeight / 2) {
                currentIndex = index;
            }
        });

        return sections[currentIndex - 1];
    }
});
</script>

@endsection
