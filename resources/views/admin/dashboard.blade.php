@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col bg-[#f4f4f4] py-16">
    

    <div class="w-full max-w-md mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-[#02311a] text-white text-center py-6">
                <h2 class="text-3xl font-bold">Registrar un Publicador</h2>
            </div>
            
            <!-- Formulario para crear un nuevo usuario -->
            <form method="POST" action="{{ route('admin.createUser') }}" class="p-8">
                @csrf
                
                <!-- Campo de nombre -->
                <div class="mb-6">
                    <label for="name" class="block text-[#02311a] font-bold mb-2">Nombre</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name') }}" 
                        required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56] transition duration-200"
                        placeholder="Nombre completo"
                    >
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Campo de correo electrónico -->
                <div class="mb-6">
                    <label for="email" class="block text-[#02311a] font-bold mb-2">Correo Electrónico</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}" 
                        required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56] transition duration-200"
                        placeholder="tucorreo@ejemplo.com"
                    >
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Campo de contraseña -->
                <div class="mb-6">
                    <label for="password" class="block text-[#02311a] font-bold mb-2">Contraseña</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56] transition duration-200"
                        placeholder="Contraseña"
                    >
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Campo de confirmación de contraseña -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-[#02311a] font-bold mb-2">Confirmar Contraseña</label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0cad56] transition duration-200"
                        placeholder="Confirmar contraseña"
                    >
                </div>

                <!-- Botón para enviar el formulario -->
                <div class="mb-6">
                    <button 
                        type="submit" 
                        class="w-full bg-[#0cad56] text-white py-3 rounded-lg hover:bg-[#02311a] transition duration-300"
                    >
                        Registrar Publicador
                    </button>
                </div>

                <!-- Mensaje de éxito -->
                @if(session('success'))
                    <div class="text-green-500 text-center mb-4">
                        {{ session('success') }}
                    </div>
                @endif

            </form>
        </div>
    </div>
</div>
@endsection