@extends('dashboard')
@section('dashboard_content')
<div class="card">
    <h5 class="card-title text-center">Crear propuesta</h5>
    <br>
    <div class='card-body'>
        <p class="card-text">
        <form action="{{route('propuesta.store')}}" method='POST'>
        @csrf
        <div><label for="">titulo</label>
            <input type="text" name='Titulo' class='form-control' required>
            </div>
            <div><label for="">Linea de investigacion</label>
            <input type="text" name='linea_invs' class='form-control' required>
            </div>
            <br>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="desc_problema" required></textarea>
                <label for="">Descripción del problema</label>
            </div>
            <br>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="obj_general" required></textarea>
                <label for="">Objetivo general</label>
            </div>
            <br>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="obj_especificos" required></textarea>
                <label for="">Objetivos específicos</label>
            </div>
            <br>
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
            <button Class='btn btn-primary text-dark'>Agregar</button>
        </form>
        </p>

    </div>
</div>
@stop