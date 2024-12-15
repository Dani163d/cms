
@extends('layouts.app')
@section('content')
<section class="grid md:grid-cols-2 gap-8 items-center">
    <div>
        <h1 class="text-4xl font-bold text-black mb-4">Tu Guía <span class="text-[#0cad56]">para Decisiones</span> Universitarias</h1>
        <p class="text-gray-600 mb-6 ">
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
        <img src="{{ asset('img/Thesis-amico.svg') }}" alt="Orientación Vocacional" class="rounded-lg shadow-lg  w-96">
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
@endsection