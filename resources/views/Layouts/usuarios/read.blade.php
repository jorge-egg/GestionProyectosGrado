@extends('dashboard')

@section('dashboard_content')

<h1>usuarios</h1>
<br> 
@if(session()->has('success'))
<div class= 'alert alert-success'>
{{session()->get('success')}}
</div>
@endif
<div class='col col-md-6 text-right'>
<a href="{{route('usuarios.index',['view_deleted'=>'DeletedRecords'])}}"class='btn btn-outline-warning'>Consultar usuarios eliminados</a>
</div>
<table class="table table-hover" style="width:100%" id='usuario'> 
    <thead> 
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
                                    <button type="submit" class="btn btn-outline-success"><i class='bx
                                    bxs-user-x'></i>Deshabilitar</button> @else <button type="submit"
                                    class="btn btn-danger"><i class='bx bxs-user-check'>habilitar</i></button>
                                @endif
                            </form> 
                        </td>
                  
                    <td>
                        <form action="{{ route('usuarios.edit', $usuario->numeroDocumento) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-success">Editar</button>
                        </form>
                    </td>
                                      
                    <td>
                       @if(request()->has('view_deleted'))
                       <a href="{{route('usuarios.restore', $usuario->numeroDocumento)}}" class='btn btn-outline-success'>Restablecer</a>
                       @else    
                        <form action="{{ route('usuarios.destroy', $usuario->numeroDocumento) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                        </form>
                        @endif
                    </td>
                @endforeach
    </tbody>
</table>
<script>
    let table = new DataTable('#usuario');
</script>

@stop