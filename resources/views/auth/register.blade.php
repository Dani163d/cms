@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#f4f4f4] via-[#e8f5ef] to-[#d1f5e4] py-16 relative overflow-hidden">
    <!-- Elementos decorativos animados de fondo -->
    <div class="absolute inset-0 z-0 overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-br from-[#0cad56]/20 to-transparent rounded-full filter blur-3xl animate-blob"></div>
        <div class="absolute top-1/2 right-0 w-96 h-96 bg-gradient-to-bl from-[#02311a]/20 to-transparent rounded-full filter blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-gradient-to-tr from-[#0cad56]/20 to-transparent rounded-full filter blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="w-full max-w-5xl relative z-10 px-4 flex flex-col md:flex-row gap-8">
        <!-- Formulario de Registro -->
        <div class="w-full md:w-1/2">
            <div class="bg-white/90 shadow-2xl rounded-2xl overflow-hidden backdrop-blur-lg border border-white/20">
                <div class="bg-gradient-to-r from-[#02311a] to-[#0cad56] text-white text-center py-8 px-6 relative">
                    <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTYiIGhlaWdodD0iMjgiIHZpZXdCb3g9IjAgMCA1NiAyOCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNNTYgMEwwIDI4aDU2VjB6IiBmaWxsPSJyZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMDUpIi8+PC9zdmc+')] opacity-10"></div>
                    <h2 class="text-4xl font-bold mb-2 relative">Crear Cuenta</h2>
                    <p class="text-white/80 text-sm relative">¡Únete a nuestra comunidad!</p>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-white/30 to-transparent"></div>
                </div>
                
                <form method="POST" action="{{ route('register') }}" class="p-8 space-y-6">
                    @csrf
                    
                    <!-- Nombre -->
                    <div class="space-y-2">
                        <label for="name" class="block text-gray-700 font-bold text-sm uppercase tracking-wide">
                            Nombre Completo
                        </label>
                        <div class="relative group">
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                required 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-[#0cad56] transition-all duration-300 pl-12 group-hover:border-gray-300"
                                placeholder="Tu nombre completo"
                                value="{{ old('name') }}"
                            >
                            <svg class="w-6 h-6 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2 transition-colors duration-300 group-hover:text-[#0cad56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-gray-700 font-bold text-sm uppercase tracking-wide">
                            Correo Electrónico
                        </label>
                        <div class="relative group">
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                required 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-[#0cad56] transition-all duration-300 pl-12 group-hover:border-gray-300"
                                placeholder="tucorreo@ejemplo.com"
                                value="{{ old('email') }}"
                            >
                            <svg class="w-6 h-6 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2 transition-colors duration-300 group-hover:text-[#0cad56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="space-y-2">
                        <label for="password" class="block text-gray-700 font-bold text-sm uppercase tracking-wide">
                            Contraseña
                        </label>
                        <div class="relative group">
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                required 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-[#0cad56] transition-all duration-300 pl-12 group-hover:border-gray-300"
                                placeholder="••••••••"
                            >
                            <svg class="w-6 h-6 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2 transition-colors duration-300 group-hover:text-[#0cad56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-gray-700 font-bold text-sm uppercase tracking-wide">
                            Confirmar Contraseña
                        </label>
                        <div class="relative group">
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                id="password_confirmation" 
                                required 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-[#0cad56] transition-all duration-300 pl-12 group-hover:border-gray-300"
                                placeholder="••••••••"
                            >
                            <svg class="w-6 h-6 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2 transition-colors duration-300 group-hover:text-[#0cad56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-[#0cad56] to-[#02311a] text-white py-4 rounded-xl hover:opacity-95 transition-all duration-300 relative overflow-hidden group"
                    >
                        <span class="absolute w-64 h-64 mt-12 group-hover:-rotate-45 group-hover:-mt-24 transition-all duration-1000 ease-out -left-10 -top-20 bg-white opacity-10"></span>
                        <span class="relative">Crear Cuenta</span>
                    </button>

                    <div class="text-center pt-4">
                        <p class="text-gray-600 text-sm">
                            ¿Ya tienes una cuenta? 
                            <a href="{{ route('login') }}" class="text-[#0cad56] hover:text-[#02311a] font-semibold transition-colors duration-300">
                                Inicia Sesión
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sección informativa -->
        <div class="w-full md:w-1/2 flex items-center">
            <div class="bg-white/80 backdrop-blur-xl p-8 rounded-2xl shadow-xl border border-white/20 w-full">
                <div class="relative">
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-[#0cad56]/10 rounded-full filter blur-xl animate-pulse"></div>
                    <div class="bg-gradient-to-r from-[#0cad56] to-[#02311a] w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 transform rotate-45 hover:rotate-0 transition-all duration-300">
                        <svg class="w-10 h-10 text-white transform -rotate-45 hover:rotate-0 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>

                <h3 class="text-3xl font-bold text-[#02311a] text-center mb-6">Beneficios de Registrarte</h3>
                <p class="text-gray-600 text-center mb-8 leading-relaxed">
                    Únete a nuestra comunidad y disfruta de todas las ventajas que tenemos para ti.
                </p>

                <div class="space-y-6">
                    <div class="flex items-start space-x-4 p-4 bg-[#f8faf9] rounded-xl hover:bg-[#e8f5ef] transition-colors duration-300">
                        <div class="bg-[#0cad56] p-2 rounded-lg text-white shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-[#02311a]">Perfil Personalizado</h4>
                            <p class="text-sm text-gray-600">Crea y gestiona tu perfil académico personalizado.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 bg-[#f8faf9] rounded-xl hover:bg-[#e8f5ef] transition-colors duration-300">
                        <div class="bg-[#0cad56] p-2 rounded-lg text-white shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-[#02311a]">Notificaciones</h4>
                            <p class="text-sm text-gray-600">Recibe alertas sobre nuevas oportunidades y eventos.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 bg-[#f8faf9] rounded-xl hover:bg-[#e8f5ef] transition-colors duration-300">
                        <div class="bg-[#0cad56] p-2 rounded-lg text-white shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-[#02311a]">Comunidad</h4>
                            <p class="text-sm text-gray-600">Conecta con otros estudiantes y profesionales.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes blob {
    0%, 100% { transform: translate(0, 0) scale(1); }
    25% { transform: translate(20px, -50px) scale(1.1); }
    50% { transform: translate(-20px, 20px) scale(0.9); }
    75% { transform: translate(50px, 50px) scale(1.05); }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

input:focus {
    box-shadow: 0 0 0 3px rgba(12, 173, 86, 0.2);
}

/* Mejoras para dispositivos móviles */
@media (max-width: 768px) {
    .min-h-screen {
        padding: 2rem 1rem;
    }
}
</style>
@endsection