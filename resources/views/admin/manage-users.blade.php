@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#0f172a] via-[#1e1b4b] to-[#02311a] py-8">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white relative inline-block">
                Gestión de Usuarios
                <div class="absolute -bottom-1 left-0 w-full h-1 bg-gradient-to-r from-[#f79840] to-[#ff6b6b]"></div>
            </h1>
            <p class="text-gray-300 mt-2">Administra los usuarios registrados en el sistema</p>
        </div>

        <!-- Mensajes de éxito -->
        @if(session('success'))
            <div class="bg-[#0cad56]/20 border-l-4 border-[#0cad56] text-white p-4 mb-6 rounded backdrop-blur-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabla de Usuarios -->
        <div class="bg-[#1e1b4b] rounded-xl shadow-lg overflow-hidden border border-[#0cad56]/20">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[#2d2a5d]">
                    <thead class="bg-gradient-to-r from-[#02311a] to-[#0cad56]">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">
                                Usuario
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">
                                Rol
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">
                                Fecha de Registro
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#2d2a5d]">
                        @forelse($users as $user)
                            <tr class="hover:bg-[#2d2a5d]/50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-r from-[#f79840] to-[#ff6b6b] flex items-center justify-center">
                                                <span class="text-white font-semibold text-lg">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-white">
                                                {{ $user->name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-300">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $user->hasRole('admin') ? 'bg-[#0cad56]/20 text-[#0cad56]' : 'bg-[#f79840]/20 text-[#f79840]' }}">
                                        {{ $user->getRoleNames()->first() ?? 'Usuario' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-3">
                                        @if(!$user->hasRole('admin'))
                                            <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST"
                                                  onsubmit="return confirm('¿Estás seguro de querer eliminar este usuario?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-400 hover:text-red-300 transition-colors duration-200">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-400">
                                    No hay usuarios registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación (si la tienes) -->
        <div class="mt-6">
            {{-- Aquí tu paginación --}}
        </div>
    </div>
</div>

<style>
@media (max-width: 640px) {
    .overflow-x-auto {
        -webkit-overflow-scrolling: touch;
    }
}

/* Estilizar la barra de desplazamiento */
.overflow-x-auto::-webkit-scrollbar {
    height: 8px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #1e1b4b;
    border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #0cad56;
    border-radius: 4px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #099548;
}
</style>
@endsection