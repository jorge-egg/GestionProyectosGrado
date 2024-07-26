@extends('dashboard')
@section('dashboard_content')

    <br>
    <form id='validacion' action="{{ route('propuesta.store', 'propuesta') }}" method='POST'>
        <div style="display: flex; flex-direction:row; justify-content: space-around">
            <div>
                <p class="fs-4">Estado: {{ $propuestaAnterior->estado }}</p>
                <p class="fs-4">Calificación: {{ number_format($totalCalificacion, 2) }}</p>
            </div>
            <p class="fs-5">Fecha de habilitación: {{ $rangoFecha[0] }} a {{ $rangoFecha[1] }}</p>
            @if ($estadoButton)
                <button type="submit" class="btn btn-outline-dark"
                    formaction="{{ route('propuesta.createAnterior', ['idProyecto' => $idProyecto]) }}">
                    <i class="bi bi-arrow-bar-left"></i>Propuesta anterior
                </button>
            @elseif (!$estadoButton)
                <button type="submit" class="btn btn-outline-dark"
                    formaction="{{ route('propuesta.create', ['idProyecto' => $idProyecto]) }}">
                    Propuesta superior<i class="bi bi-arrow-bar-left"></i>
                </button>
            @endif
        </div><br>

        <div class="modal fade" tabindex="-1" id="buscarDocente" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            @component('components.Modales.buscarDocente', [
                'docentes' => $miembrosDocente['docentes'],
                'idProyecto' => $miembrosDocente['idProyecto'],
                'fase' => 'propuesta',
            ])
            @endcomponent
        </div>
        <div class="card" style="display:{{ $propuestaAnterior->estado == 'Aprobado' ? 'flex' : 'none' }}">
            <h5 class="card-title text-center">Director tutor</h5>
            <div class='card-body'>
                <section style="display: flex; flex-direction: row; text-align: center; justify-content: center">
                    <p class="card-text" Style="text-align: center;">
                        {{ $miembrosDocente['valExistDocent'] ? 'El director asignado para el proyecto es: ' . $miembrosDocente['docenteAsig'] : 'Nota: para poder habilitar la fase del anteproyecto, debe tener un director asignado.' }}
                    </p>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#buscarDocente"
                        style="height: 30px; width: 30px; margin-left: 10px; display: {{ $miembrosDocente['valExistDocent'] ? 'block' : 'none' }}">
                        <img src="{{ asset('imgs/icons/edit.png') }}" class = "bi bi-pencil-square">
                    </button>
                </section>
                @can('anteproyecto.asigDocent')
                    <button type="button" data-bs-toggle="modal" data-bs-target="#buscarDocente" class="btn"
                        style="background:#003E65; color:#fff; width: 100%; display: {{ $miembrosDocente['valExistDocent'] ? 'none' : 'flex' }};">Seleccionar
                        docente</button>
                    <p style="display: none">{{ $valRolComite = true }}</p>
                @endcan

            </div>
        </div><br>

        <div class="card">
            <h5 class="card-title text-center">Crear propuesta</h5>
            <div class='card-body'>
                <p class="card-text">


                <div>
                    @foreach ($integrantes as $key => $integrante)
                        <h1>Integrante {{ $key + 1 }}: {{ $integrante->usuarios_user->nombre }}
                            {{ $integrante->usuarios_user->apellido }}</h1>
                    @endforeach
                </div>
                <br>
                @can('propuesta.calificar')
                    <button type="button" id="calificar" class="btn" style="background:#003E65; color:#fff"
                        onclick="mostrarCamposCalificacion()">Calificar</button>
                @endcan
                @if ($propuestaAnterior->estado == 'Aprobado')
                    <span style="color: red;">Esta fase del proyecto ha sido completada, pase a la siguiente
                        fase.</span>
                @elseif ($propuestaAnterior->estado == 'Aplazado con modificaciones')
                    <span style="color: red;">Tiene 10 días hábiles para enviar la corrección, después de eso no tendrá
                        más oportunidades.</span>
                @elseif ($propuestaAnterior->estado == 'Rechazado')
                    <span style="color: red;">Su proyecto finalizó. Para poder enviar otra propuesta, deberá crear otro
                        proyecto.</span>
                @endif

                @csrf
                <input type="hidden" value="{{ $miembrosDocente['idProyecto'] }}" name='idProyecto'>
                <input type="hidden" value="{{ $propuestaAnterior->idPropuesta }}" name='idFase'>

                <div>
                    <label for="titleForPropuestaId">Titulo</label>
                    <div class="input-group mb-3">
                        <input type="text" name='titulo' onchange="validarCampos()" id="titleForPropuestaId"
                            oninput="limitarLongitud( this.id, 25, 'contadorTitle' )"
                            class='form-control campo-deshabilitar' value = "{{ $propuestaAnterior->titulo }}" required
                            @can('propuesta.calificar')
                                disabled
                            @endcan>
                        <span class="input-group-text" id="basic-addon2">
                            <p class="fw-bold">{{ $calificacion[4]['calificacion'] }}</p>
                        </span>
                    </div>
                    <p>Longitud máxima: <span id="contadorTitle"></span></p>
                    @component('components.calificacionObserPro', [
                        'nameSelect' => 'tituloCalificacion',
                        'nameTextArea' => 'tituloObservacion',
                        'obsArray' => $calificacion[4]['observacion'],
                    ])
                    @endcomponent
                    <br>
                </div>
                <div>
                    <label>Linea de investigación</label>
                    <div class="input-group mb-3">
                        <input type="text" name='linea_invs' onchange="validarCampos()"
                            class='form-control campo-deshabilitar' value = "{{ $propuestaAnterior->linea_invs }}" required
                            @can('propuesta.calificar')
                            disabled
                        @endcan>
                        <span class="input-group-text" id="basic-addon2">
                            <p class="fw-bold">{{ $calificacion[3]['calificacion'] }}</p>
                        </span>
                    </div>
                    @component('components.calificacionObserPro', [
                        'nameSelect' => 'lineaCalificacion',
                        'nameTextArea' => 'lineaObservacion',
                        'obsArray' => $calificacion[3]['observacion'],
                    ])
                    @endcomponent
                </div>
                <br>
                <div class="mb-3">
                    <label class="form-label">Descripción del problema</label>
                    <div class="input-group mb-3">
                        <textarea class="form-control auto-expand campo-deshabilitar" name="desc_problema" onchange="validarCampos()"
                            id="descriptionPropuestaId" oninput="limitarLongitud( this.id, 600, 'DescripcionContador' )" class='form-control'
                            placeholder="Descripción del problema" required
                            @can('propuesta.calificar')
                            disabled
                        @endcan>{{ $propuestaAnterior->desc_problema }} </textarea>
                        <span class="input-group-text" id="basic-addon2">
                            <p class="fw-bold">{{ $calificacion[2]['calificacion'] }}</p>
                        </span>
                    </div>
                    <p>Longitud máxima: <span id="DescripcionContador"></span></p>
                    @component('components.calificacionObserPro', [
                        'nameSelect' => 'descProbCalificacion',
                        'nameTextArea' => 'descProbObservacion',
                        'obsArray' => $calificacion[2]['observacion'],
                    ])
                    @endcomponent
                </div>
                <br>
                <div class="mb-3">
                    <label class="form-label">Objetivo general</label>
                    <div class="input-group mb-3">
                        <textarea class="form-control auto-expand campo-deshabilitar" name="obj_general" onchange="validarCampos()"
                            id="objectiveGeneralId" oninput="limitarLongitud( this.id, 25, 'ObjetivoGeneralContador' )" class='form-control'
                            placeholder="Objetivo general" required
                            @can('propuesta.calificar')
                            disabled
                        @endcan>{{ $propuestaAnterior->obj_general }}</textarea>
                        <span class="input-group-text" id="basic-addon2">
                            <p class="fw-bold">{{ $calificacion[1]['calificacion'] }}</p>
                        </span>
                    </div>
                    <p>Longitud máxima: <span id="ObjetivoGeneralContador"></span></p>
                    @component('components.calificacionObserPro', [
                        'nameSelect' => 'objGenCalificacion',
                        'nameTextArea' => 'objGenObservacion',
                        'obsArray' => $calificacion[1]['observacion'],
                    ])
                    @endcomponent
                </div>
                <br>
                <div class="mb-3">
                    <label class="form-label">Objetivos específicos</label>
                    <div class="input-group mb-3">
                        <textarea class="form-control auto-expand campo-deshabilitar" name="obj_especificos" onchange="validarCampos()"
                            class='form-control' placeholder="Objetivos específicos" required
                            @can('propuesta.calificar')
                            disabled
                        @endcan>{{ $propuestaAnterior->obj_especificos }}</textarea>
                        <span class="input-group-text" id="basic-addon2">
                            <p class="fw-bold">{{ $calificacion[0]['calificacion'] }}</p>
                        </span>
                    </div>
                    @component('components.calificacionObserPro', [
                        'nameSelect' => 'objEspCalificacion',
                        'nameTextArea' => 'objEspObservacion',
                        'obsArray' => $calificacion[0]['observacion'],
                    ])
                    @endcomponent
                    <br>
                    <div class="mb-3">
                        @can('propuesta.agregar')
                            <button id="buttonToCreatePropuesta" class="btn"
                                style="background:#003E65; color:#fff">Agregar</button>
                        @endcan
                        <div id="countdown" style="color: red;"></div>
                        @if ($calificacion != 0)
                            <button id="buttonEnviarCalificacion" class="btn"
                                style="background:#003E65; color:#fff; display:none"
                                formaction="{{ route('observaciones.store', 'propuesta') }}">Enviar
                                calificación</button>
                        @endif


                        </p>
                    </div>
                </div>
    </form>
    {{-- alertas  --}}
    <script>
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-outline-success",
                cancelButton: "btn btn-outline-danger"
            },
            buttonsStyling: false
        });

        function checkEmptyFields(form) {
            const fields = form.querySelectorAll('textarea');
            for (const field of fields) {
                if (!field.disabled && field.style.display !== 'none' && field.value.trim() === '') {
                    return true;
                }
            }
            return false;
        }

        function showAlert(event) {
            event.preventDefault(); // Evitar el envío del formulario

            const button = event.target;
            const form = button.closest('form');
            const formaction = button.getAttribute('formaction');

            if (checkEmptyFields(form)) {
                swalWithBootstrapButtons.fire({
                    title: "Campos vacíos",
                    text: "Por favor, rellena todos los campos visibles",
                    icon: "error",
                    cancelButton: "OK"
                });
                return;
            }

            swalWithBootstrapButtons.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí",
                cancelButtonText: "No",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire({
                        title: "Enviado exitosamente",
                        text: "Formulario enviado.",
                        icon: "success"
                    }).then(() => {
                        if (formaction) {
                            form.action = formaction; // Cambiar la acción del formulario a la especificada en formaction
                        }
                        form.submit(); // Enviar el formulario después de confirmar
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelado",
                        text: "Tu acción ha sido cancelada",
                        icon: "error"
                    });
                }
            });
        }

        document.getElementById('buttonEnviarCalificacion').addEventListener('click', showAlert);
        document.getElementById('buttonToCreatePropuesta').addEventListener('click', showAlert);

    </script>
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function mostrarCamposCalificacion() {
            const camposCalificacion = document.querySelectorAll('.campos-calificacion');

            camposCalificacion.forEach(campos => {
                campos.style.display = 'flex';
                campos.querySelectorAll('input, textarea').forEach(campo => {
                    campo.required = true;
                    campo.disabled = false;
                });

                const spanElement = campos.querySelector('.input-group-text');
                if (spanElement) {
                    spanElement.style.display = 'inline-block';
                }
            });

            buttonEnviarCalificacion.style.display = 'inline-block';
            buttonToCreatePropuesta.style.display = 'none';
        }

        const limitarLongitud = (id, longitud, contadorId) => {
            const input = document.getElementById(id);
            const contador = document.getElementById(contadorId);

            if (input.value.length <= 0) {
                contador.textContent = 0;
                return;
            }

            const maxPalabras = longitud;
            let palabras = input.value.split(' ');

            if (palabras.length > maxPalabras) {
                contador.textContent = "Limite de palabras excedido.";
                contador.style.color = 'red';
                palabras.pop();
                input.value = palabras.join(' ');
                var camposVacios = true;
            } else if (palabras.length <= maxPalabras) {
                contador.textContent = palabras.length;
                var camposVacios = false;
                contador.style.color = 'black';
            }

            const button = document.getElementById('buttonToCreatePropuesta');
            button.disabled = camposVacios;
        }

        const validarCampos = () => {
            const inputs = document.querySelectorAll('input[required], textarea[required]');
            let camposVacios = false;

            inputs.forEach(input => {
                if (input.value.trim() === '') {
                    camposVacios = true;
                } else {
                    camposVacios = false;
                }
            });

            const button = document.getElementById('buttonToCreatePropuesta');
            button.disabled = camposVacios;
        }

        window.addEventListener('load', validarCampos);

        document.addEventListener('DOMContentLoaded', function() {
            const buttonToCreatePropuesta = document.getElementById('buttonToCreatePropuesta');
            const buttonEnviarCalificacion = document.getElementById('buttonEnviarCalificacion');
            const buttonCalificar = document.getElementById('calificar');

            const estadoPropuesta = "{{ $propuestaAnterior->estado }}";
            var rangoFecha = "{{ $rangoFecha[2] }}";

            if (estadoPropuesta === 'Aprobado' || !rangoFecha || estadoPropuesta === 'Rechazado' ||
                estadoPropuesta === 'pendiente') {
                deshabilitarCamposYBoton();
            } else if (estadoPropuesta === 'Activo') {
                ocultarBotonCalificar();
            } else if (estadoPropuesta === 'Aplazado con modificaciones' && rangoFecha) {
                const endDate = new Date("{{ $propuestaAnterior->fecha_aplazado }}");
                endDate.setDate(endDate.getDate() + 10);
                // endDate.setMinutes(endDate.getMinutes() + 1);
                const countdownInterval = setInterval(updateCountdown, 1000);

                function updateCountdown() {
                    const currentDate = new Date();
                    const timeDifference = endDate - currentDate;

                    if (timeDifference <= 0) {
                        clearInterval(countdownInterval);
                        document.getElementById('countdown').innerHTML = 'Plazo de correciones terminado';
                        deshabilitarCamposYBoton();
                    } else {
                        const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

                        const countdownString =
                            `Te quedan ${days}d ${hours}h ${minutes}m ${seconds}s para corregir tu propuesta`;

                        document.getElementById('countdown').innerHTML = countdownString;
                    }
                }
            }

            function deshabilitarCamposYBoton() {
                const camposDeshabilitar = document.querySelectorAll('.campo-deshabilitar');
                camposDeshabilitar.forEach(campo => {
                    campo.disabled = true;
                });

                buttonToCreatePropuesta.style.display = 'none';
            }

            function ocultarBotonCalificar() {
                buttonCalificar.style.display = 'none';
            }

            buttonCalificar.addEventListener('click', function() {
                buttonEnviarCalificacion.style.display = 'inline-block';
            });

            const deshabilitarCampos = () => {
                const camposDeshabilitar = document.querySelectorAll('.campo-deshabilitar');
                camposDeshabilitar.forEach(campo => {
                    campo.disabled = true;
                });
            }

            const ocultarCamposCalificacion = () => {
                const camposCalificacion = document.querySelectorAll('.campos-calificacion');
                camposCalificacion.forEach(campos => {
                    campos.style.display = 'none';
                    campos.querySelectorAll('input, textarea').forEach(campo => {
                        campo.required = false;
                        campo.disabled = true;
                    });
                });

                buttonEnviarCalificacion.style.display = 'none';
            }

            ocultarCamposCalificacion();

            const textareas = document.querySelectorAll('.auto-expand');
            textareas.forEach(textarea => {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
            });

            validarCampos();

            const inputs = document.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.addEventListener('input', validarCampos);
            });

        });
    </script>
@endsection
@stop
