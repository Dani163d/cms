@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#f8f9fa] to-[#e9ecef] py-8 px-4">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-10 relative">
            <h1 class="text-4xl md:text-5xl font-bold text-[#02311a] relative inline-block">
                Registrar Publicador
                <div class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-[#0cad56] to-[#02311a]"></div>
            </h1>
            <p class="text-gray-600 mt-4 text-lg">Gestiona los accesos de tu equipo de publicación</p>
        </div>

        <!-- Grid de contenido -->
        <div class="grid md:grid-cols-2 gap-8 items-start">
            <!-- Formulario -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-[#02311a] to-[#0cad56] p-6">
                    <div class="flex items-center space-x-4">
                        <div class="bg-white/10 p-3 rounded-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white">Nuevo Publicador</h2>
                            <p class="text-white/80 text-sm">Complete el formulario para crear una nueva cuenta</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.createUser') }}" class="p-8 space-y-6">
                    @csrf
                    
                    <!-- Nombre -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700 block">Nombre Completo</label>
                        <div class="relative group">
                            <input 
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0cad56] focus:ring-0 transition-colors pl-12"
                                placeholder="Nombre del publicador"
                            >
                            <svg class="w-6 h-6 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700 block">Correo Electrónico</label>
                        <div class="relative group">
                            <input 
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0cad56] focus:ring-0 transition-colors pl-12"
                                placeholder="correo@ejemplo.com"
                            >
                            <svg class="w-6 h-6 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Contraseña -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700 block">Contraseña</label>
                        <div class="relative group">
                            <input 
                                type="password"
                                name="password"
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0cad56] focus:ring-0 transition-colors pl-12"
                                placeholder="••••••••"
                            >
                            <svg class="w-6 h-6 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700 block">Confirmar Contraseña</label>
                        <div class="relative group">
                            <input 
                                type="password"
                                name="password_confirmation"
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0cad56] focus:ring-0 transition-colors pl-12"
                                placeholder="••••••••"
                            >
                            <svg class="w-6 h-6 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Botón de envío -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-[#0cad56] to-[#02311a] text-white py-4 rounded-xl hover:opacity-90 transition-all duration-300 relative overflow-hidden group"
                    >
                        <span class="absolute w-64 h-64 mt-12 group-hover:-rotate-45 group-hover:-mt-24 transition-all duration-1000 ease-out -left-10 -top-20 bg-white opacity-10"></span>
                        <span class="relative">Registrar Publicador</span>
                    </button>

                    @if(session('success'))
                        <div class="bg-green-50 border-l-4 border-green-500 p-4 mt-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700">
                                        {{ session('success') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
            </div>

            <!-- Panel informativo -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <div class="mb-8">
                    <div class="bg-gradient-to-r from-[#0cad56] to-[#02311a] w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#02311a] text-center mb-4">Información Importante</h3>
                </div>

                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="bg-[#e8f5ef] p-3 rounded-lg">
                            <svg class="w-6 h-6 text-[#0cad56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-[#02311a] mb-1">Acceso Temporal</h4>
                            <p class="text-sm text-gray-600">La contraseña inicial debe ser cambiada en el primer inicio de sesión.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-[#e8f5ef] p-3 rounded-lg">
                            <svg class="w-6 h-6 text-[#0cad56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-[#02311a] mb-1">Seguridad</h4>
                            <p class="text-sm text-gray-600">Asegúrese de usar contraseñas seguras y no compartir credenciales.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-[#e8f5ef] p-3 rounded-lg">
                            <svg class="w-6 h-6 text-[#0cad56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-[#02311a] mb-1">Permisos</h4>
                            <p class="text-sm text-gray-600">Los publicadores tienen acceso limitado a funciones específicas del sistema.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
input:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(12, 173, 86, 0.2);
}

@media (max-width: 768px) {
    .min-h-screen {
        padding: 2rem 1rem;
    }
}
</style>
@endsection