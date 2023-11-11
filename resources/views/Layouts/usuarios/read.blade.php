
@extends('dashboard')

@section('estilos_adicionales')
<link rel="stylesheet" href="{{ asset('css/coloresBtnCampos.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel='stylesheet'>
@endsection
@section('dashboard_content')
<h1>usuarios</h1>
<br>
@if(session()->has('success'))
<div class= 'alert alert-success'>
{{session()->get('success')}}
</div>
@endif
<div class='col col-md-6 text-right'>
<a href="{{route('usuarios.index',['view_deleted'=>'DeletedRecords'])}}"class='btn btn-warning'>Consultar usuarios eliminados</a>
</div>
<table class="table table-hover shadow-lg mt-4" style="width:100%" id='usuario'>
    <thead class='bg-table'>
        <tr>
            <th scope="col">Documento</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Email</th>
            <th scope="col">Telefono</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <th>{{ $usuario->numeroDocumento }}</th>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->apellido }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->numeroCelular}}</td>

                        <td>
                            <form action="{{ route('usuarios.cambioEstado', $usuario->numeroDocumento) }}" method="post">
                                @csrf

                                @if ($usuario -> estado == 1)
                                    <button type="submit" class="btn btn-primary text-dark"><i class='bx
                                    bxs-user-x'></i>Deshabilitar</button> @else <button type="submit"
                                    class="btn" style="background:#003E65; color:#fff"><i class="btn " style="background:#003E65; color:#fff">habilitar</i></button>
                                @endif
                            </form>
                        </td>

                    <td>
                        <form action="{{ route('usuarios.edit', $usuario->numeroDocumento) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-warning" >Editar</button>
                        </form>
                    </td>

                    <td>
                       @if(request()->has('view_deleted'))
                       <a href="{{route('usuarios.restore', $usuario->numeroDocumento)}}" class="btn " style="background:#003E65; color:#fff">Restablecer</a>
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

