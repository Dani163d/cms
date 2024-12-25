
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class=" bg-gray-100">
        <body class="bg-gray-50 font-sans antialiased">
    <header class="bg-[#02311a] text-white py-4 shadow-md">
        <nav class="container mx-auto flex justify-between items-center px-4">
            <div class="text-2xl font-bold">Sistema Vocacional</div>
            <ul class="flex space-x-6">
            <li><a href="{{ route('home') }}" class="hover:text-[#0cad56]">Inicio</a></li>
                <li><a class="hover:text-[#0cad56]">Sobre Nosotros</a></li>
                <li><a  class="hover:text-[#0cad56]">Contáctanos</a></li>
                @guest
            <li><a href="{{ route('login') }}" class="hover:text-[#0cad56]">Login</a></li>
        @else
            <li>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-[#0cad56]">Cerrar Sesión</button>
                </form>
            </li>
        @endguest
            </ul>
        </nav>
    </header>

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main
        </div>

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
                <li><a href="{{ route('home') }}" class="hover:text-[#0cad56]">Inicio</a></li>
                    <li><a  class="text-white hover:underline">Sobre Nosotros</a></li>
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
