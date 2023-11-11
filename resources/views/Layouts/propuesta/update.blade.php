@extends('dashboard')
@section('dashboard_content')
<div class="card">
    <h5 class="card-title text-center">Crear propuesta</h5>
    <br>
    <div class='card-body'>
        <p class="card-text">
        <form action="#">
            @csrf
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="titulo"></textarea>
                <label for="titulo">Titulo</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="linea_invs"></textarea>
                <label for="linea_invs">Linea de investigacion</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="desc_problema"></textarea>
                <label for="desc_problema">Descripción del problema</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="obj_general"></textarea>
                <label for="obj_general">Objetivo general</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="obj_especificos"></textarea>
                <label for="obj_especificos">Objetivo específicos</label>
            </div>
            <br>
            <button Class="btn" style="background:#003E65; color:#fff">Agregar</button>
        </form>
        </p>

    </div>
</div>
@stop
