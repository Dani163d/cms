@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Usuarios Registrados</h1>

    <!-- Sección de Publicadores -->
    <section class="mb-8">
        <h2 class="text-2xl font-semibold text-[#02311a] mb-4">Publicadores</h2>
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto text-left border-collapse">
                <thead>
                    <tr class="bg-[#02311a] text-white">
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Correo Electrónico</th>
                        <th class="px-4 py-2">Fecha de Creación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publishers as $publisher)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $publisher->name }}</td>
                            <td class="px-4 py-2">{{ $publisher->email }}</td>
                            <td class="px-4 py-2">{{ $publisher->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- Sección de Visitantes -->
    <section>
        <h2 class="text-2xl font-semibold text-[#02311a] mb-4">Visitantes</h2>
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto text-left border-collapse">
                <thead>
                    <tr class="bg-[#02311a] text-white">
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Correo Electrónico</th>
                        <th class="px-4 py-2">Fecha de Creación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visitors as $visitor)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $visitor->name }}</td>
                            <td class="px-4 py-2">{{ $visitor->email }}</td>
                            <td class="px-4 py-2">{{ $visitor->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
