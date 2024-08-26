@extends('dashboard')

@section('estilos_adicionales')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/anteproyecto.css') }}">
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
                    <div>
                        @foreach ($array['integrantes'] as $key => $array['integrantes'])
                            <h1>Integrante {{ $key + 1 }}: {{ $array['integrantes']->usuarios_user->nombre }}
                                {{ $array['integrantes']->usuarios_user->apellido }}</h1>
                        @endforeach
                    </div>
                    <br>
                    {{-- @dd($array['anteproyectoAnterior']) --}}
                    @if ($array['anteproyectoAnterior']->estado == 'Aplazado con modificaciones')
                        <div class="documentos">
                            <section class="documentosSec" style="text-align: center">

                                <!-- documento del anteproyecto -->
                                <a href="{{ route('anteproyecto.verpdf', ['nombreArchivo' => $array['anteproyectoAnterior']->documento, 'ruta' => '1']) }}"
                                    target="_blank" class="btn btn-warning"><img style="width:20px;heigth:auto;" src="{{asset('imgs/icons/file-earmark-pdf-fill.svg')}}"
                                    />{{ ' ' . $array['anteproyectoAnterior']->documento }}
                                        --
                                        documento de anteproyecto</a>
                            </section>
                            <section class="documentosSec" style="text-align: center">
                                <!-- carta del director -->
                                <a href="{{ route('anteproyecto.verpdf', ['nombreArchivo' => $array['anteproyectoAnterior']->cartaDirector, 'ruta' => '2']) }}"
                                    target="_blank" class="btn btn-warning"><img style="width:20px;heigth:auto;" src="{{asset('imgs/icons/file-earmark-pdf-fill.svg')}}"
                                    />{{ ' ' . $array['anteproyectoAnterior']->cartaDirector }}
                                        -- carta
                                        del director</a>
                            </section>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Observación de los documentos anteriores</span>
                            <textarea class="form-control" aria-label="With textarea" disabled>{{ $array['anteproyectoAnterior']->observaDocent }}</textarea>
                        </div><br>

                    @endif

                    @if (!$array['rangoFecha'][2])
                        <h2 style="color: red">Por favor espere la proxima fecha habilitada para esta fase</h2>
                    @elseif (
                        ($array['docExist1'] == null && $array['docExist2'] == null) ||
                            $array['anteproyecto']->estado == 'Aplazado con modificaciones')
                        <p style="color: red">El documento no ha sido cargado. </p>
                        <form action="{{ route('anteproyecto.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $array['idProyecto'] }}" name='idProyecto'>
                            <input type="hidden" value="{{$array['anteproyecto']->juradoUno}}" name="juradoUnoInp">
                            <input type="hidden" value="{{$array['anteproyecto']->juradoDos}}" name="juradoDosInp">
                            <input type="hidden" value="{{$array['anteproyecto']->estadoJUno}}" name="estadoJUno">
                            <input type="hidden" value="{{$array['anteproyecto']->estadoJDos}}" name="estadoJDos">
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
                        </form>
                    @elseif ($array['docExist1'] != null && $array['docExist2'] != null)
                        <p style="display: none">{{ $valRolComite = true }}</p>
                        <div class="documentos">
                            <section class="documentosSec" style="text-align: center">

                                <!-- documento del anteproyecto -->
                                <a href="{{ route('anteproyecto.verpdf', ['nombreArchivo' => $array['docExist1'], 'ruta' => '1']) }}"
                                    target="_blank" class="btn btn-warning"><img style="width:20px;heigth:auto;" src="{{asset('imgs/icons/file-earmark-pdf-fill.svg')}}"
                                    />{{ ' ' . $array['docExist1'] }} --
                                        documento de anteproyecto</a>
                            </section>
                            <section class="documentosSec" style="text-align: center">
                                <!-- carta del director -->
                                <a href="{{ route('anteproyecto.verpdf', ['nombreArchivo' => $array['docExist2'], 'ruta' => '2']) }}"
                                    target="_blank" class="btn btn-warning"><img style="width:20px;heigth:auto;" src="{{asset('imgs/icons/file-earmark-pdf-fill.svg')}}"
                                    />{{ ' ' . $array['docExist2'] }} -- carta
                                        del director</a>
                            </section>
                            @can('propuesta.agregar')
                                <p style="color: red">Por favor espere a que el director del proyecto autorice los documentos
                                    cargados</p>
                            @endcan
                        </div>
                        @php
                            $aprobDocent =
                                $array['anteproyecto'] == null ? false : $array['anteproyecto']->aprobacionDocen;
                        @endphp


                        <form    method="post">
                            @csrf
                            <input type="hidden" value="{{ $array['idProyecto'] }}" name='idProyecto'>
                            @can('anteproyecto.aprobarDocumento')
                                <p style="display: none">{{ $valCalif = true }}</p>
                                @if ($array['valDocAsig'])
                                    <p style="display: {{ $aprobDocent == '-1' ? 'block' : 'none' }}"><b>Nota: </b>Estimado
                                        profesor, para nombrar jurados al proyecto usted debe dar su
                                        aprobación al documento.</p>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-text">Observaciones</span>
                                        <textarea class="form-control" aria-label="With textarea" name="ObsDocent"
                                            {{ $aprobDocent == '-1' ? '' : 'disabled' }}>{{ $array['anteproyecto']->observaDocent }}</textarea>
                                    </div><br>
                                    <div class="form-check form-switch"
                                        style="display: {{ $aprobDocent == '-1' ? 'block' : 'none' }}"
                                        {{ $aprobDocent == '-1' ? '' : 'disabled' }}>
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                            name="switchAprobDoc">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Aprobación del
                                            docente</label>
                                    </div><br>
                                    <button class="btn"
                                        style="background:#003E65; color:#fff; margin-bottom: 10px; display: {{ $aprobDocent == '-1' ? 'block' : 'none' }}"
                                        {{ $aprobDocent == '-1' ? '' : 'disabled' }}
                                        formaction="{{ route('anteproyecto.aprobDoc') }}">Enviar actualizacion de estado de
                                        aprobación del documento</button>
                                    @if ($aprobDocent == '1')
                                        <p style="color: red">Los documentos NO fueron aprobados por el director del proyecto
                                        </p>
                                    @elseif ($aprobDocent == '2' || ($aprobDocent == '2' && $array['anteproyecto']->estado == 'Aplazado con modificaciones'))
                                        <p style="color: rgb(0, 62, 101)"><b>Los documentos fueron aprobados por el director del
                                                proyecto</b></p>
                                    @endif
                                @endif
                            @endcan
                        </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card" style="display: {{ $aprobDocent == '2' ? 'block' : 'none' }}">
        <h5 class="card-title text-center">Jurados</h5>

        <div class='card-body' style="text-align: center">
            <p
                style="color: red; display:{{ $array['anteproyecto']->juradoUno == '-1' || $array['anteproyecto']->juradoDos == '-1' ? 'block' : 'none' }}">
                Por favor espere a que se le asignen los jurados a la fase de anteproyecto</p>
            <p
                style="color: red; display:{{ $array['anteproyecto']->juradoUno != '-1' && $array['anteproyecto']->juradoDos != '-1' ? 'block' : 'none' }}">
                Los jurados fueron asignados exitosamente</p>
            @can('anteproyecto.verJurados')
                @php
                    $JuradoUno =
                        $array['anteproyecto']->juradoUno == '-1'
                            ? (object) ['nombre' => 'Sin asignar', 'apellido' => '']
                            : App\Models\UsuariosUser::where('numeroDocumento', $array['anteproyecto']->juradoUno)
                                ->select('nombre', 'apellido')
                                ->first();
                    $JuradoDos =
                        $array['anteproyecto']->juradoDos == '-1'
                            ? (object) ['nombre' => 'Sin asignar', 'apellido' => '']
                            : App\Models\UsuariosUser::where('numeroDocumento', $array['anteproyecto']->juradoDos)
                                ->select('nombre', 'apellido')
                                ->first();

                @endphp
                <section style="display: flex; flex-direction: row; text-align: center; justify-content: center">

                    <p style="color: red">Jurado 1: {{ $JuradoUno->nombre . ' ' . $JuradoUno->apellido }}</p>
                    <button type="button" id="SelectJ1" data-bs-toggle="modal" data-bs-target="#buscarDocente"
                        style="height: 30px; width: 30px; margin-left: 10px; display: {{ $array['anteproyecto']->juradoUno != '-1' ? 'block' : 'none' }}">
                        <img src="{{ asset('imgs/icons/edit.png') }}" class = "bi bi-pencil-square">
                    </button>
                </section>
                <section style="display: flex; flex-direction: row; text-align: center; justify-content: center">

                    <p style="color: red">Jurado 2: {{ $JuradoDos->nombre . ' ' . $JuradoDos->apellido }}</p>
                    <button type="button" id="SelectJ2" data-bs-toggle="modal" data-bs-target="#buscarDocente"
                        style="height: 30px; width: 30px; margin-left: 10px; display: {{ $array['anteproyecto']->juradoDos != '-1' ? 'block' : 'none' }}">
                        <img src="{{ asset('imgs/icons/edit.png') }}" class = "bi bi-pencil-square">
                    </button>
                </section>
                <div class="modal fade" tabindex="-1" id="buscarDocente" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">

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
                            ? 'none'
                            : 'block';
                @endphp
                @can('anteproyecto.asigJurados')
                    <button type="button" data-bs-toggle="modal" data-bs-target="#buscarDocente" class="btn"
                        style="background:#003E65; color:#fff; width: 100%; display: {{ $habilitarButtonJ }}">Seleccionar
                        jurados</button>
                @endcan
            @endcan
        </div>
    </div>
    <br>

    @if ($aprobDocent == '2' || $array['anteproyectoAnterior']->estado == 'Aplazado con modificaciones')

        <div class="card"
            style="display:{{ $array['anteproyecto']->juradoUno != '-1' || $array['anteproyecto']->juradoDos != '-1' || $array['anteproyectoAnterior']->estado == 'Aplazado con modificaciones' ? 'flex' : 'none' }}">

            <ul class="nav nav-tabs">
                <li class="nav-item"
                    style="display: {{ $array['anteproyecto']->juradoDos == App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento ? 'none' : 'block' }}">
                    <a class="nav-link active" aria-current="page" id="juradoUnoButton" style="cursor: pointer;">Jurado
                        1</a>
                </li>
                <li class="nav-item"
                    style="display: {{ $array['anteproyecto']->juradoUno == App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento ? 'none' : 'block' }}">
                    <a class="nav-link" aria-current="page" id="juradoDosButton" style="cursor: pointer;">Jurado 2</a>
                </li>
            </ul>
            <form action="{{ route('anteproyecto.store') }}" method='POST'>
                @csrf
                <input type="hidden" id="inputJurado" name="numeroJurado"
                    value="{{ $array['anteproyecto']->juradoDos == App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento ? '1' : ($array['anteproyecto']->juradoUno == App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento ? '0' : '0') }}">
                <section id="j1"
                    style="display: {{ $array['anteproyecto']->juradoDos == App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento ? 'none' : ($array['anteproyecto']->juradoDos != App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento && $array['anteproyecto']->juradoUno != App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento ? 'block' : 'block') }}">
                    @component('components.anteproyecto.VistaJurados', [
                        'array' => $array,
                        'valRolComite' => $valRolComite,
                        'jurado' => 0,
                        'fase' => 'anteproyecto',
                        'idFase' => $array['anteproyecto']->idAnteproyecto,
                    ])
                    @endcomponent
                </section>
                <section id="j2"
                    style="display: {{ $array['anteproyecto']->juradoUno == App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento ? 'none' : ($array['anteproyecto']->juradoDos != App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento && $array['anteproyecto']->juradoUno != App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento ? 'none' : 'block') }}">
                    @component('components.anteproyecto.VistaJurados', [
                        'array' => $array,
                        'valRolComite' => $valRolComite,
                        'jurado' => 1,
                        'fase' => 'anteproyecto',
                        'idFase' => $array['anteproyecto']->idAnteproyecto,
                    ])
                    @endcomponent
                </section>
            </form>


        </div>
    @endif
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

    </div>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.location.hash="no-back-button";
            window.location.hash="Again-No-back-button";//esta linea es necesaria para chrome
            window.onhashchange=function(){window.location.hash="no-back-button";}
            const btnSelectJurado1 = document.getElementById('SelectJ1');
            const btnSelectJurado2 = document.getElementById('SelectJ2');
            const JIdentificador = document.getElementById('JIdentificador');
            const enlace1 = document.getElementById('juradoUnoButton');
            const enlace2 = document.getElementById('juradoDosButton');
            const inputJurado = document.getElementById('inputJurado');
            const secJ1 = document.getElementById('j1');
            const secJ2 = document.getElementById('j2');

            if (inputJurado.value === '0') {
                secJ2.querySelectorAll('textarea').forEach(textarea => {
                    textarea.name = 'inactive_' + textarea.name;
                    textarea.required = false;
                    textarea.value = textarea.value.trim();
                });

                secJ1.querySelectorAll('textarea').forEach(textarea => {
                    textarea.name = textarea.name.replace(/^inactive_/, '');
                    textarea.required = true;
                    textarea.value = textarea.value.trim();
                });
            } else if (inputJurado.value === '1') {
                secJ1.querySelectorAll('textarea').forEach(textarea => {
                    textarea.name = 'inactive_' + textarea.name;
                    textarea.required = false;
                    textarea.value = textarea.value.trim();
                });

                secJ2.querySelectorAll('textarea').forEach(textarea => {
                    textarea.name = textarea.name.replaceAll('inactive_', '');
                    textarea.required = true;
                    textarea.value = textarea.value.trim();
                });
            }

            enlace1.addEventListener('click', function(event) {
                event.preventDefault();

                inputJurado.value = '0';

                enlace1.classList.add('active');
                enlace2.classList.remove('active');

                secJ1.style.display = 'block';
                secJ2.style.display = 'none';
            });

            enlace2.addEventListener('click', function(event) {
                event.preventDefault();

                inputJurado.value = '1';

                enlace2.classList.add('active');
                enlace1.classList.remove('active');

                secJ2.style.display = 'block';
                secJ1.style.display = 'none';
            });

            btnSelectJurado1.addEventListener('click', function(event) {
                event.preventDefault();
                document.querySelectorAll('.JIdentificador').forEach(function(input) {
                    input.value = '1';
                });
            });

            btnSelectJurado2.addEventListener('click', function(event) {
                event.preventDefault();
                document.querySelectorAll('.JIdentificador').forEach(function(input) {
                    input.value = '2';
                });
            });


        });
    </script>

@stop
