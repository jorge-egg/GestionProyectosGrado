@extends('dashboard')

@section('dashboard_content')

<h1>usuarios</h1>
<br>
<div class='col-xl-12'>
    <form action="{{route('usuarios.index')}}" method="get">
        <div class='form-row'>
            <div class='col-sm-4 my-1'>
                <input type='text' class='form-control' name='texto' value='{{$texto}}'>
            </div>
            <div class='col-auto my-1'> <input type='submit' class='btn btn-outline-info' value='buscar'> </div>
        </div>
    </form>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Documento</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Email</th>
            <th scope="col">Telefono</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @if(count($usuarios)<=0)
            <tr>
                <td colspan='6'>No hay resultados</td>
            </tr>
        @else

                @foreach ($usuarios as $usuario)
                <tr>
                    <th>{{ $usuario->numeroDocumento }}</th>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->apellido }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->numeroCelular}}</td>
                    @foreach ($users as $user)
                        <td>
                            <form action="{{ route('usuarios.cambioEstado', $usuario->numeroDocumento) }}" method="post">
                                @csrf
                                @if ($user -> estado == 1)
                                    <button type="submit" class="btn btn-outline-success"><i class='bx
                                    bxs-user-x'></i>Deshabilitar</button> @else <button type="submit"
                                    class="btn btn-danger"><i class='bx bxs-user-check'>habilitar</i></button>
                                @endif
                            </form>
                        </td>
                    @endforeach
                    <td>
                        <form action="{{ route('usuarios.edit', $usuario->numeroDocumento) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-success">Editar</button>
                        </form>
                    </td>
                
                @endforeach

        @endif
    </tbody>
</table>
{{$usuarios->links()}}
@stop
