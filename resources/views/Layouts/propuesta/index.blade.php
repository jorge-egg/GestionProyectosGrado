@extends('dashboard')
@section('estilos_adicionales')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel='stylesheet'>
@endsection
@section('dashboard_content')

<h1>propuestas</h1>
<br>
@if(session()->has('success'))
<div class= 'alert alert-success'>
{{session()->get('success')}}
</div>
@endif
<div class='col col-md-6 text-right'>
<a href="{{route('usuarios.index',['view_deleted'=>'DeletedRecords'])}}"class='btn btn-outline-warning'>Consultar usuarios eliminados</a>
</div>
<table class="table table-hover shadow-lg mt-4" style="width:100%" id='usuario'>
    <thead>
        <tr>
            <th scope="col">titulo</th>
            <th scope="col">linea_invs</th>
            <th scope="col">desc_problema</th>
            <th scope="col">obj_general</th>
            <th scope="col">obj_especificos</th>
            <th scope="col">estado</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
                @foreach ($propuestas as $propuesta)
                <tr>
                    <th>{{ $propuesta->titulo }}</th>
                    <td>{{ $propuesta->linea_invs }}</td>
                    <td>{{ $propuesta->desc_problema }}</td>
                    <td>{{ $propuesta->obj_general }}</td>
                    <td>{{ $propuesta->estado}}</td>
                    <td>
                        <form action="{{ route('usuarios.edit', $usuario->numeroDocumento) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-warning">Editar</button>
                        </form>
                    </td>

                    <td>
                       @if(request()->has('view_deleted'))
                       <a href="{{route('usuarios.restore', $usuario->numeroDocumento)}}" class='btn btn-outline-success'>Restablecer</a>
                       @else
                        <form action="{{ route('usuarios.destroy', $usuario->numeroDocumento) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-warning">Eliminar</button>
                        </form>
                        @endif
                    </td>
                @endforeach
    </tbody>
</table>
@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
@endsection
<script>
    let table = new DataTable('#usuario');
</script>
@stop
