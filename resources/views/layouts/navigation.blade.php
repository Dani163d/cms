<!-- Navigation -->
<div class="hidden md:flex items-center space-x-6">
    @guest
        <a href="{{ route('home') }}" class="nav-link">Inicio</a>
        <a href="#nosotros" class="nav-link">Sobre Nosotros</a>
        <a href="{{ route('login') }}" class="bg-[#FF9F7D] hover:bg-[#FF7F50] text-white px-6 py-2 rounded-full transition-colors duration-300">
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
                        Panel de Control
                    </a>
                    <a href="{{ route('admin.manageUsers') }}" class="block px-4 py-2 hover:bg-gray-100">
                        Gestionar Usuarios
                    </a>
                    <a href="{{ route('admin.edit-welcome') }}" class="block px-4 py-2 hover:bg-gray-100">
                        Gestionar HomePage
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
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">
                    Mi Perfil
                </a>
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

<!-- Mobile menu -->
<div id="mobileMenu" class="hidden md:hidden mt-4 space-y-2">
    @guest
        <a href="{{ route('home') }}" class="block py-2 hover:text-[#FF7F50]">Inicio</a>
        <a href="#nosotros" class="block py-2 hover:text-[#FF7F50]">Sobre Nosotros</a>
        <a href="{{ route('login') }}" class="block py-2 hover:text-[#FF7F50]">Iniciar Sesión</a>
    @else
        @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('admin.dashboard') }}" class="block py-2 hover:text-[#FF7F50]">Panel de Control</a>
            <a href="{{ route('admin.manageUsers') }}" class="block py-2 hover:text-[#FF7F50]">Gestionar Usuarios</a>
            <a href="{{ route('admin.edit-welcome') }}" class="block py-2 hover:text-[#FF7F50]">Gestionar HomePage</a>
        @endif
        <a href="{{ route('profile.edit') }}" class="block py-2 hover:text-[#FF7F50]">Mi Perfil</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left py-2 hover:text-[#FF7F50]">
                Cerrar Sesión
            </button>
        </form>
    @endguest
</div>