@extends('dashboard')

@section('dashboard_content')

    <h1>Crear Usuario</h1>

    <form action="{{ route('usuarios.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido:</label>
            <input type="text" name="apellido" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="numeroCelular" class="form-label">Número de Celular:</label>
            <input type="text" name="numeroCelular" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="usua_sede" class="form-label">Sede:</label>
            <select name="usua_sede" class="form-select" required>
                @foreach ($sedes as $sede)
                    <option value="{{ $sede->idSede }}">{{ $sede->sede }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="usuario" class="form-label">Usuario:</label>
            <input type="text" name="usuario" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="roles" class="form-label">Roles:</label>
            <select name="roles[]" class="form-select" multiple required>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Crear Usuario</button>
    </form>

@endsection
