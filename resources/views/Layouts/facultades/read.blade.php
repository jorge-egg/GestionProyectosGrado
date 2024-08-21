@extends('dashboard')
@section('estilos_adicionales')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"
        rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel='stylesheet'>
@endsection
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
        <button type="submit" class="btn" style="background:#003E65; color:#fff">Agregar</button>
    </form>
    @if (session()->has('success'))
        <div class= 'alert alert-success'>
            {{ session()->get('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class= 'alert alert-danger'>
            {{ session()->get('error') }}
        </div>
    @endif
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
                            <form action="{{ route('facultades.edit', ['idSede' => $id, 'idFacultad' => $facultad->idFacultad]) }}" method="get">
                                <button type="submit" class="btn btn-warning">Editar</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('facultades.destroy', [$facultad->idFacultad, $idSede]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-warning">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

@stop
