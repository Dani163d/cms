@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#f4f4f4] py-16">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-[#02311a] text-white text-center py-6">
                <h2 class="text-3xl font-bold">Crear Cuenta</h2>
            </div>
            
            <form method="POST" action="{{ route('register') }}" class="p-8">
                @csrf
                
                {{-- Name Input --}}
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">
                        Nombre Completo
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56]"
                        placeholder="Tu nombre completo"
                        value="{{ old('name') }}"
                    >
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email Input --}}
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">
                        Correo Electrónico
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56]"
                        placeholder="tucorreo@ejemplo.com"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Input --}}
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">
                        Contraseña
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56]"
                        placeholder="Contraseña"
                    >
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password Input --}}
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">
                        Confirmar Contraseña
                    </label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56]"
                        placeholder="Confirmar contraseña"
                    >
                </div>

                {{-- Submit Button --}}
                <div class="mb-4">
                    <button 
                        type="submit" 
                        class="w-full bg-[#0cad56] text-white py-3 rounded-lg hover:bg-[#02311a] transition duration-300"
                    >
                        Registrarse
                    </button>
                </div>

                {{-- Login Link --}}
                <div class="text-center">
                    <p class="text-gray-700">
                        ¿Ya tienes una cuenta? 
                        <a href="{{ route('login') }}" class="text-[#0cad56] hover:underline">
                            Iniciar Sesión
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection