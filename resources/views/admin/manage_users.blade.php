@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Usuarios Registrados</h1>

    <!-- Publicadores -->
    <section class="mb-8">
        <h2 class="text-2xl font-semibold text-[#02311a] mb-4">Publicadores</h2>
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto text-left border-collapse">
                <thead>
                    <tr class="bg-[#02311a] text-white">
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Correo Electrónico</th>
                        <th class="px-4 py-2">Fecha de Creación</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publishers as $publisher)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $publisher->name }}</td>
                            <td class="px-4 py-2">{{ $publisher->email }}</td>
                            <td class="px-4 py-2">{{ $publisher->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-2 flex gap-4">
                                <!-- Cambiar rol -->
                                <form action="{{ route('admin.changeRole', ['id' => $publisher->id, 'role' => 'visitor']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-blue-600 hover:underline">Cambiar a Visitante</button>
                                </form>
                                <!-- Eliminar usuario -->
                                <form action="{{ route('admin.deleteUser', $publisher->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- Visitantes -->
    <section>
        <h2 class="text-2xl font-semibold text-[#02311a] mb-4">Visitantes</h2>
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto text-left border-collapse">
                <thead>
                    <tr class="bg-[#02311a] text-white">
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Correo Electrónico</th>
                        <th class="px-4 py-2">Fecha de Creación</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visitors as $visitor)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $visitor->name }}</td>
                            <td class="px-4 py-2">{{ $visitor->email }}</td>
                            <td class="px-4 py-2">{{ $visitor->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-2 flex gap-4">
                                <!-- Cambiar rol -->
                                <form action="{{ route('admin.changeRole', ['id' => $visitor->id, 'role' => 'publisher']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-blue-600 hover:underline">Cambiar a Publicador</button>
                                </form>
                                <!-- Eliminar usuario -->
                                <form action="{{ route('admin.deleteUser', $visitor->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
