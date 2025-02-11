@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#f8f9fa] to-[#e9ecef] py-6">
    <!-- Barra de progreso superior -->
    <div class="fixed top-0 left-0 w-full h-1 bg-gray-200">
        <div class="h-full bg-gradient-to-r from-[#0cad56] to-[#02311a] w-full"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl font-bold text-[#02311a] relative inline-block">
                    Gestión de Carreras
                    <div class="absolute -bottom-1 left-0 w-full h-1 bg-gradient-to-r from-[#0cad56] to-[#02311a]"></div>
                </h1>
                <p class="text-gray-600 mt-2">Administra las carreras disponibles en el sistema</p>
            </div>
            <button 
                onclick="openModal('createCareerModal')"
                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#0cad56] to-[#02311a] text-white rounded-xl hover:opacity-90 transition-all duration-300 transform hover:scale-105"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Nueva Carrera
            </button>
        </div>

        @if(session('success'))
            <div class="fixed top-4 right-4 bg-[#0cad56]/10 border-l-4 border-[#0cad56] p-4 rounded-lg animate-slide-in">
                <p class="text-[#02311a]">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Grid de Carreras -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($careers as $career)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="border-b-2 border-gray-100">
                        <div class="bg-gradient-to-r from-[#02311a] to-[#0cad56] p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-white/10 p-2 rounded-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-white">{{ $career->name }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <!-- Contenido de la card -->
                        <div class="space-y-4">
                            <p class="text-gray-600 text-sm">{{ $career->description }}</p>
                            
                            <div class="flex items-center gap-4 text-sm">
                                <div class="flex items-center text-[#0cad56]">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $career->duration }} años
                                </div>
                                <div class="flex items-center text-gray-500">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    {{ $career->user->name }}
                                </div>
                            </div>

                            <!-- Botones de acción -->
                            <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100">
                                <button 
                                    onclick="openEditModal({{ $career->id }})"
                                    class="inline-flex items-center px-3 py-2 text-sm text-[#0cad56] hover:bg-[#0cad56]/10 rounded-lg transition-colors duration-300">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Editar
                                </button>
                                <form action="{{ route('admin.deleteCareer', $career->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="button"
                                        onclick="confirmDelete(this.parentElement)"
                                        class="inline-flex items-center px-3 py-2 text-sm text-red-500 hover:bg-red-50 rounded-lg transition-colors duration-300">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="text-center py-12 bg-white rounded-2xl shadow-sm">
                        <div class="bg-gradient-to-r from-[#0cad56] to-[#02311a] w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#02311a] mb-2">No hay carreras registradas</h3>
                        <p class="text-gray-500 mb-4">Comience agregando una nueva carrera al sistema</p>
                        <button 
                            onclick="openModal('createCareerModal')"
                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#0cad56] to-[#02311a] text-white rounded-xl hover:opacity-90 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Agregar Carrera
                        </button>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal para crear carrera -->
<div id="createCareerModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl m-4 overflow-hidden transform transition-all">
        <!-- Header del modal con gradiente -->
        <div class="bg-gradient-to-r from-[#02311a] to-[#0cad56] p-4">
            <div class="flex items-center justify-between">
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
                <button onclick="closeModal('createCareerModal')" class="text-white/80 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Formulario -->
        <form action="{{ route('admin.createCareer') }}" method="POST" class="p-6 space-y-5">
            @csrf
            
            <!-- Nombre de la Carrera -->
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700 block">Nombre de la Carrera</label>
                <div class="relative group">
                    <input type="text" name="name" required
                        class="w-full px-4 py-2 rounded-xl border-2 border-gray-200 focus:border-[#0cad56] focus:ring-0 transition-colors pl-10"
                        placeholder="Ej: Ingeniería en Sistemas">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>

            <!-- Duración -->
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700 block">Duración (años)</label>
                <div class="relative group">
                    <input type="number" name="duration" required min="1"
                        class="w-full px-4 py-2 rounded-xl border-2 border-gray-200 focus:border-[#0cad56] focus:ring-0 transition-colors pl-10"
                        placeholder="Ej: 5">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Descripción -->
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700 block">Descripción</label>
                <div class="relative group">
                    <textarea name="description" required rows="4"
                        class="w-full px-4 py-2 rounded-xl border-2 border-gray-200 focus:border-[#0cad56] focus:ring-0 transition-colors pl-10"
                        placeholder="Descripción detallada de la carrera..."></textarea>
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-8 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </div>
            </div>

            <!-- Botón de envío -->
            <button type="submit" 
                class="w-full bg-gradient-to-r from-[#0cad56] to-[#02311a] text-white py-3 rounded-xl hover:opacity-90 transition-all duration-300 relative overflow-hidden group">
                <span class="absolute w-48 h-48 mt-10 group-hover:-rotate-45 group-hover:-mt-20 transition-all duration-1000 ease-out -left-8 -top-16 bg-white opacity-10"></span>
                <span class="relative">Registrar Carrera</span>
            </button>
        </form>
    </div>
</div>

<!-- Modal para editar carrera -->
<div id="editCareerModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl m-4 overflow-hidden">
        <!-- Header del modal con gradiente -->
        <div class="bg-gradient-to-r from-[#02311a] to-[#0cad56] p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="bg-white/10 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Editar Carrera</h2>
                        <p class="text-white/80 text-sm">Modifique los datos de la carrera</p>
                    </div>
                </div>
                <button onclick="closeModal('editCareerModal')" class="text-white/80 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Formulario de edición -->
        <form id="editCareerForm" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')
            
            <!-- Nombre de la Carrera -->
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700 block">Nombre de la Carrera</label>
                <div class="relative group">
                    <input type="text" name="name" id="editName" required
                        class="w-full px-4 py-2 rounded-xl border-2 border-gray-200 focus:border-[#0cad56] focus:ring-0 transition-colors pl-10">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>

            <!-- Duración -->
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700 block">Duración (años)</label>
                <div class="relative group">
                    <input type="number" name="duration" id="editDuration" required min="1"
                        class="w-full px-4 py-2 rounded-xl border-2 border-gray-200 focus:border-[#0cad56] focus:ring-0 transition-colors pl-10">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Descripción -->
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700 block">Descripción</label>
                <div class="relative group">
                    <textarea name="description" id="editDescription" required rows="4"
                        class="w-full px-4 py-2 rounded-xl border-2 border-gray-200 focus:border-[#0cad56] focus:ring-0 transition-colors pl-10"></textarea>
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-8 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('editCareerModal')"
                    class="px-4 py-2 border-2 border-gray-200 rounded-xl hover:bg-gray-50 transition-colors duration-300">
                    Cancelar
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-gradient-to-r from-[#0cad56] to-[#02311a] text-white rounded-xl hover:opacity-90 transition-all duration-300">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.getElementById(modalId).classList.add('flex');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.getElementById(modalId).classList.remove('flex');
}

function openEditModal(careerId) {
    fetch(`/api/careers/${careerId}`)
        .then(response => response.json())
        .then(career => {
            document.getElementById('editName').value = career.name;
            document.getElementById('editDescription').value = career.description;
            document.getElementById('editDuration').value = career.duration;
            document.getElementById('editCareerForm').action = `/admin/edit-welcome/career/${careerId}`;
            openModal('editCareerModal');
        });
}

function confirmDelete(form) {
    if (confirm('¿Estás seguro de que deseas eliminar esta carrera?')) {
        form.submit();
    }
}

// Cerrar modales al hacer clic fuera
window.onclick = function(event) {
    if (event.target.classList.contains('fixed')) {
        event.target.classList.add('hidden');
        event.target.classList.remove('flex');
    }
}

// Animación para mensajes de éxito
@if(session('success'))
    setTimeout(() => {
        const alert = document.querySelector('.animate-slide-in');
        if (alert) {
            alert.classList.add('opacity-0');
            setTimeout(() => alert.remove(), 300);
        }
    }, 3000);
@endif
</script>

<style>
@keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

.animate-slide-in {
    animation: slideIn 0.3s ease-out;
    transition: opacity 0.3s ease-out;
}

/* Estilos para inputs y textareas en foco */
input:focus, textarea:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(12, 173, 86, 0.2);
}

/* Scroll suave */
html {
    scroll-behavior: smooth;
}

/* Responsive ajustes */
@media (max-width: 640px) {
    .fixed {
        position: sticky;
        top: 0;
    }
}
</style>
@endsection