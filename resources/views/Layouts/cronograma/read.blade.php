@extends('dashboard')

@section('estilos_adicionales')
    <link rel="stylesheet" href="{{ asset('css/coloresBtnCampos.css') }}">
@stop

@section('dashboard_content')
    <div class="titulo">
        <h2>Cronograma</h2>
    </div>
    <div>
        <form action="{{ route('grupo.create') }}" method="get">
            <button class="btn " style="background:#003E65; color:#fff">Nuevo grupo</button>
        </form>
        <table class="table">
            <thead class="encabezado">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Propuesta</th>
                    <th scope="col">Anteproyecto</th>
                    <th scope="col">Proyecto final</th>
                    <th scope="col">Sustentación</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="columnas">

                @foreach ($array as $key => $grupos)
                    <tr class="columna">
                        <td>{{ $key }}</td>
                        @foreach ($grupos as $grupo)
                            @php
                                $fecha_apertura = Carbon\Carbon::parse($grupo->fecha_apertura)->format('Y-m-d');
                                $fecha_cierre = Carbon\Carbon::parse($grupo->fecha_cierre)->format('Y-m-d');
                                $fechaActual = Carbon\Carbon::now()->format('Y-m-d');
                                $activo = false;
                                if ($fechaActual >= $fecha_apertura && $fechaActual <= $fecha_cierre) {
                                    $activo = true;
                                } elseif ($fechaActual > $fecha_cierre) {
                                    $activo = false;
                                }
                            @endphp
                            <td class="campoFechas {{ ($activo) ? 'campo-habilitado' : 'campo-deshabilitado' }}">
                                <p class="fechaAbierto">{{ $grupo->fecha_apertura }}</p>
                                <br>
                                <p class="fechaCerrado">{{ $grupo->fecha_cierre }}</p>
                            </td>

                            <form action="{{ route('grupo.edit', $grupo->fech_grup) }}" method="get">
                                <!--se coloco el inicio del from dentro de la etiqueta td para que lograra capturar el id del grupo-->
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
@stop

@section('js_extra')
    <script>
        // $('.campoFechas').each(function() {
        //     var fechaAbierto = new Date($(this).find('.fechaAbierto').text()).toLocaleDateString();
        //     var fechaCerrado = new Date($(this).find('.fechaCerrado').text()).toLocaleDateString();
        //     var fechaActual = new Date().toLocaleDateString();

        //     var fechaAbierto1 = new Date($(this).find('.fechaAbierto').text()).getDay();
        //     var fechaCerrado1 = new Date($(this).find('.fechaCerrado').text()).toLocaleDateString();
        //     var fechaActual1 = new Date().toLocaleDateString();

        //     var campoFechas = $(this);
        //     console.log({
        //         fechaAbierto,
        //         fechaCerrado,
        //         fechaActual,
        //         campoFechas
        //     });
        //     if (fechaActual >= fechaAbierto && fechaActual <= fechaCerrado) {

        //         campoFechas.addClass('campo-habilitado');
        //     } else if (fechaActual > fechaCerrado) {

        //         campoFechas.addClass('campo-deshabilitado');
        //     } else if (fechaActual < fechaAbierto) {

        //         campoFechas.addClass('');
        //     }
        // });
    </script>
@stop
