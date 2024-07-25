@extends('dashboard')
@section('dashboard_content')
<div class="card">
    <h5 class="card-title text-center">Editar Comite</h5>
    <br>
    <div class='card-body'>
        <p class="card-text">
        <form action="{{route('programa.update', [$programas->idPrograma, $idSede])}}" method="post">
        @csrf
        <div><label for="">Programa</label>
            <input type="text" name='programa' class='form-control' value="{{$programas->programa}}" required>
        </div>
        <div>
            <label for="">Siglas</label>
            <input type="text" name='siglas' class='form-control' value="{{$programas->siglas}}" required>
        </div>
        <div>
            <label for="email">E-mail</label>
            <input type="email" name='email' class='form-control' value="{{$programas->email}}" required>
        </div>
        <br>
        <button Class="btn" style="background:#003E65; color:#fff">Agregar</button>
        </form>
        </p>

    </div>
</div>
@stop
