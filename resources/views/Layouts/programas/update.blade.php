@extends('dashboard')
@section('dashboard_content')
<div class="card">
    <h5 class="card-title text-center">Editar Comite</h5>
    <br>
    <div class='card-body'>
        <p class="card-text">
        <form action="#">
        @csrf
        <div><label for="">programa</label>
            <input type="text" name='programa' class='form-control' required>
            </div>
            <div><label for="">siglas</label>
            <input type="text" name='siglas' class='form-control' required>
            </div>
            <br>
            <button Class='btn btn-primary text-dark'>Agregar</button>
        </form>
        </p>

    </div>
</div>
@stop