@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#f8f9fa] to-[#e9ecef] py-8">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header Mejorado -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
            <div class="text-center md:text-left mb-4 md:mb-0">
                <h1 class="text-3xl font-bold text-[#02311a] relative inline-block">
                    Gestión de Usuarios
                    <div class="absolute -bottom-1 left-0 w-full h-1 bg-gradient-to-r from-[#0cad56] to-[#02311a]"></div>
                </h1>
                <p class="text-gray-600 mt-2">Administra los usuarios registrados en el sistema</p>
            </div>
            <div class="flex justify-center md:justify-end">
                <div class="bg-white rounded-xl p-3 shadow-md border border-gray-200">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#0cad56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="text-gray-600">Total: {{ $users->count() }} usuarios</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mensajes de éxito con animación -->
        @if(session('success'))
            <div class="animate-slide-in fixed top-4 right-4 bg-green-50 border-l-4 border-[#0cad56] text-green-700 p-4 rounded shadow-lg max-w-md">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#0cad56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Contenedor de Usuarios -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($users as $user)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:border-[#0cad56]/40 transition-all duration-300 group">
                    <div class="p-6">
                        <!-- Cabecera del Usuario -->
                        <div class="flex items-start space-x-4 mb-4">
                            <div class="h-12 w-12 flex-shrink-0 rounded-xl bg-gradient-to-r from-[#0cad56] to-[#02311a] flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                                <span class="text-white font-bold text-lg">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h2 class="text-lg font-semibold text-gray-800 break-words">
                                    {{ $user->name }}
                                </h2>
                                <p class="text-sm text-gray-500 break-words">
                                    {{ $user->email }}
                                </p>
                            </div>
                        </div>

                        <!-- Línea separadora -->
                        <div class="border-t border-gray-100 my-4"></div>

                        <!-- Detalles del Usuario -->
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Rol</span>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                    {{ $user->hasRole('admin') ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $user->getRoleNames()->first() ?? 'Usuario' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Fecha de registro</span>
                                <span class="text-sm text-gray-700">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>

                        <!-- Acciones -->
                        @if(!$user->hasRole('admin'))
                            <div class="mt-6 pt-4 border-t border-gray-100">
                                <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST"
                                      onsubmit="return confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="w-full inline-flex items-center justify-center px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-300">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Eliminar usuario
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white rounded-xl p-8 text-center border border-gray-200 shadow-md">
                        <div class="inline-flex h-14 w-14 rounded-xl bg-green-100 items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-[#0cad56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-gray-800 text-lg font-semibold mb-2">No hay usuarios registrados</h3>
                        <p class="text-gray-500">Aún no hay usuarios en el sistema.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
@keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

.animate-slide-in {
    animation: slideIn 0.3s ease-out;
}

/* Estilizar la barra de desplazamiento */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: #0cad56;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #099548;
}

@media (max-width: 640px) {
    .grid {
        grid-template-columns: repeat(1, 1fr);
    }
}
</style>

<script>
function confirmDelete(event) {
    event.preventDefault();
    if (confirm('¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.')) {
        event.target.submit();
    }
}

// Animación para mensajes de éxito
@if(session('success'))
    setTimeout(() => {
        const alert = document.querySelector('.animate-slide-in');
        if (alert) {
            alert.style.opacity = '0';
            alert.style.transform = 'translateX(100%)';
            setTimeout(() => alert.remove(), 300);
        }
    }, 3000);
@endif
</script>
@endsection