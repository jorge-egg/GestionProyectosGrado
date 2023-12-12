@extends('dashboard')
@section('estilos_adicionales')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel='stylesheet'>
@endsection
@section('dashboard_content')

<h1>Programas</h1>
    <br>
    <form action="{{ route('programas.store', $idSede) }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="programa" class="form-label">Nombre del programa</label>
            <input type="text" class="form-control @error('programa') is-invalid @enderror" id="programa" name="programa" required>
            @error('programa')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="siglas" class="form-label">Siglas del programa</label>
            <input type="text" class="form-control @error('siglas') is-invalid @enderror" id="siglas" name="siglas" required>
            @error('siglas')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="prog_facu" class="form-label">Facultad</label>
            <select class="form-control @error('prog_facu') is-invalid @enderror" id="prog_facu" name="prog_facu" required>
                <option value="" selected disabled>Seleccionar Facultad</option>
                @foreach ($facultades as $facultad)
                    <option value="{{ $facultad->idFacultad }}">{{ $facultad->nombre }}</option>
                @endforeach
            </select>
            @error('prog_facu')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn" style="background:#003E65; color:#fff">Agregar Programa</button>
    </form>
@if(session()->has('success'))
<div class= 'alert alert-success'>
{{session()->get('success')}}
</div>
@endif
<div class='col col-md-6 text-right'>
{{-- <form action="{{route('programas.index', ['idSede' => $idSede, 'view_deleted'=>'DeletedRecords'])}}" method="get">
<button  class='btn btn-warning'>Consultar programas eliminados</button> --}}
</form>
</div>
<table class="table table-hover shadow-lg mt-4" style="width:100%" id='table-js'>
        <thead>
            <tr>
                <th scope="col">Programa</th>
                <th scope="col">Siglas</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($programas as $programa)
                <tr>
                    <td>{{ $programa->programa }}</td>
                    <td>{{ $programa->siglas }}</td>
                    <td>
                        <form action="{{ route('programa.edit', $programa->idPrograma) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-warning">Editar</button>
                        </form>
                    </td>
                    <td>
                       @if(request()->has('view_deleted'))
                       <a href="{{route('programa.restore', $programa->idPrograma)}}" class="btn" style="background:#003E65; color:#fff">Restablecer</a>
                       @else
                        <form action="{{ route('programa.destroy', $programa->idPrograma) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-warning">Eliminar</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
@endsection
<script>
    let table = new DataTable('#prog');
</script>
@stop
