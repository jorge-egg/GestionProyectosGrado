@extends('dashboard')
@section('dashboard_content')
<div class="card">
    <h5 class="card-title text-center">Editar Comite</h5>
    <br>
    <div class='card-body'>
        <p class="card-text">
        <form action="{{route('programa.update', $programas->idPrograma)}}" method="post">
        @csrf
        <div><label for="">programa</label>
            <input type="text" name='programa' class='form-control' value="{{$programas->programa}}" required>
            </div>
            <div><label for="">siglas</label>
            <input type="text" name='siglas' class='form-control' value="{{$programas->programa}}" required>
            </div>
            <br>
            <button Class="btn" style="background:#003E65; color:#fff">Agregar</button>
        </form>
        </p>

    </div>
</div>
@stop
