<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .nav-link {
            position: relative;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 50%;
            background-color: #0cad56;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 70%;
        }

        .dropdown-menu {
            transform-origin: top;
            transform: scaleY(0);
            transition: transform 0.2s ease;
        }

        .dropdown:hover .dropdown-menu {
            transform: scaleY(1);
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen flex flex-col bg-gray-50">
    <!-- Navbar -->
    <header class="bg-[#02311a] text-white shadow-lg relative z-20">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="bg-[#0cad56] p-2 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold">SysVocacional</span>
                    </a>
                </div>

                <!-- Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    @guest
                        <a href="{{ route('home') }}" class="nav-link">Inicio</a>
                        <a href="#nosotros" class="nav-link">Sobre Nosotros</a>
                        <a href="{{ route('login') }}" class="bg-[#0cad56] hover:bg-[#099548] px-6 py-2 rounded-full transition-colors duration-300">
                            Iniciar Sesión
                        </a>
                    @else
                        @if(auth()->user()->hasRole('admin'))
                            <div class="relative dropdown">
                                <button class="nav-link flex items-center space-x-1">
                                    <span>Administración</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 text-gray-700">
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">
                                        Registrar Publicador
                                    </a>
                                    <a href="{{ route('admin.edit-welcome') }}" class="block px-4 py-2 hover:bg-gray-100">
                                        Gestionar HomePage
                                    </a>
                                    <a href="{{ route('admin.manageUsers') }}" class="block px-4 py-2 hover:bg-gray-100">
                                        Gestionar Usuarios
                                    </a>
                                    <a href="{{ route('publisher.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">
                                        Gestionar Noticias
                                    </a>
                                </div>
                            </div>
                        @endif
                        <div class="relative dropdown">
                            <button class="nav-link flex items-center space-x-1">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 text-gray-700">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                <!-- Mobile menu button -->
                <button class="md:hidden text-white focus:outline-none" onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile menu -->
            <div id="mobileMenu" class="hidden md:hidden mt-4 space-y-2">
                @guest
                    <a href="{{ route('home') }}" class="block py-2 hover:text-[#0cad56]">Inicio</a>
                    <a href="#nosotros" class="block py-2 hover:text-[#0cad56]">Sobre Nosotros</a>
                    <a href="{{ route('login') }}" class="block py-2 hover:text-[#0cad56]">Iniciar Sesión</a>
                @else
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" class="block py-2 hover:text-[#0cad56]">Registrar Publicador</a>
                        <a href="{{ route('admin.manageUsers') }}" class="block py-2 hover:text-[#0cad56]">Gestionar Usuarios</a>
                        <a href="{{ route('publisher.dashboard') }}" class="block py-2 hover:text-[#0cad56]">Gestionar Noticias</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left py-2 hover:text-[#0cad56]">
                            Cerrar Sesión
                        </button>
                    </form>
                @endguest
            </div>
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

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

   <!-- Footer -->
<footer class="bg-[#02311a] text-white py-8">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="grid md:grid-cols-3 gap-8 items-start justify-items-center text-center md:text-left">
            <!-- Logo y descripción -->
            <div class="w-full max-w-xs">
                <div class="flex items-center justify-center md:justify-start space-x-2 mb-3">
                    <div class="bg-[#0cad56] p-1.5 rounded-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <span class="text-lg font-bold">SysVocacional</span>
                </div>
                <p class="text-gray-300 text-sm">
                    Transformando decisiones estudiantiles en éxito profesional.
                </p>
            </div>

            <!-- Enlaces Rápidos -->
            <div class="w-full max-w-xs">
                <h4 class="text-base font-semibold mb-3">Enlaces Rápidos</h4>
                <ul class="space-y-1.5">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-300 hover:text-[#0cad56] transition-colors duration-300 text-sm">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="#nosotros" class="text-gray-300 hover:text-[#0cad56] transition-colors duration-300 text-sm">
                            Sobre Nosotros
                        </a>
                    </li>
                    <li>
                        <a href="#contacto" class="text-gray-300 hover:text-[#0cad56] transition-colors duration-300 text-sm">
                            Contáctanos
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contacto -->
            <div class="w-full max-w-xs">
                <h4 class="text-base font-semibold mb-3">Contacto</h4>
                <ul class="space-y-1.5">
                    <li class="flex items-center justify-center md:justify-start space-x-2">
                        <svg class="w-4 h-4 text-[#0cad56] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-gray-300 text-sm">daniela1205xc@gmail.com</span>
                    </li>
                    <li class="flex items-center justify-center md:justify-start space-x-2">
                        <svg class="w-4 h-4 text-[#0cad56] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="text-gray-300 text-sm">+58 424 168 5140</span>
                    </li>
                    <li class="flex items-center justify-center md:justify-start space-x-2">
                        <svg class="w-4 h-4 text-[#0cad56] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="text-gray-300 text-sm">+58 412 264 3949</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-800 mt-6 pt-6 text-center">
            <p class="text-gray-400 text-xs">
                © {{ date('Y') }} SysVocacional. Todos los derechos reservados.
            </p>
        </div>
    </div>
</footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
    </script>

    @stack('scripts')
</body>
</html>