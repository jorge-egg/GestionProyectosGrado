@extends('dashboard')

@section('dashboard_content')

{!! Form::model($user, ['route' => ['usuarios.update', $user->numeroDocumento], 'method' => 'post']) !!}

<div class="mb-3">
    <label for="numeroDocumento" class="form-label">Documento</label>
    <input type="text" class="form-control" id="numeroDocumento" name="numeroDocumento" value="{{$user->numeroDocumento}}">
</div>
<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" value="{{$user->nombre}}">
</div>
<div class="mb-3">
    <label for="apellido" class="form-label">Apellido</label>
    <input type="text" class="form-control" id="apellido" name="apellido" value="{{$user->apellido}}">
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
</div>
<div class="mb-3">
    <label for="numeroCelular" class="form-label">Telefono</label>
    <input type="text" class="form-control" id="numeroCelular" name="numeroCelular" value="{{$user->numeroCelular}}">
</div>
<div class="d-none">
    <label for="usua_sede" class="form-label">usua_sede</label>
    <input type="text" class="form-control" id="usua_sede" name="usua_sede" value="{{$user->usua_sede}}" readonly>
</div>
<div class="d-none">
    <label for="usua_users" class="form-label">usua_users</label>
    <input type="text" class="form-control" id="usua_users" name="usua_users" value="{{$user->usua_users}}" readonly>
</div>

    <h2 class="h5">Listado de roles</h2>
    @foreach ($roles as $role)
        <div>
            <label>
                {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
            </label>
            {{$role -> name}}
        </div>
    @endforeach

    {!! Form::submit('Actualizar', ['class' => 'btn btn-primary text-dark']) !!}
{!! Form::close() !!}
@stop

