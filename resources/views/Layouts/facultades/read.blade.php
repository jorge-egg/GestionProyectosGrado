@extends('dashboard')

@section('dashboard_content')

    <h1>Facultades</h1>
    <br>
    <form action="{{ route('facultades.store', $id) }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la facultad</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" required>
            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary text-dark">Agregar</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($facultades as $facultad)
                @if (count($facultades) <= 0)
                    <tr>
                        <td colspan='6'>No hay resultados</td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $facultad->nombre }}</td>
                        <td>
                            <form action="" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-success">Editar</button>
                            </form>
                        </td>
                        <td>
                            <form action="" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

@stop
