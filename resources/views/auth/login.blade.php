@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#f4f4f4] via-[#e8f5ef] to-[#d1f5e4] relative overflow-hidden">
    <!-- Elementos decorativos de fondo -->
    <div class="absolute inset-0 z-0 overflow-hidden">
        <div class="absolute top-0 left-0 w-72 h-72 bg-gradient-to-br from-[#0cad56]/20 to-transparent rounded-full filter blur-2xl animate-blob"></div>
        <div class="absolute top-1/2 right-0 w-72 h-72 bg-gradient-to-bl from-[#02311a]/20 to-transparent rounded-full filter blur-2xl animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-0 left-1/4 w-72 h-72 bg-gradient-to-tr from-[#0cad56]/20 to-transparent rounded-full filter blur-2xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="w-full max-w-4xl relative z-10 px-4 flex flex-col md:flex-row gap-6">
        <!-- Formulario de Login -->
        <div class="w-full md:w-1/2">
            <div class="bg-white/90 shadow-xl rounded-xl overflow-hidden backdrop-blur-lg border border-white/20">
                <div class="bg-gradient-to-r from-[#02311a] to-[#0cad56] text-white text-center py-6 px-4 relative">
                    <h2 class="text-2xl font-bold mb-1 relative">Iniciar Sesión</h2>
                    <p class="text-white/80 text-sm relative">Bienvenido de vuelta a tu espacio personal</p>
                </div>
                
                <form method="POST" action="{{ route('login') }}" class="p-6 space-y-4">
                    @csrf
                    
                    <!-- Email input -->
                    <div class="space-y-1">
                        <label for="email" class="block text-gray-700 text-xs uppercase tracking-wide font-bold">
                            Correo Electrónico
                        </label>
                        <div class="relative group">
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                required 
                                class="w-full px-3 py-2 bg-white border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#0cad56] transition-all duration-300 pl-10 text-gray-700"
                                placeholder="tucorreo@ejemplo.com"
                                value="{{ old('email') }}"
                            >
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Password input -->
                    <div class="space-y-1">
                        <label for="password" class="block text-gray-700 text-xs uppercase tracking-wide font-bold">
                            Contraseña
                        </label>
                        <div class="relative group">
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                required 
                                class="w-full px-3 py-2 bg-white border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#0cad56] transition-all duration-300 pl-10 text-gray-700"
                                placeholder="••••••••"
                            >
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Remember me and Forgot password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-2 cursor-pointer group">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                id="remember" 
                                class="rounded bg-white border-gray-300 text-[#0cad56] focus:ring-[#0cad56]"
                            >
                            <span class="text-gray-600 text-xs">Recuérdame</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="text-xs text-[#0cad56] hover:text-[#02311a] transition-colors duration-300">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>

                    <!-- Submit button -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-[#0cad56] to-[#02311a] text-white py-2.5 rounded-lg hover:opacity-95 transition-all duration-300 transform hover:scale-[1.02] relative overflow-hidden group text-sm"
                    >
                        <span class="absolute w-64 h-64 mt-12 group-hover:-rotate-45 group-hover:-mt-24 transition-all duration-1000 ease-out -left-10 -top-20 bg-white opacity-10"></span>
                        <span class="relative">Iniciar Sesión</span>
                    </button>

                    <!-- Register link -->
                    <div class="text-center pt-2">
                        <p class="text-gray-600 text-xs">
                            ¿No tienes una cuenta? 
                            <a href="{{ route('register') }}" class="text-[#0cad56] hover:text-[#02311a] font-semibold transition-colors duration-300">
                                Regístrate aquí
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sección informativa -->
        <div class="w-full md:w-1/2 flex items-center">
            <div class="bg-white/80 backdrop-blur-xl p-6 rounded-xl shadow-lg border border-white/20 w-full">
                <div class="relative">
                    <div class="absolute -top-3 -right-3 w-16 h-16 bg-[#0cad56]/10 rounded-full filter blur-lg animate-pulse"></div>
                    <div class="bg-gradient-to-r from-[#0cad56] to-[#02311a] w-16 h-16 rounded-xl flex items-center justify-center mx-auto mb-4 transform rotate-45 hover:rotate-0 transition-all duration-300">
                        <svg class="w-8 h-8 text-white transform -rotate-45 hover:rotate-0 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                </div>

                <h3 class="text-2xl font-bold text-[#02311a] text-center mb-4">¡Mantente Informado!</h3>
                <p class="text-gray-600 text-center mb-6 text-sm leading-relaxed">
                    Inicia sesión para acceder a contenido exclusivo y mantenerte actualizado.
                </p>

                <div class="space-y-4">
                    <!-- Características -->
                    <div class="flex items-start space-x-3 p-3 bg-[#f8faf9] rounded-lg hover:bg-[#e8f5ef] transition-colors duration-300">
                        <div class="bg-[#0cad56] p-1.5 rounded-lg text-white shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-[#02311a] text-sm">Nuevas Oportunidades</h4>
                            <p class="text-xs text-gray-600">Accede a las últimas oportunidades académicas.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 p-3 bg-[#f8faf9] rounded-lg hover:bg-[#e8f5ef] transition-colors duration-300">
                        <div class="bg-[#0cad56] p-1.5 rounded-lg text-white shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-[#02311a] text-sm">Eventos Exclusivos</h4>
                            <p class="text-xs text-gray-600">Mantente al día con eventos de orientación.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 p-3 bg-[#f8faf9] rounded-lg hover:bg-[#e8f5ef] transition-colors duration-300">
                        <div class="bg-[#0cad56] p-1.5 rounded-lg text-white shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-[#02311a] text-sm">Consejos Personalizados</h4>
                            <p class="text-xs text-gray-600">Recibe consejos adaptados a tus objetivos.</p>
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
    25% { transform: translate(20px, -30px) scale(1.1); }
    50% { transform: translate(-20px, 20px) scale(0.9); }
    75% { transform: translate(30px, 30px) scale(1.05); }
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

/* Estilos para los inputs */
input::placeholder {
    color: rgba(75, 85, 99, 0.5);
}

input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus {
    -webkit-text-fill-color: #1f2937;
    -webkit-box-shadow: 0 0 0px 1000px white inset;
    transition: background-color 5000s ease-in-out 0s;
}
</style>
@endsection