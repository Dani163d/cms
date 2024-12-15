<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SysVocacional') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <header class="bg-[#02311a] text-white py-4 shadow-md">
        <nav class="container mx-auto flex justify-between items-center px-4">
            <div class="text-2xl font-bold">Sistema Vocacional</div>
            <ul class="flex space-x-6">
                <li><a  class="hover:text-blue-200">Inicio</a></li>
                <li><a class="hover:text-blue-200">Sobre Nosotros</a></li>
                <li><a  class="hover:text-blue-200">Blog/Noticias</a></li>
                <li><a  class="hover:text-blue-200">Contáctanos</a></li>
            </ul>
        </nav>
    </header>

    <main class="container mx-auto mt-8 px-4">
        @yield('content')
    </main>

    <footer class="bg-[#02311a] text-white py-8 mt-16">
        <div class="container mx-auto px-4 grid md:grid-cols-3 gap-8">
            <div>
                <h4 class="font-bold mb-4">SysVocacional</h4>
                <p class="text-white">
                    Transformando decisiones estudiantiles en éxito profesional.
                </p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Enlaces Rápidos</h4>
                <ul>
                    <li><a  class="text-white hover:underline ">Inicio</a></li>
                    <li><a  class="text-white hover:underline">Sobre Nosotros</a></li>
                    <li><a  class="text-white hover:underline">Blog</a></li>
                    <li><a  class="text-white hover:underline">Contáctanos</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Contacto</h4>
                <p class="text-white">
                    Email: info@sysvocacional.com<br>
                    Teléfono: +58 424 168 5140, +58 412 264 3949
                </p>
            </div>
        </div>
    </footer>
</body>
</html>