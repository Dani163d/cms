{{-- resources/views/admin/careers/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#FFF5F0] to-[#FFE4D6] py-4 px-2">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8 relative">
            <h1 class="text-3xl md:text-4xl font-bold text-[#FF7F50] relative inline-block">
                Registrar Carrera
                <div class="absolute -bottom-1 left-0 w-full h-1 bg-gradient-to-r from-[#FF9F7D] to-[#FF7F50]"></div>
            </h1>
            <p class="text-gray-600 mt-2 text-lg">Gestiona las carreras disponibles en la institución</p>
        </div>

        <!-- Grid de contenido -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Formulario -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
                <div class="bg-gradient-to-r from-[#FF7F50] to-[#FF9F7D] p-4">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white/10 p-2 rounded-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">Nueva Carrera</h2>
                            <p class="text-white/80 text-sm">Complete el formulario para registrar una nueva carrera</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.carreras.store') }}" class="p-6 space-y-5">
                    @csrf
                    
                    <!-- Nombre de la Carrera -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700 block">Nombre de la Carrera</label>
                        <div class="relative group">
                            <input 
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="w-full px-4 py-2 rounded-xl border-2 border-gray-200 focus:border-[#FF9F7D] focus:ring-2 focus:ring-[#FF9F7D]/20 transition-all duration-300 pl-10"
                                placeholder="Ej: Ingeniería en Sistemas"
                            >
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2 group-hover:text-[#FF9F7D] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Duración -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700 block">Duración</label>
                        <div class="relative group">
                            <input 
                                type="text"
                                name="duration"
                                value="{{ old('duration') }}"
                                class="w-full px-4 py-2 rounded-xl border-2 border-gray-200 focus:border-[#FF9F7D] focus:ring-2 focus:ring-[#FF9F7D]/20 transition-all duration-300 pl-10"
                                placeholder="Ej: 5 años"
                            >
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2 group-hover:text-[#FF9F7D] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            @error('duration')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700 block">Descripción</label>
                        <div class="relative group">
                            <textarea 
                                name="description"
                                rows="4"
                                class="w-full px-4 py-2 rounded-xl border-2 border-gray-200 focus:border-[#FF9F7D] focus:ring-2 focus:ring-[#FF9F7D]/20 transition-all duration-300 pl-10"
                                placeholder="Descripción detallada de la carrera..."
                            >{{ old('description') }}</textarea>
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-8 transform -translate-y-1/2 group-hover:text-[#FF9F7D] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Botón de envío -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-[#FF9F7D] to-[#FF7F50] text-white py-3 rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 relative overflow-hidden group"
                    >
                        <span class="absolute w-full h-full bg-gradient-to-r from-white/0 via-white/50 to-white/0 transform -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-in-out"></span>
                        <span class="relative flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span>Registrar Carrera</span>
                        </span>
                    </button>
                </form>
            </div>

            <!-- Panel informativo -->
            <div class="bg-white rounded-2xl shadow-xl p-6 transform hover:scale-[1.02] transition-all duration-300">
                <div class="mb-6">
                    <div class="bg-gradient-to-r from-[#FF9F7D] to-[#FF7F50] w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#FF7F50] text-center mb-4">Información Importante</h3>
                </div>

                <div class="space-y-4">
                    <div class="flex items-start space-x-3 p-3 rounded-xl hover:bg-[#FFF5F0] transition-colors duration-300">
                        <div class="bg-[#FFE4D6] p-2 rounded-lg">
                            <svg class="w-5 h-5 text-[#FF9F7D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-[#FF7F50] mb-1">Datos Precisos</h4>
                            <p class="text-sm text-gray-600">Asegúrese de ingresar información precisa y actualizada de la carrera.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 p-3 rounded-xl hover:bg-[#FFF5F0] transition-colors duration-300">
                        <div class="bg-[#FFE4D6] p-2 rounded-lg">
                            <svg class="w-5 h-5 text-[#FF9F7D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-[#FF7F50] mb-1">Descripción Detallada</h4>
                            <p class="text-sm text-gray-600">Incluya información relevante sobre el plan de estudios y salidas profesionales.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3 p-3 rounded-xl hover:bg-[#FFF5F0] transition-colors duration-300">
                        <div class="bg-[#FFE4D6] p-2 rounded-lg">
                            <svg class="w-5 h-5 text-[#FF9F7D]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-[#FF7F50] mb-1">Duración</h4>
                            <p class="text-sm text-gray-600">Especifique la duración total de la carrera en años o semestres.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes shine {
    to {
        transform: translateX(100%);
    }
}

input:focus, textarea:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(255, 159, 125, 0.2);
}

@media (max-width: 768px) {
    .min-h-screen {
        padding: 1.5rem;
    }
}
</style>
@endsection