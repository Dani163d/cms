@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Bienvenido al Panel de Administración</h1>
        <p>Desde aquí puedes gestionar el sistema y los usuarios.</p>
        
        <a href="{{ route('admin.manage_users') }}">Gestionar usuarios</a>
        <a href="{{ route('admin.settings') }}">Configuración</a>
    </div>
@endsection
