@extends('layouts.app')

@section('content')
<section class="grid md:grid-cols-2 gap-8 items-center">
    <div>
        <h1 class="text-4xl font-bold text-black mb-4">Tu Guía <span class="text-[#0cad56]">para Decisiones</span> Universitarias</h1>
        <p class="text-gray-600 mb-6">
            Ayudamos a estudiantes a encontrar su verdadera vocación mediante análisis personalizados, 
            pruebas de interés y orientación profesional.
        </p>
        <div class="space-x-4">
            <a href="#" class="border border-[#02311a] text-[#02311a] px-6 py-3 rounded-lg hover:bg-[#dafee9] transition">
                Más Información
            </a>
        </div>
    </div>
    <div class="hidden md:flex md:items-center md:justify-center">
        <img src="{{ asset('img/Thesis-amico.svg') }}" alt="Orientación Vocacional" class="rounded-lg shadow-lg w-96">
    </div>
</section>

<section class="mt-16 text-center">
    <h2 class="text-3xl font-bold text-[#02311a] mb-8">Nuestros Servicios</h2>
    <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-[#02311a] mb-4">Test de Intereses</h3>
            <p class="text-gray-600">
                Evaluaciones detalladas para descubrir tus pasiones y afinidades profesionales.
            </p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-[#02311a] mb-4">Análisis de Carreras</h3>
            <p class="text-gray-600">
                Información completa sobre diferentes carreras universitarias y sus perspectivas.
            </p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-[#02311a] mb-4">Asesoría Personalizada</h3>
            <p class="text-gray-600">
                Consultas individuales para orientar tu elección académica y profesional.
            </p>
        </div>
    </div>
</section>

<section class="container mx-auto px-4 py-16 bg-[#02311a]" data-show-on-scroll>
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-white mb-4">Sobre Nosotros</h1>
        <p class="text-white max-w-2xl mx-auto">
            Somos un equipo comprometido con ayudar a jóvenes a descubrir su verdadera vocación y potencial profesional.
        </p>
    </div>

    <div class="grid md:grid-cols-2 gap-12 items-center">
        <div data-show-on-scroll>
            <h2 class="text-3xl font-semibold text-white mb-6">Nuestra Misión</h2>
            <p class="text-white mb-4">
                Guiamos a estudiantes en su journey académico, proporcionando herramientas de autoconocimiento, 
                análisis profesional y orientación personalizada para tomar decisiones informadas sobre su futuro.
            </p>
            <p class="text-white">
                Creemos que cada estudiante tiene un camino único y nuestro objetivo es ayudarle a descubrirlo 
                con claridad, confianza y apoyo profesional.
            </p>
    </div>
</section>

<section class="mt-16 px-4 py-16">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-semibold text-[#02311a] mb-6">Nuestra Visión</h2>
        <p class="text-gray-700 max-w-2xl mx-auto">
            Aspiramos a ser líderes en orientación educativa y vocacional, expandiendo nuestro alcance a nivel global 
            para empoderar a más estudiantes en la toma de decisiones sobre su futuro académico y profesional.
        </p>
    </div>
</section>

<section class="mt-16 text-center bg-[#02311a]" data-show-on-scroll>
    <h2 class="text-3xl font-semibold text-white mb-8">Nuestro Equipo</h2>
    <div class="grid md:grid-cols-3 gap-8">
        @foreach([
            ['nombre' => 'María Rodríguez', 'cargo' => 'Directora de Orientación Vocacional', 'imagen' => 'persona1.jpg'],
            ['nombre' => 'Carlos Mendoza', 'cargo' => 'Psicólogo Vocacional', 'imagen' => 'persona2.jpg'],
            ['nombre' => 'Laura Sánchez', 'cargo' => 'Consultora Académica', 'imagen' => 'persona3.jpg']
        ] as $index => $miembro)
        <div class="text-center" data-show-on-scroll>
            <div class="mb-4 flex justify-center">
                <img src="{{ asset('img/team/'.$miembro['imagen']) }}" alt="{{ $miembro['nombre'] }}" 
                     class="w-48 h-48 object-cover rounded-full shadow-md">
            </div>
            <h3 class="text-xl font-semibold text-[#02311a]">
                {{ $miembro['nombre'] }}
            </h3>
            <p class="text-white">
                {{ $miembro['cargo'] }}
            </p>
        </div>
        @endforeach
    </div>
</section>

<section class="mt-16 px-4 py-16 bg-gray-50" id="contacto">
    <div class="container mx-auto max-w-lg">
        <h2 class="text-3xl font-semibold text-[#02311a] mb-8 text-center">Contáctanos</h2>
        <form action="" method="POST" class="bg-white p-8 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-bold mb-2">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56]"
                       placeholder="Tu nombre completo">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Correo Electrónico</label>
                <input type="email" id="email" name="email" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56]"
                       placeholder="tucorreo@ejemplo.com">
            </div>

            <div class="mb-4">
                <label for="telefono" class="block text-gray-700 font-bold mb-2">Teléfono (Opcional)</label>
                <input type="tel" id="telefono" name="telefono" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56]"
                       placeholder="10 dígitos">
            </div>

            <div class="mb-4">
                <label for="mensaje" class="block text-gray-700 font-bold mb-2">Tu Mensaje</label>
                <textarea id="mensaje" name="mensaje" rows="4" required 
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56]"
                          placeholder="Escribe aquí tus dudas o consultas"></textarea>
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="politicas" required class="mr-2">
                    <span class="text-gray-700 text-sm">Acepto las políticas de privacidad</span>
                </label>
            </div>

            <div class="text-center">
                <button type="submit" 
                        class="bg-[#0cad56] text-white px-6 py-3 rounded-lg hover:bg-[#02311a] transition duration-300">
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
});
</script>

@endsection