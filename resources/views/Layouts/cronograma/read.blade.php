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
        <table class="table">
            <thead class="encabezado">
              <tr>
                <th scope="col"></th>
                <th scope="col">Grupo 1</th>
                <th scope="col">Grupo 2</th>
                <th scope="col">Grupo 3</th>
                <th scope="col">Grupo 4</th>
              </tr>
            </thead>
            <tbody class="columnas">
              <tr class="columna">
                <th>Propuesta</th>
                <td class="campo-deshabilitado">
                  fecha abierto: 10/23/23
                  <br>
                  fecha cierre: 10/23/23
                </td>
                <td class="campo-deshabilitado">
                  fecha abierto: 10/23/23
                  <br>
                  fecha cierre: 10/23/23
                </td>
                <td class="campo-deshabilitado">
                  fecha abierto: 10/23/23
                  <br>
                  fecha cierre: 10/23/23
                </td>
                <td class="campo-habilitado">
                  fecha abierto: 10/23/23
                  <br>
                  fecha cierre: 10/23/23
                </td>
              </tr>
              <tr>
                <th>Anteproyecto</th>
                <td class="campo-deshabilitado">
                  fecha abierto: 10/23/23
                  <br>
                  fecha cierre: 10/23/23
                </td>
                <td class="campo-deshabilitado">
                  fecha abierto: 10/23/23
                  <br>
                  fecha cierre: 10/23/23
                </td>
                <td class="campo-habilitado">
                  fecha abierto: 10/23/23
                  <br>
                  fecha cierre: 10/23/23
                </td>
                <td>
                  fecha abierto: 10/23/23
                  <br>
                  fecha cierre: 10/23/23
                </td>
              </tr>
              <tr>
                <th>Proyecto</th>
                <td class="campo-deshabilitado"></td>
                <td class="campo-habilitado">
                    fecha abierto: 10/23/23
                    <br>
                    fecha cierre: 10/23/23
                  </td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th>Sustentacion</th>
                <td class="campo-habilitado">
                    fecha abierto: 10/23/23
                    <br>
                    fecha cierre: 10/23/23
                  </td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
    </div>
</div>

@stop
