@extends('layouts.app')

@section('content')
<section id="intro" class="grid md:grid-cols-2 gap-16 items-center px-4 md:px-16 py-16 min-h-screen bg-gradient-to-br from-white to-[#f0fff7]">
    <div class="text-center md:text-left animate-fadeIn">
        <h1 class="text-6xl font-extrabold text-[#02311a] mb-6 leading-tight">
            Tu Guía <span class="text-[#0cad56] relative">
                para Decisiones
                <svg class="absolute w-full h-3 -bottom-2 left-0 text-[#0cad56]/20" viewBox="0 0 100 10">
                    <path d="M0 5 Q 25 0, 50 5 T 100 5" fill="none" stroke="currentColor" stroke-width="3"/>
                </svg>
            </span> Universitarias
        </h1>
        <p class="text-gray-700 mb-10 text-xl leading-relaxed">
            Ayudamos a estudiantes a encontrar su verdadera vocación mediante análisis personalizados, 
            pruebas de interés y orientación profesional.
        </p>
        <div class="space-x-6">
            <a href="#servicios" class="inline-block bg-[#02311a] text-white px-8 py-4 rounded-lg hover:bg-[#0cad56] transition-all duration-300 transform hover:scale-105 shadow-lg">
                Más Información
            </a>
            <a href="#contacto" class="inline-block border-2 border-[#02311a] text-[#02311a] px-8 py-4 rounded-lg hover:bg-[#dafee9] transition-all duration-300 transform hover:scale-105">
                Contáctanos
            </a>
        </div>
    </div>
    <div class="hidden md:flex md:items-center md:justify-center animate-float">
        <img src="{{ asset('img/Thesis-amico.svg') }}" alt="Orientación Vocacional" class="rounded-2xl shadow-2xl w-full max-w-md transform hover:scale-105 transition-transform duration-300">
    </div>
</section>

<section id="nosotros" class="relative px-4 py-16 bg-gradient-to-br from-[#02311a] to-[#024c2d] min-h-screen" data-show-on-scroll>
    <div class="absolute inset-0 bg-[#02311a]/10 backdrop-blur-sm"></div>
    <div class="container mx-auto max-w-6xl relative">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-extrabold text-white mb-6 leading-tight">
                Sobre Nosotros
                <div class="h-1 w-24 bg-[#0cad56] mx-auto mt-4"></div>
            </h2>
            <p class="text-white/90 text-xl mb-8 max-w-3xl mx-auto">
                Somos un equipo comprometido con ayudar a jóvenes a descubrir su verdadera vocación y potencial profesional.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 shadow-xl transform hover:-translate-y-2 transition-all duration-300">
                <div class="bg-[#0cad56] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"/>
                    </svg>
                </div>
                <h3 class="text-3xl font-semibold text-white mb-6 text-center">Nuestra Misión</h3>
                <p class="text-white/90 leading-relaxed text-lg mb-6">
                    Guiamos a estudiantes en su journey académico, proporcionando herramientas de autoconocimiento, 
                    análisis profesional y orientación personalizada para tomar decisiones informadas sobre su futuro.
                </p>
            </div>

            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 shadow-xl transform hover:-translate-y-2 transition-all duration-300">
                <div class="bg-[#0cad56] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                </div>
                <h3 class="text-3xl font-semibold text-white mb-6 text-center">Nuestra Visión</h3>
                <p class="text-white/90 leading-relaxed text-lg mb-6">
                    Aspiramos a ser líderes en orientación educativa y vocacional, expandiendo nuestro alcance a nivel global 
                    para empoderar a más estudiantes en la toma de decisiones sobre su futuro académico y profesional.
                </p>
            </div>
        </div>

        <!-- Sección de valores o características adicionales -->
        <div class="grid md:grid-cols-3 gap-8 mt-16">
            <div class="text-center">
                <div class="bg-[#0cad56] w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h4 class="text-xl font-semibold text-white mb-2">Experiencia</h4>
                <p class="text-white/80">Más de 10 años guiando estudiantes</p>
            </div>
            <div class="text-center">
                <div class="bg-[#0cad56] w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h4 class="text-xl font-semibold text-white mb-2">Calidad</h4>
                <p class="text-white/80">Asesoramiento personalizado</p>
            </div>
            <div class="text-center">
                <div class="bg-[#0cad56] w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h4 class="text-xl font-semibold text-white mb-2">Innovación</h4>
                <p class="text-white/80">Métodos modernos y efectivos</p>
            </div>
        </div>
    </div>
</section>

<section id="contacto" class="mt-16 px-4 py-16 bg-[#f8faf9] min-h-screen">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4 max-w-lg mx-auto" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <div class="container mx-auto max-w-lg">
        <h2 class="text-4xl font-bold text-[#02311a] mb-8 text-center">
            Contáctanos
            <div class="h-1 w-24 bg-[#0cad56] mx-auto mt-4"></div>
        </h2>
        <form action="{{ route('contact.store') }}" method="POST" class="bg-white p-8 rounded-2xl shadow-2xl">
            @csrf
            <div class="mb-6">
                <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56] transition-all duration-300"
                       placeholder="Tu nombre completo">
            </div>

            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
                <input type="email" id="email" name="email" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56] transition-all duration-300"
                       placeholder="tucorreo@ejemplo.com">
            </div>

            <div class="mb-6">
                <label for="telefono" class="block text-gray-700 font-semibold mb-2">Teléfono (Opcional)</label>
                <input type="tel" id="telefono" name="telefono" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56] transition-all duration-300"
                       placeholder="10 dígitos">
            </div>

            <div class="mb-6">
                <label for="mensaje" class="block text-gray-700 font-semibold mb-2">Tu Mensaje</label>
                <textarea id="mensaje" name="mensaje" rows="4" required 
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56] transition-all duration-300"
                          placeholder="Escribe aquí tus dudas o consultas"></textarea>
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="politicas" required class="mr-2 text-[#0cad56] focus:ring-[#0cad56]">
                    <span class="text-gray-700 text-sm">Acepto las políticas de privacidad</span>
                </label>
            </div>

            <div class="text-center">
                <button type="submit" 
                        class="bg-[#0cad56] text-white px-8 py-4 rounded-lg hover:bg-[#02311a] transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Enviar Mensaje
                </button>
            </div>
        </form>
    </div>
</section>

<style>
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(0px); }
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

.animate-fadeIn {
    animation: fadeIn 1s ease-out forwards;
}

[data-show-on-scroll] {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

[data-show-on-scroll].is-visible {
    opacity: 1;
    transform: translateY(0);
}

section {
    min-height: 100vh;
    padding-top: 50px;
    position: relative;
    overflow: hidden;
}

input:focus, textarea:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(12, 173, 86, 0.2);
}

html {
    scroll-behavior: smooth;
}

/* Mejoras para dispositivos móviles */
@media (max-width: 768px) {
    h1 {
        font-size: 2.5rem;
    }
    
    section {
        padding-top: 30px;
    }
    
    .animate-float {
        animation: none;
    }
}
</style>

<script>
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

    let isScrolling = false;

    window.addEventListener('wheel', function(e) {
        if (isScrolling) return;

        isScrolling = true;

        let delta = e.deltaY;
        if (delta > 0) {
            scrollToNextSection();
        } else {
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
            setTimeout(() => { isScrolling = false; }, 1000);
        }
    }

    function scrollToPrevSection() {
        const prevSection = getPrevSection();
        if (prevSection) {
            window.scrollTo({
                top: prevSection.offsetTop,
                behavior: 'smooth'
            });
            setTimeout(() => { isScrolling = false; }, 1000);
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