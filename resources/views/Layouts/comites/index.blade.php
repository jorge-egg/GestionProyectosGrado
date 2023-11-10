@extends('dashboard')
@section('estilos_adicionales')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel='stylesheet'>
@endsection
@section('dashboard_content')

<h1>Comites</h1>
    <br>
    <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de comite</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" required>
            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn" style="background:#003E65; color:#fff">Agregar</button>
    </form>
    @if(session()->has('success'))
<div class= 'alert alert-success'>
{{session()->get('success')}}
</div>
@endif
<div class='col col-md-6 text-right'>
<a href="{{route('comite.index',['view_deleted'=>'DeletedRecords'])}}"class='btn btn-warning'>Consultar comites eliminados</a>
</div>
<table class="table table-hover shadow-lg mt-4" style="width:100%" id='comite'>
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($comites as $comite)
                <tr>
                    <td>{{ $comite->nombre }}</td>
                    <td>
                        <form action="{{ route('comite.edit', $comite->idComite) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-warning">Editar</button>
                        </form>
                    </td>
                    <td>
                       @if(request()->has('view_deleted'))
                       <a href="{{route('comite.restore', $comite->idComite)}}" class="btn" style="background:#003E65; color:#fff">Restablecer</a>
                       @else
                        <form action="{{ route('comite.destroy', $comite->idComite) }}" method="post">
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
    let table = new DataTable('#comite');
</script>
@stop
