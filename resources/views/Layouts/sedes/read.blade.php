@extends('dashboard')

@section('dashboard_content')

<h1>usuarios</h1>
    <br>
<table class="table">
        <thead>
            <tr>
                <th scope="col">Sede</th>
                <th scope="col">Telefono</th>
                <th scope="col">E-mail</th>
                <th scope="col">Direccion</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <tbody>
            @foreach ($sedes as $sede)
                <tr>
                    <td>{{ $sede->sede }}</td>
                    <td>{{ $sede->telefono }}</td>
                    <td>{{ $sede->email }}</td>
                    <td>{{ $sede->direccion }}</td>
                    <td>
                        <form action="{{ route('facultades.read', $sede->idSede) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-success">Facultades</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('sedes.edit', $sede->idSede) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-success">Editar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop
