@extends('layouts.app')

@section('content')

<!-- Sección de Introducción -->
<section id="intro" class="grid md:grid-cols-2 gap-12 items-center px-4 md:px-12 py-12 min-h-screen">
    <div class="text-center md:text-left">
        <h1 class="text-4xl font-extrabold text-[#02311a] mb-4">Tu Guía <span class="text-[#0cad56]">para Decisiones</span> Universitarias</h1>
        <p class="text-gray-700 mb-6 text-lg md:text-xl">
            Ayudamos a estudiantes a encontrar su verdadera vocación mediante análisis personalizados, pruebas de interés y orientación profesional.
        </p>
        <div class="space-x-4">
            <a href="#servicios" class="border border-[#02311a] text-[#02311a] px-6 py-3 rounded-lg hover:bg-[#dafee9] transition-all ease-in-out duration-300">
                Más Información
            </a>
        </div>
    </div>
    <div class="hidden md:flex md:items-center md:justify-center">
        <img src="{{ asset('img/Thesis-amico.svg') }}" alt="Orientación Vocacional" class="rounded-xl shadow-lg w-full max-w-md">
    </div>
</section>

<!-- Sección de Servicios -->
<section id="servicios" class="mt-16 text-center px-4 md:px-12 py-12 min-h-screen bg-white">
    <h2 class="text-3xl font-bold text-[#02311a] mb-8">Nuestros Servicios</h2>
    <div class="grid sm:grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Servicio 1 -->
        <div class="bg-white p-6 rounded-xl shadow-lg hover:scale-105 hover:shadow-xl transition-all">
            <h3 class="text-2xl font-semibold text-[#02311a] mb-4">Test de Intereses</h3>
            <p class="text-gray-600 text-base">
                Ofrecemos evaluaciones detalladas para ayudarte a descubrir tus pasiones, intereses y afinidades profesionales. Con nuestras pruebas psicológicas y de interés, podrás obtener una visión clara de las opciones que mejor se alinean con tus habilidades.
            </p>
        </div>
        <!-- Servicio 2 -->
        <div class="bg-white p-6 rounded-xl shadow-lg hover:scale-105 hover:shadow-xl transition-all">
            <h3 class="text-2xl font-semibold text-[#02311a] mb-4">Análisis de Carreras</h3>
            <p class="text-gray-600 text-base">
                Proporcionamos un análisis exhaustivo de las carreras universitarias, sus perspectivas laborales y los requisitos académicos. Te ayudamos a entender los desafíos y oportunidades de cada carrera para que puedas tomar una decisión informada.
            </p>
        </div>
        <!-- Servicio 3 -->
        <div class="bg-white p-6 rounded-xl shadow-lg hover:scale-105 hover:shadow-xl transition-all">
            <h3 class="text-2xl font-semibold text-[#02311a] mb-4">Asesoría Personalizada</h3>
            <p class="text-gray-600 text-base">
                Ofrecemos asesoría individualizada para que puedas evaluar tus intereses y habilidades, y encontrar la mejor opción académica y profesional para ti. Con nuestra ayuda, podrás tomar decisiones más claras y con mayor confianza.
            </p>
        </div>
    </div>
</section>

<!-- Sección Sobre Nosotros -->
<section id="nosotros" class="container mx-auto px-4 py-12 bg-[#02311a] min-h-screen" data-show-on-scroll>
    <div class="text-center mb-8">
        <h1 class="text-4xl font-extrabold text-white mb-4 leading-tight">
            Sobre Nosotros
        </h1>
        <p class="text-white text-lg mb-6 max-w-3xl mx-auto">
            Somos un equipo apasionado por ayudar a los jóvenes a descubrir su verdadera vocación y alcanzar su máximo potencial profesional. A través de herramientas de autoconocimiento y asesoría personalizada, acompañamos a los estudiantes en su proceso de toma de decisiones.
        </p>
    </div>

    <div class="text-center max-w-3xl mx-auto mt-12">
        <h2 class="text-3xl font-semibold text-white mb-4">Nuestra Misión</h2>
        <p class="text-white mb-6 leading-relaxed text-lg">
            Guiamos a los estudiantes en su journey académico, proporcionándoles herramientas para que tomen decisiones más informadas y alineadas con sus verdaderas pasiones y habilidades. Creemos que el autoconocimiento es la clave para el éxito.
        </p>
        <p class="text-white leading-relaxed text-lg">
            Nuestro objetivo es ofrecer acompañamiento integral en todas las etapas de su decisión, desde la elección de una carrera hasta el diseño de un plan de vida profesional, todo basado en las necesidades y sueños de cada estudiante.
        </p>
    </div>
</section>

<!-- Sección Visión -->
<section id="vision" class="mt-16 px-4 py-12 min-h-screen bg-[#f7fafc]">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-semibold text-[#02311a] mb-6">Nuestra Visión</h2>
        <p class="text-gray-700 max-w-2xl mx-auto text-lg">
            Aspiramos a ser un referente global en la orientación educativa y vocacional. Nuestra visión es empoderar a miles de estudiantes alrededor del mundo, ayudándoles a tomar decisiones claras y acertadas que los lleven a una vida académica y profesional exitosa.
        </p>
    </div>
</section>

<!-- Sección de Contacto -->
<section id="contacto" class="mt-16 px-4 py-12 bg-gray-50 min-h-screen">
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif
    <div class="container mx-auto max-w-lg">
        <h2 class="text-3xl font-semibold text-[#02311a] mb-8 text-center">Contáctanos</h2>
        <form action="{{ route('contact.store') }}" method="POST" class="bg-white p-8 rounded-xl shadow-lg">
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
                        class="bg-[#0cad56] text-white px-6 py-3 rounded-lg hover:bg-[#02311a] transition-all duration-300">
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

section {
    min-height: 100vh;
    padding-top: 40px;
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
