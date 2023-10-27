@extends('dashboard')

@section('estilos_adicionales')
    <link rel="stylesheet" href="{{ asset('css/coloresBtnCampos.css') }}">


@stop

@section('dashboard_content')
<div class="card">
  <h5 class="card-header">EDITAR CRONOGRAMA</h5>
  <div class="card-body">
    <p class="card-text">
        <form action="#">
        <div><label for="">Fecha de apertura</label>
            <input type="date" name='fecha_cierre' class='form-control' required>
            </div>
            <br>
            <div><label for="">Fecha de cierre</label>
            <input type="date" name='fecha_cierre' class='form-control' required>
            </div>
            <br>
            <button Class='btn btn-outline-info'>editar</button>
        </form>
    </p>
  </div>
</div>


@stop
