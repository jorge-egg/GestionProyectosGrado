@extends('dashboard')

@section('estilos_adicionales')
    <link rel="stylesheet" href="{{ asset('css/anteproyecto.css') }}">
@endsection

@section('dashboard_content')
    <br>
    <div style="display: flex; flex-direction:row; justify-content: space-around;">

        {{-- <p class="fs-4">Estado: {{ $propuestaAnterior->estado }}</p> --}}
        {{-- <p class="fs-5">Fecha de habilitación: {{ $rangoFecha[0] }} a {{ $rangoFecha[1] }}</p> --}}
        {{-- @if ($estadoButton)
                <button type="submit" class="btn btn-outline-dark" formaction="{{ route('anteproyecto.createAnterior') }}"><i
                        class="bi bi-arrow-bar-left"></i>Anteproyecto anterior</button>
            @elseif (!$estadoButton)
                <button type="submit" class="btn btn-outline-dark"
                    formaction="{{ route('anteproyecto.create', $idProyecto) }}">Anteproyecto superior<i
                        class="bi bi-arrow-bar-left"></i></button>
            @endif --}}
    </div><br>
    <div class="modal fade" tabindex="-1" id="buscarDocente" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        @component('components.Modales.buscarDocente', [
            'docentes' => $docentes,
            'idProyecto' => $idProyecto,
        ])
        @endcomponent
    </div>
    <div class="card">
        <h5 class="card-title text-center">Docente tutor</h5>
        <div class='card-body'>
            <p class="card-text">
                {{ $valExistDocent ? 'El docente asignado para el proyecto es: ' . $docenteAsig : 'Nota: para poder habilitar la fase del anteproyecto, debe tener un docente asignado.' }}
            </p>
            @can('anteproyecto.asigDocent')
                <button type="button" data-bs-toggle="modal" data-bs-target="#buscarDocente" class="btn"
                    style="background:#003E65; color:#fff; width: 100%; display: {{ $valExistDocent ? 'none' : 'flex' }};">Seleccionar
                    docente</button>
            @endcan

        </div>
    </div><br>

    <div class="card" style="display: {{ $valExistDocent ? 'flex' : 'none' }};">
        <h5 class="card-title text-center">Crear anteproyecto</h5>
        <div class='card-body'>
            <p class="card-text">

                {{-- @if ($propuestaAnterior->estado == 'Aprobado')
                        <span style="color: red;">Esta fase del proyecto ha sido completada, pase a la siguiente
                            fase.</span>
                    @elseif ($propuestaAnterior->estado == 'Aplazado con modificaciones')
                        <span style="color: red;">Tiene 10 días hábiles para enviar la corrección, después de eso no tendrá
                            más oportunidades.</span>
                    @elseif ($propuestaAnterior->estado == 'Rechazado')
                        <span style="color: red;">Su proyecto finalizó. Para poder enviar otra propuesta, deberá crear otro
                            proyecto.</span>
                    @endif --}}



            <div>
                <div class="mb-3">
                    <form action="{{ route('anteproyecto.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $idProyecto }}" name='idProyecto'>
                        {{-- <input type="hidden" value="{{ $propuestaAnterior->idPropuesta }}" name='idPropuesta'> --}}
                        <label for="formFile" class="form-label">Documento de anteproyecto</label>

                        @if ($docExist == null)
                            @can('anteproyecto.calificar')
                                <p style="color: red">El documento no ha sido cargado.</p>
                            @endcan
                            @can('propuesta.agregar')
                                <input class="form-control input-file @error('docAnteProy') is-invalid @enderror" type="file"
                                    id="formFile" name="docAnteProy">
                                @error('docAnteProy')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <button type="submit" id="buttonToCreatePropuesta" class="btn"
                                    style="background:#003E65; color:#fff">Agregar</button>
                            @endcan
                        @elseif ($docExist != null)
                            <a href="{{ route('anteproyecto.verpdf', ['nombreArchivo' => $docExist]) }}" target="_blank"
                                class="btn btn-warning"><i class="bi bi-file-earmark-pdf-fill">{{ ' ' . $docExist }}</i></a>
                            @can('anteproyecto.aprobarDocumento')
                            <p><b>Nota: </b>Si prefieres no aprobar el documento, por favor, actualiza el estado desactivando el interruptor. De lo contrario, actívalo y envía la actualización.</p>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="switchAprobDoc">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Aprobación del docente</label>
                            </div>
                            <button class="btn"
                                    style="background:#003E65; color:#fff; margin-bottom: 10px" formaction="{{ route('anteproyecto.aprobDoc') }}">Enviar actualizacion de estado de aprobacion del documento</button>
                            @endcan

                            @php
                                $aprobDocent = $anteproyecto == null ? false : $anteproyecto->aprobacionDocen;
                            @endphp
                            @if ($aprobDocent)
                                <button class="btn"
                                    style="background:#003E65; color:#fff; margin-bottom: 10px">Calificación</button>
                            @else
                                <p style="color: red;">No se podra calificar el anteproyecto hasta que el docente apruebe el
                                    documento
                                </p>
                            @endif
                            @can('anteproyecto.calificar')
                                <button type="button" id="calificar" class="btn" style="background:#003E65; color:#fff"
                                    onclick="mostrarCamposCalificacion()">Calificar</button>
                            @endcan
                        @endif
                    </form>
                </div>

                <section style="display: none">
                    <form action="{{ route('anteproyecto.store') }}" method='POST'>
                        @csrf
                        <h5>Titulo</h5>
                        @component('components.calificacionObser', [
                            'nameSelect' => 'tituloCalificacion',
                            'nameTextArea' => 'tituloObservacion',
                            'obsArray' => 'h', //$observaciones[0],
                        ])
                        @endcomponent
                        <h5>Introducción</h5>
                        @component('components.calificacionObser', [
                            'nameSelect' => 'introCalificacion',
                            'nameTextArea' => 'introObservacion',
                            'obsArray' => 'h', //$observaciones[0],
                        ])
                        @endcomponent
                        <h5>Planteamiento del problema</h5>
                        @component('components.calificacionObser', [
                            'nameSelect' => 'planProbCalificacion',
                            'nameTextArea' => 'planProbObservacion',
                            'obsArray' => 'h', //$observaciones[0],
                        ])
                        @endcomponent
                        <h5>Justificación</h5>
                        @component('components.calificacionObser', [
                            'nameSelect' => 'justCalificacion',
                            'nameTextArea' => 'justObservacion',
                            'obsArray' => 'h', //$observaciones[0],
                        ])
                        @endcomponent
                        <h5>Marco referencial</h5>
                        @component('components.calificacionObser', [
                            'nameSelect' => 'marcRefCalificacion',
                            'nameTextArea' => 'marcRefObservacion',
                            'obsArray' => 'h', //$observaciones[0],
                        ])
                        @endcomponent
                        <h5>Metodologia</h5>
                        @component('components.calificacionObser', [
                            'nameSelect' => 'metodCalificacion',
                            'nameTextArea' => 'metodObservacion',
                            'obsArray' => 'h', //$observaciones[0],
                        ])
                        @endcomponent
                        <h5>Elementos de administración y control</h5>
                        @component('components.calificacionObser', [
                            'nameSelect' => 'admCtrCalificacion',
                            'nameTextArea' => 'admCtrObservacion',
                            'obsArray' => 'h', //$observaciones[0],
                        ])
                        @endcomponent
                        <h5>Normas de presentación en el documento y Referencias bibliográficas</h5>
                        @component('components.calificacionObser', [
                            'nameSelect' => 'normBibliCalificacion',
                            'nameTextArea' => 'normBibliObservacion',
                            'obsArray' => 'h', //$observaciones[0],
                        ])
                        @endcomponent
                        <br>
                        <div class="mb-3">
                            <button id="buttonEnviarCalificacion" formaction="{{ route('observaciones.store') }}"
                                class="btn" style="background:#003E65; color:#fff; display:none">Enviar
                                calificación</button>

                            </p>
                        </div>
                    </form>
                </section>
            </div>


        @section('js')
            <script></script>
        @endsection
    @stop
