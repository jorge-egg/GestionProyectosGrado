@extends('dashboard')
@section('dashboard_content')
    <br>
    <form action="{{ route('propuesta.store') }}" method='POST'>
        <div style="display: flex; flex-direction:row; justify-content: space-around">

            <p class="fs-4">Estado: {{ $propuestaAnterior->estado }}</p>
            <p class="fs-5">Fecha de habilitación: {{ $rangoFecha[0] }} a {{ $rangoFecha[1] }}</p>
            <button type="submit" class="btn btn-outline-dark" formaction="{{ route('propuesta.createAnterior') }}"><i
                    class="bi bi-arrow-bar-left">Propuesta anterior</i></button>
        </div><br>
        <div class="card">
            <h5 class="card-title text-center">Crear propuesta</h5>
            <div class='card-body'>
                <p class="card-text">
                    @can('propuesta.calificar')
                        <button type="button" id="calificar" class="btn"
                            style="background:#003E65; color:#fff">Calificar</button>
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
                    <input type="hidden" value="{{ $idProyecto }}" name='idProyecto'>
                    <input type="hidden" value="{{ $propuestaAnterior->idPropuesta }}" name='idPropuesta'>
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
                            <p class="fw-bold">{{ $calificacion[0] }}</p>
                        </span>
                    </div>
                    <p>Longitud máxima: <span id="contadorTitle"></span></p>
                    @component('components.calificacionObser', [
                        'nameSelect' => 'tituloCalificacion',
                        'nameTextArea' => 'tituloObservacion',
                        'obsArray' => $observaciones[0],
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
                            <p class="fw-bold">{{ $calificacion[1] }}</p>
                        </span>
                    </div>
                    @component('components.calificacionObser', [
                        'nameSelect' => 'lineaCalificacion',
                        'nameTextArea' => 'lineaObservacion',
                        'obsArray' => $observaciones[1],
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
                        @endcan>{{ $propuestaAnterior->desc_problema }}</textarea>
                        <span class="input-group-text" id="basic-addon2">
                            <p class="fw-bold">{{ $calificacion[2] }}</p>
                        </span>
                    </div>
                    <p>Longitud máxima: <span id="DescripcionContador"></span></p>
                    @component('components.calificacionObser', [
                        'nameSelect' => 'descProbCalificacion',
                        'nameTextArea' => 'descProbObservacion',
                        'obsArray' => $observaciones[2],
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
                            <p class="fw-bold">{{ $calificacion[3] }}</p>
                        </span>
                    </div>
                    <p>Longitud máxima: <span id="ObjetivoGeneralContador"></span></p>
                    @component('components.calificacionObser', [
                        'nameSelect' => 'objGenCalificacion',
                        'nameTextArea' => 'objGenObservacion',
                        'obsArray' => $observaciones[3],
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
                            <p class="fw-bold">{{ $calificacion[4] }}</p>
                        </span>
                    </div>
                    @component('components.calificacionObser', [
                        'nameSelect' => 'objEspCalificacion',
                        'nameTextArea' => 'objEspObservacion',
                        'obsArray' => $observaciones[4],
                    ])
                    @endcomponent
                    <br>
                    <div class="mb-3">
                        @can('propuesta.agregar')
                            <button id="buttonToCreatePropuesta" class="btn"
                                style="background:#003E65; color:#fff">Agregar</button>
                        @endcan


                        <button id="buttonEnviarCalificacion"
                            formaction="{{ $validarCalificacion ? route('observaciones.store') : route('observaciones.update') }}"
                            class="btn" style="background:#003E65; color:#fff; display:none">Enviar calificación</button>

                        </p>
                    </div>
                </div>
    </form>
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttonCalificar = document.getElementById('calificar');
            const buttonToCreatePropuesta = document.getElementById('buttonToCreatePropuesta');
            const buttonEnviarCalificacion = document.getElementById('buttonEnviarCalificacion');

            // Obtener el estado de la propuesta
            const estadoPropuesta = "{{ $propuestaAnterior->estado }}";
            var rangoFecha = "{{ $rangoFecha[2] }}";

            // Verificar el estado y deshabilitar campos y botón si es necesario
            if (estadoPropuesta === 'Aprobado' || !rangoFecha || estadoPropuesta === 'Rechazado') {
                deshabilitarCamposYBoton();
            } else if (estadoPropuesta === 'pendiente' || estadoPropuesta === 'activo') {
                ocultarBotonCalificar();
            }

            buttonCalificar.addEventListener('click', function() {
                mostrarCamposCalificacion();
            });

            function deshabilitarCamposYBoton() {
                const camposDeshabilitar = document.querySelectorAll('.campo-deshabilitar');
                camposDeshabilitar.forEach(campo => {
                    campo.disabled = true;
                });
                buttonToCreatePropuesta.disabled = true;
            }

            function ocultarBotonCalificar() {
                buttonCalificar.style.display = 'none';
            }
            buttonCalificar.addEventListener('click', function() {
                buttonEnviarCalificacion.style.display = 'inline-block';
            });
            //verificar fecha



            const deshabilitarCampos = () => {
                const camposDeshabilitar = document.querySelectorAll('.campo-deshabilitar');
                camposDeshabilitar.forEach(campo => {
                    campo.disabled = true;
                });
            }

            const mostrarCamposCalificacion = () => {
                deshabilitarCampos();
                const camposCalificacion = document.querySelectorAll('.campos-calificacion');

                camposCalificacion.forEach(campos => {
                    campos.style.display = 'flex';
                    // Agregar el atributo required a los campos dentro de la sección
                    campos.querySelectorAll('input, textarea').forEach(campo => {
                        campo.required = true;
                        campo.disabled = false; // Habilitar campos al mostrar
                    });
                });

                // Mostrar el botón de enviar calificación
                buttonEnviarCalificacion.style.display = 'inline-block';
                buttonToCreatePropuesta.style.display = 'none';
            }

            const ocultarCamposCalificacion = () => {
                const camposCalificacion = document.querySelectorAll('.campos-calificacion');

                camposCalificacion.forEach(campos => {
                    campos.style.display = 'none';
                    // Quitar el atributo required de los campos dentro de la sección
                    campos.querySelectorAll('input, textarea').forEach(campo => {
                        campo.required = false;
                        campo.disabled = true; // Deshabilitar campos al ocultar
                    });
                });

                // Ocultar el botón de enviar calificación
                buttonEnviarCalificacion.style.display = 'none';
            }

            const limitarLongitud = (id, longitud, contadorId) => {
                const input = document.getElementById(id);
                const contador = document.getElementById(contadorId);

                if (input.value.length <= 0) {
                    contador.textContent = 0;
                    return;
                }

                const maxPalabras = longitud; // Define la cantidad máxima de palabras aquí

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

            // Asegurarse de que los campos de calificación no estén marcados como required inicialmente
            ocultarCamposCalificacion();

            // Auto-expandir textarea
            const textareas = document.querySelectorAll('.auto-expand');
            textareas.forEach(textarea => {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
            });

            // Validar campos al cargar la página
            validarCampos();

            // Validar campos al cambiar el contenido de los campos
            const inputs = document.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.addEventListener('input', validarCampos);
            });
        });
    </script>
@endsection
@stop
