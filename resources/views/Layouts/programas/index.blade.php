@extends('dashboard')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel='stylesheet'>
@endsection
@section('dashboard_content')

<h1>Programas</h1>
    <br>
    <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del programa</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="programa" name="programa" required>
            <label for="nombre" class="form-label">Sigla del programa</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="siglas" name="siglas" required>
            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-outline-success">Agregar</button>
    </form>
@if(session()->has('success'))
<div class= 'alert alert-success'>
{{session()->get('success')}}
</div>
@endif
<div class='col col-md-6 text-right'>
<a href="{{route('comite.index',['view_deleted'=>'DeletedRecords'])}}"class='btn btn-outline-warning'>Consultar comites eliminados</a>
</div>
<table class="table table-hover shadow-lg mt-4" style="width:100%" id='prog'>
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
                            <button type="submit" class="btn btn-outline-success">Editar</button>
                        </form>
                    </td>
                    <td>
                       @if(request()->has('view_deleted'))
                       <a href="{{route('programa.restore', $programa->idPrograma)}}" class='btn btn-primary text-dark'>Restablecer</a>
                       @else    
                        <form action="{{ route('programa.destroy', $programa->idPrograma) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Eliminar</button>
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