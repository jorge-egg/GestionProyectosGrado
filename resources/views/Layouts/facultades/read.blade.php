@extends('dashboard')

@section('dashboard_content')

<h1>usuarios</h1>
    <br>
<table class="table">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->nombre }}</td>
                    <td>
                        <form action="{{ route('usuarios.edit', $usuario->numeroDocumento) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-success">Editar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop
