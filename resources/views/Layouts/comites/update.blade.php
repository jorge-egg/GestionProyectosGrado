@extends('dashboard')
@section('dashboard_content')
<div class="card">
    <h5 class="card-title text-center">Editar Comité</h5>
    <br>
    <div class='card-body'>
        <p class="card-text">
        <form action="#">
        @csrf
        <div><label for="">Nombre</label>
            <input type="text" name='Titulo' class='form-control' required>
            </div>
            <br>
            <button Class="btn" style="background:#003E65; color:#fff">Agregar</button>
        </form>
        </p>

    </div>
</div>
@stop
