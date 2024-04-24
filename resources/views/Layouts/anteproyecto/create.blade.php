@extends('dashboard')

@section('estilos_adicionales')
    <link rel="stylesheet" href="{{ asset('css/anteproyecto.css') }}">
    <script src="{{ asset('js/anteproyecto.js') }}"></script>
@endsection

@section('dashboard_content')
    {{ $valRolComite = false }}
    {{ $valCalif = false }}
    <br>
    <div style="display: flex; flex-direction:row; justify-content: space-around;">
        <p class="fs-4">Estado: {{ $array['anteproyecto']->estado }}</p>
        <p class="fs-5">Fecha de habilitación: {{ $array['rangoFecha'][0] }} a {{ $array['rangoFecha'][1] }}</p>
        {{-- @if ($estadoButton)
                <button type="submit" class="btn btn-outline-dark" formaction="{{ route('anteproyecto.createAnterior') }}"><i
                        class="bi bi-arrow-bar-left"></i>Anteproyecto anterior</button>
            @elseif (!$estadoButton)
                <button type="submit" class="btn btn-outline-dark"
                    formaction="{{ route('anteproyecto.create', $idProyecto) }}">Anteproyecto superior<i
                        class="bi bi-arrow-bar-left"></i></button>
            @endif --}}

    </div><br>
    <div class="card" style="display: flex">
        {{-- <div class="card" style="display: {{ $array['valExistDocent'] ? 'flex' : 'none' }};"> --}}
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
                        <input type="hidden" value="{{ $array['idProyecto'] }}" name='idProyecto'>
                        <input type="hidden" value="{{ $array['anteproyecto']->idAnteproyecto }}" name='idFase'>
                        <div>
                            @foreach ($array['integrantes'] as $key => $array['integrantes'])
                                <h1>Integrante {{ $key + 1 }}: {{ $array['integrantes']->usuarios_user->nombre }}
                                    {{ $array['integrantes']->usuarios_user->apellido }}</h1>
                            @endforeach
                        </div>
                        <br>
                        @if (!$array['rangoFecha'][2])
                            <h2 style="color: red">Por favor espere la proxima fecha habilitada para esta fase</h2>
                        @elseif ($array['docExist1'] == null && $array['docExist2'] == null)
                            @can('anteproyecto.calificar')
                                <p style="color: red">El documento no ha sido cargado. </p>
                                <input type="hidden">{{ $valRolComite = true }}</input>
                            @endcan
                            @can('propuesta.agregar')
                                <div class="documentos">
                                    <section class="documentosSec">
                                        <label for="docAnt" class="form-label">Documento de anteproyecto</label>
                                        <input class="form-control input-file @error('docAnteProy') is-invalid @enderror"
                                            type="file" id="docAnt" name="docAnteProy">
                                        @error('docAnteProy')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </section>
                                    <section class="documentosSec">
                                        <label for="docDir" class="form-label">Carta de aprobación Director</label>
                                        <input class="form-control input-file @error('docDir') is-invalid @enderror"
                                            type="file" id="docDir" name="docDir">
                                        @error('docDir')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </section>
                                </div>
                                <button type="submit" id="buttonToCreatePropuesta" class="btn"
                                    style="background:#003E65; color:#fff">Agregar</button>
                            @endcan
                        @elseif ($array['docExist1'] != null && $array['docExist2'] != null)
                            <div class="documentos">
                                <section class="documentosSec" style="text-align: center">

                                    <!-- documento del anteproyecto -->
                                    <a href="{{ route('anteproyecto.verpdf', ['nombreArchivo' => $array['docExist1'], 'ruta' => '1']) }}"
                                        target="_blank" class="btn btn-warning"><i
                                            class="bi bi-file-earmark-pdf-fill">{{ ' ' . $array['docExist1'] }} -- documento de anteproyecto</i></a>
                                </section>
                                <section class="documentosSec" style="text-align: center">
                                    <!-- carta del director -->
                                    <a href="{{ route('anteproyecto.verpdf', ['nombreArchivo' => $array['docExist2'], 'ruta' => '2']) }}"
                                        target="_blank" class="btn btn-warning"><i
                                            class="bi bi-file-earmark-pdf-fill">{{ ' ' . $array['docExist2'] }} -- carta del director</i></a>
                                </section>
                            </div>

                            @can('anteproyecto.aprobarDocumento')
                                <p style="display: none">{{ $valCalif = true }}</p>
                                @if ($array['valDocAsig'])
                                    <p><b>Nota: </b>Estimado profesor para nombrar jurados al proyecto, usted debe dar su
                                        aprobación al documento.</p>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                            name="switchAprobDoc">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Aprobación del
                                            docente</label>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">Observaciones</span>
                                        <textarea class="form-control" aria-label="With textarea" name="ObsDocent" required
                                            {{ $array['anteproyecto']->observaDocent == '' ? '' : 'disabled' }}>{{ $array['anteproyecto']->observaDocent }}</textarea>
                                    </div><br>
                                    <button class="btn" style="background:#003E65; color:#fff; margin-bottom: 10px"
                                        formaction="{{ route('anteproyecto.aprobDoc') }}">Enviar actualizacion de estado de
                                        aprobacion del documento</button>
                                @endif
                            @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <h5 class="card-title text-center">Jurados</h5>
        <div class='card-body'>
            <div class="modal fade" tabindex="-1" id="buscarDocente" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                @component('components.Modales.buscarDocente', [
                    'docentes' => $miembrosDocente['docentes'],
                    'idProyecto' => $miembrosDocente['idProyecto'],
                    'fase' => 'anteproyecto',
                ])
                @endcomponent
            </div>
            @php
                $habilitarButtonJ =
                    $array['anteproyecto']->juradoUno != '-1' && $array['anteproyecto']->juradoDos != '-1'
                        ? 'disabled'
                        : '';
            @endphp
            <button type="button" data-bs-toggle="modal" data-bs-target="#buscarDocente" class="btn"
                style="background:#003E65; color:#fff; width: 100%;" {{ $habilitarButtonJ }}>Seleccionar
                jurados</button>
        </div>
    </div>
    <br>
    <div class="card" style="display: flex">
        <h5 class="card-title text-center">Calificar anteproyecto</h5>
        <div class='card-body'>
            <p class="card-text">
                @php
                    $aprobDocent = $array['anteproyecto'] == null ? false : $array['anteproyecto']->aprobacionDocen;

                @endphp

                @if ($aprobDocent == '2')
                    <section id="cont-calf">
                        <form action="{{ route('anteproyecto.store') }}" method='POST'>
                            @csrf
                            <h5>Titulo</h5>
                            @component('components.calificacionObser', [
                                'nameSelect' => 'tituloCalificacion',
                                'nameTextArea' => 'tituloObservacion',
                                'obsArray' => $array['observaciones'][0],
                                'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
                                'styleDisplayGeneral' => $valCalif ? 'flex' : 'none',
                            ])
                            @endcomponent
                            <h5>Introducción</h5>
                            @component('components.calificacionObser', [
                                'nameSelect' => 'introCalificacion',
                                'nameTextArea' => 'introObservacion',
                                'obsArray' => $array['observaciones'][1],
                                'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
                                'styleDisplayGeneral' => 'flex',
                            ])
                            @endcomponent
                            <h5>Planteamiento del problema</h5>
                            @component('components.calificacionObser', [
                                'nameSelect' => 'planProbCalificacion',
                                'nameTextArea' => 'planProbObservacion',
                                'obsArray' => $array['observaciones'][2],
                                'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
                                'styleDisplayGeneral' => 'flex',
                            ])
                            @endcomponent
                            <h5>Justificación</h5>
                            @component('components.calificacionObser', [
                                'nameSelect' => 'justCalificacion',
                                'nameTextArea' => 'justObservacion',
                                'obsArray' => $array['observaciones'][3],
                                'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
                                'styleDisplayGeneral' => 'flex',
                            ])
                            @endcomponent
                            <h5>Marco referencial</h5>
                            @component('components.calificacionObser', [
                                'nameSelect' => 'marcRefCalificacion',
                                'nameTextArea' => 'marcRefObservacion',
                                'obsArray' => $array['observaciones'][4],
                                'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
                                'styleDisplayGeneral' => 'flex',
                            ])
                            @endcomponent
                            <h5>Metodologia</h5>
                            @component('components.calificacionObser', [
                                'nameSelect' => 'metodCalificacion',
                                'nameTextArea' => 'metodObservacion',
                                'obsArray' => $array['observaciones'][5],
                                'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
                                'styleDisplayGeneral' => 'flex',
                            ])
                            @endcomponent
                            <h5>Elementos de administración y control</h5>
                            @component('components.calificacionObser', [
                                'nameSelect' => 'admCtrCalificacion',
                                'nameTextArea' => 'admCtrObservacion',
                                'obsArray' => $array['observaciones'][6],
                                'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
                                'styleDisplayGeneral' => 'flex',
                            ])
                            @endcomponent
                            <h5>Normas de presentación en el documento y Referencias bibliográficas</h5>
                            @component('components.calificacionObser', [
                                'nameSelect' => 'normBibliCalificacion',
                                'nameTextArea' => 'normBibliObservacion',
                                'obsArray' => $array['observaciones'][7],
                                'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
                                'styleDisplayGeneral' => 'flex',
                            ])
                            @endcomponent
                            <br>
                            <div class="mb-3">
                                <button id="buttonEnviarCalificacion"
                                    formaction="{{ route('observaciones.store', 'anteproyecto') }}" class="btn"
                                    style="background:#003E65; color:#fff">Enviar
                                    calificación</button>

            </p>
        </div>
        </form>
        </section>
    @else
        <p style="color: red;">
            {{ $array['anteproyecto']->aprobacionDocen == '1'
                ? 'El director no aprobo el documento'
                : ($array['anteproyecto']->aprobacionDocen == '-1'
                    ? 'No se podra calificar el anteproyecto hasta que el director apruebe el
                                                                                                documento'
                    : '') }}
        </p>
        @endif

        @endif
        </form>
    </div>


    </div>


@section('js')

@endsection
@stop
