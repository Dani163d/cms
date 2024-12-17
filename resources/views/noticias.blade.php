@extends('layouts.app')

@section('content')
<section class="">
<div class="mt-16 text-center">
            <div class="flex flex-wrap justify-center gap-4">
                @php
                $categorias = [
                    'Orientación Vocacional',
                    'Carreras Profesionales',
                    'Educación Superior',
                    'Desarrollo Personal',
                    'Tendencias Laborales'
                ];
                @endphp

                @foreach($categorias as $categoria)
                <a href="#" class="bg-gray-100 text-[#02311a] px-4 py-2 rounded-full hover:bg-[#0cad56] hover:text-white transition">
                    {{ $categoria }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>


    <div class="container mx-auto px-4">
        {{-- Featured Article Section --}}
        <div class="mb-16 p-8">
        <h1 class="text-4xl font-bold text-[#02311a] mb-8 text-center">Últimas Noticias y Artículos</h1>
            <div class="grid md:grid-cols-2 gap-8 items-center bg-[#f4f4f4] rounded-lg overflow-hidden shadow-md">
                <div>
                    <img src="{{ asset('img/noticias/articulo-destacado.jpg') }}" 
                         alt="Artículo Destacado" 
                         class="w-full h-96 object-cover">
                </div>
                <div class="p-8">
                    <span class="text-sm text-gray-500 mb-2 block">Artículo Principal | 20 de Marzo, 2024</span>
                    <h3 class="text-2xl font-bold text-[#02311a] mb-4">
                        Transformando el Futuro: Innovación en Orientación Vocacional
                    </h3>
                    <p class="text-gray-700 mb-6">
                        Exploramos cómo la tecnología y la inteligencia artificial están revolucionando 
                        la forma en que los jóvenes descubren su verdadera vocación. Un vistazo profundo 
                        a las nuevas herramientas que están cambiando la orientación profesional.
                    </p>
                    <a href="#" class="inline-block bg-[#0cad56] text-white px-6 py-3 rounded-lg hover:bg-[#02311a] transition">
                        Leer Artículo Completo
                    </a>
                </div>
            </div>
        </div>


    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-8">
            @foreach([
                [
                    'titulo' => 'Guía Completa: Cómo Elegir tu Carrera Universitaria',
                    'extracto' => 'Descubre los pasos clave para tomar una decisión informada sobre tu futuro académico.',
                    'imagen' => 'noticia1.jpg',
                    'fecha' => '15 de Marzo, 2024',
                    'link' => '#'
                ],
                [
                    'titulo' => 'Tendencias Laborales 2024: Carreras con Mayor Demanda',
                    'extracto' => 'Analizamos los campos profesionales con más oportunidades en el mercado actual.',
                    'imagen' => 'noticia2.jpg',
                    'fecha' => '22 de Febrero, 2024',
                    'link' => '#'
                ],
                [
                    'titulo' => 'Psicología Vocacional: Claves para Encontrar tu Pasión',
                    'extracto' => 'Expertos comparten estrategias para descubrir tu verdadera vocación profesional.',
                    'imagen' => 'noticia3.jpg',
                    'fecha' => '10 de Enero, 2024',
                    'link' => '#'
                ],
                [
                    'titulo' => 'Innovación Educativa: Nuevas Carreras del Futuro',
                    'extracto' => 'Exploramos las carreras emergentes que están transformando el mercado laboral.',
                    'imagen' => 'noticia4.jpg',
                    'fecha' => '5 de Diciembre, 2023',
                    'link' => '#'
                ],
                [
                    'titulo' => 'Consejos para Superar la Ansiedad en la Elección Profesional',
                    'extracto' => 'Estrategias prácticas para manejar la presión y tomar decisiones asertivas.',
                    'imagen' => 'noticia5.jpg',
                    'fecha' => '18 de Noviembre, 2023',
                    'link' => '#'
                ],
                [
                    'titulo' => 'Entrevista a Profesionales: Sus Mejores Consejos',
                    'extracto' => 'Profesionales exitosos comparten sus experiencias y recomendaciones de carrera.',
                    'imagen' => 'noticia6.jpg',
                    'fecha' => '30 de Octubre, 2023',
                    'link' => '#'
                ]
            ] as $noticia)
            <div class="bg-white rounded-lg shadow-md overflow-hidden transition hover:shadow-xl">
                <img src="{{ asset('img/noticias/'.$noticia['imagen']) }}" 
                     alt="{{ $noticia['titulo'] }}" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <span class="text-sm text-gray-500 mb-2 block">{{ $noticia['fecha'] }}</span>
                    <h2 class="text-xl font-semibold text-[#02311a] mb-4">{{ $noticia['titulo'] }}</h2>
                    <p class="text-gray-600 mb-4">{{ $noticia['extracto'] }}</p>
                    <a href="{{ $noticia['link'] }}" 
                       class="inline-block bg-[#0cad56] text-white px-4 py-2 rounded-lg hover:bg-[#02311a] transition">
                        Leer Más
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        
@endsection