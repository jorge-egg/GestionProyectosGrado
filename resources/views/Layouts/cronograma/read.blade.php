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
        <form action="{{route('grupo.create')}}" method="get">
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

                @foreach ($array as $key => $grupos)
                <tr class="columna">
                    <td>{{$key}}</td>
                    @foreach ($grupos as $grupo)
                        <td>{{$grupo->fecha_apertura}}
                            <br>
                        {{$grupo->fecha_cierre}}</td>
                        <form action="{{ route('grupo.edit', $grupo->fech_grup)}}" method="get"><!--se coloco el inicio del from dentro de la etiqueta td para que lograra capturar el id del grupo-->


                    @endforeach
                    <td>
                            <button class="btn btn-warning">editar</button>
                        </form>
                    </td>
                </tr>
                @endforeach



            </tbody>
          </table>
    </div>
</div>

@stop
