@extends('dashboard')
@section('dashboard_content')
<div class="card">
    <h5 class="card-title text-center">Crear propuesta</h5>
    <br>
    <div class='card-body'>
        <p class="card-text">
        <form action="{{route('propuesta.store')}}" method='POST'>
        @csrf
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="titulo" required></textarea>
                <label for="">Titulo</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="linea_invs" required></textarea>
                <label for="">Linea de investigacion</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="desc_problema" required></textarea>
                <label for="">Descripción del problema</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="obj_general" required></textarea>
                <label for="">Objetivo general</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="obj_especificos" required></textarea>
                <label for="">Objetivos específicos</label>
            </div>
            <div><label for="">Fecha de subida</label>
            <input type="date" name='frecha_subida' class='form-control' required>
            </div>
            <div><label for="">Fecha de actualizacion</label>
            <input type="date" name='frecha_actu' class='form-control' required>
            </div>
            <div><label for="">estado</label>
            <input type="text" name='estado' class='form-control' required>
            </div>
            <div><label for="">Fecha de cierre</label>
            <input type="date" name='fecha_cierre' class='form-control' required>
            </div>
            <div><label for="">prop_fase</label>
            <input type="text" name='prop_fase' class='form-control' required>
            </div>
            <br>
            <button Class='btn btn-outline-info'>Agregar</button>
        </form>
        </p>

    </div>
</div>
@stop