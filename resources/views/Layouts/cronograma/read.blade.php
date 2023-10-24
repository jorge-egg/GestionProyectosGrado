@extends('dashboard')

@section('estilos_adicionales')
    <link rel="stylesheet" href="{{ asset('css/coloresBtnCampos.css') }}">
@stop

@section('dashboard_content')

<div class="cronograma">
    <div class="titulo">
        <h2>Cronograma</h2>
    </div>
    <div class="contenido">
        <form action="{{route('grupo.create')}}" method="post">
            @csrf
            <input type="hidden" value="">
            <button class="btn btn-primary">Nuevo grupo</button>
        </form>
        <table class="table">
            <thead class="encabezado">
              <tr>
                <th scope="col"></th>
                <th scope="col">Propuesta</th>
                <th scope="col">Anteproyecto</th>
                <th scope="col">Poryecto final</th>
                <th scope="col">Sustentación</th>
                <th></th>
              </tr>
            </thead>
            <tbody class="columnas">
              <tr class="columna">
                <th>Grupo 1</th>
                @foreach ($grupo1 as $fecha)
                    <td>{{$fecha->fecha_apertura}}
                    <br>
                    {{$fecha->fecha_cierre}}</td>
                @endforeach
              </tr>
              <tr>
                <th>Grupo 2</th>
                @foreach ($grupo2 as $fecha)
                    <td>{{$fecha->fecha_apertura}}
                    <br>
                    {{$fecha->fecha_cierre}}</td>
                @endforeach
              </tr>
              <tr>
                <th>Grupo 3</th>
                @foreach ($grupo3 as $fecha)
                    <td>{{$fecha->fecha_apertura}}
                    <br>
                    {{$fecha->fecha_cierre}}</td>
                @endforeach
              </tr>
              <tr>
                <th>Grupo 4</th>
                @foreach ($grupo4 as $fecha)
                    <td>{{$fecha->fecha_apertura}}
                    <br>
                    {{$fecha->fecha_cierre}}</td>
                @endforeach
              </tr>
            </tbody>
          </table>
    </div>
</div>

@stop
