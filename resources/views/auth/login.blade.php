@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#f4f4f4] py-16">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-[#02311a] text-white text-center py-6">
                <h2 class="text-3xl font-bold">Iniciar Sesión</h2>
            </div>
            
            <form method="POST" action="{{ route('login') }}" class="p-8">
                @csrf
                
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

                {{-- Remember Me --}}
                <div class="mb-4 flex items-center">
                    <input 
                        type="checkbox" 
                        name="remember" 
                        id="remember" 
                        class="mr-2 rounded text-[#0cad56] focus:ring-[#0cad56]"
                    >
                    <label for="remember" class="text-gray-700">
                        Recuérdame
                    </label>
                </div>

                {{-- Submit Button --}}
                <div class="mb-4">
                    <button 
                        type="submit" 
                        class="w-full bg-[#0cad56] text-white py-3 rounded-lg hover:bg-[#02311a] transition duration-300"
                    >
                        Iniciar Sesión
                    </button>
                </div>

                {{-- Forgot Password and Register Links --}}
                <div class="text-center">
                    <a href="{{ route('password.request') }}" class="text-[#0cad56] hover:underline">
                        ¿Olvidaste tu contraseña?
                    </a>
                    <p class="mt-4 text-gray-700">
                        ¿No tienes una cuenta? 
                        <a href="{{ route('register') }}" class="text-[#0cad56] hover:underline">
                            Regístrate
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection