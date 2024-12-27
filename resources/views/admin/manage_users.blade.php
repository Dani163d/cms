@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#f8f9fa] to-[#e9ecef] py-8 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-10">
            <h1 class="text-4xl font-bold text-[#02311a] mb-2">Panel de Usuarios</h1>
            <p class="text-gray-600">Gestiona los usuarios y sus roles en el sistema</p>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center">
                    <div class="bg-[#e8f5ef] p-3 rounded-lg">
                        <svg class="w-6 h-6 text-[#0cad56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Total Usuarios</p>
                        <p class="text-2xl font-bold text-[#02311a]">{{ $publishers->count() + $visitors->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center">
                    <div class="bg-[#e8f5ef] p-3 rounded-lg">
                        <svg class="w-6 h-6 text-[#0cad56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Publicadores</p>
                        <p class="text-2xl font-bold text-[#02311a]">{{ $publishers->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center">
                    <div class="bg-[#e8f5ef] p-3 rounded-lg">
                        <svg class="w-6 h-6 text-[#0cad56]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Visitantes</p>
                        <p class="text-2xl font-bold text-[#02311a]">{{ $visitors->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-8">
            <div class="flex border-b">
                <button onclick="switchTab('publishers')" class="tab-button active-tab px-6 py-4 text-lg font-medium focus:outline-none" data-tab="publishers">
                    Publicadores
                </button>
                <button onclick="switchTab('visitors')" class="tab-button px-6 py-4 text-lg font-medium focus:outline-none" data-tab="visitors">
                    Visitantes
                </button>
            </div>

            <!-- Tabla Publicadores -->
            <div id="publishers-tab" class="tab-content block">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 text-sm">
                                <th class="px-6 py-4 text-left">Nombre</th>
                                <th class="px-6 py-4 text-left">Correo Electrónico</th>
                                <th class="px-6 py-4 text-left">Fecha de Registro</th>
                                <th class="px-6 py-4 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($publishers as $publisher)
                            <tr class="border-t hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-[#e8f5ef] rounded-full flex items-center justify-center mr-3">
                                            <span class="text-[#0cad56] font-medium">{{ strtoupper(substr($publisher->name, 0, 1)) }}</span>
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $publisher->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $publisher->email }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $publisher->created_at->format('d M, Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <form action="{{ route('admin.changeRole', ['id' => $publisher->id, 'role' => 'visitor']) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-blue-600 hover:text-blue-800 transition-colors">
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                                    </svg>
                                                    Cambiar Rol
                                                </span>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.deleteUser', $publisher->id) }}" method="POST" onsubmit="return confirm('¿Confirmas la eliminación de este usuario?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors">
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Eliminar
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tabla Visitantes -->
            <div id="visitors-tab" class="tab-content hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 text-gray-600 text-sm">
                                <th class="px-6 py-4 text-left">Nombre</th>
                                <th class="px-6 py-4 text-left">Correo Electrónico</th>
                                <th class="px-6 py-4 text-left">Fecha de Registro</th>
                                <th class="px-6 py-4 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($visitors as $visitor)
                            <tr class="border-t hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-[#e8f5ef] rounded-full flex items-center justify-center mr-3">
                                            <span class="text-[#0cad56] font-medium">{{ strtoupper(substr($visitor->name, 0, 1)) }}</span>
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $visitor->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $visitor->email }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $visitor->created_at->format('d M, Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <form action="{{ route('admin.changeRole', ['id' => $visitor->id, 'role' => 'publisher']) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-blue-600 hover:text-blue-800 transition-colors">
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                                    </svg>
                                                    Cambiar Rol
                                                </span>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.deleteUser', $visitor->id) }}" method="POST" onsubmit="return confirm('¿Confirmas la eliminación de este usuario?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors">
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Eliminar
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.tab-button {
    color: #666;
    border-bottom: 2px solid transparent;
    transition: all 0.3s;
}

.tab-button:hover {
    color: #02311a;
}

.active-tab {
    color: #02311a;
    border-bottom: 2px solid #0cad56;
}

.tab-content {
    transition: all 0.3s ease-in-out;
}
</style>

<script>
function switchTab(tabName) {
    // Ocultar todos los contenidos
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.add('hidden');
    });
    
    // Mostrar el contenido seleccionado
    document.getElementById(tabName + '-tab').classList.remove('hidden');
    
    // Actualizar estados de los botones
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active-tab');
    });
    
    // Activar el botón seleccionado
    event.currentTarget.classList.add('active-tab');
}
</script>
@endsection