@extends('dashboard')
@section('dashboard_content')

    <div class="card">
        <h5 class="card-title text-center">Crear propuesta</h5>
        <div class='card-body'>
            <p class="card-text">
                <button id="calificar" Class='btn btn-primary'>Calificar</button>
            <form action="{{ route('propuesta.store') }}" method='POST'>
                @csrf
                <input type="hidden" value="{{ $idProyecto }}" name='idProyecto'>
                <input type="hidden" value="{{ $propuestaAnterior->idPropuesta }}" name='idPropuesta'>
                <div>
                    <label for="titleForPropuestaId">Titulo</label>
                    <div class="input-group mb-3">
                        <input type="text" name='titulo' onchange="validarCampos()" id="titleForPropuestaId"
                            oninput="limitarLongitud( this.id, 25, 'contadorTitle' )" class='form-control'
                            value = "{{ $propuestaAnterior->titulo }}" required>
                        <span class="input-group-text" id="basic-addon2">
                            <p class="fw-bold">--</p>
                        </span>
                    </div>
                    <p>Longitud máxima: <span id="contadorTitle"></span></p>
                    @component('components.calificacionObser', [
                        'nameSelect' => 'tituloCalificacion',
                        'nameTextArea' => 'tituloObservacion',
                    ])
                    @endcomponent
                    <br>
                </div>
                <div>
                    <label>Linea de investigación</label>
                    <div class="input-group mb-3">
                        <input type="text" name='linea_invs' onchange="validarCampos()" class='form-control'
                            value = "{{ $propuestaAnterior->linea_invs }}" required>
                        <span class="input-group-text" id="basic-addon2">
                            <p class="fw-bold">--</p>
                        </span>
                    </div>
                    @component('components.calificacionObser', [
                        'nameSelect' => 'lineaCalificacion',
                        'nameTextArea' => 'lineaObservacion',
                    ])
                    @endcomponent
                </div>
                <br>
                <div class="mb-3">
                    <label class="form-label">Descripción del problema</label>
                    <div class="input-group mb-3">
                        <textarea class="form-control auto-expand" name="desc_problema" onchange="validarCampos()" id="descriptionPropuestaId"
                            oninput="limitarLongitud( this.id, 600, 'DescripcionContador' )" class='form-control'
                            placeholder="Descripción del problema" required>{{ $propuestaAnterior->desc_problema }}</textarea>
                        <span class="input-group-text" id="basic-addon2">
                            <p class="fw-bold">--</p>
                        </span>
                    </div>
                    <p>Longitud máxima: <span id="DescripcionContador"></span></p>
                    @component('components.calificacionObser', [
                        'nameSelect' => 'descProbCalificacion',
                        'nameTextArea' => 'descProbObservacion',
                    ])
                    @endcomponent
                </div>
                <br>
                <div class="mb-3">
                    <label class="form-label">Objetivo general</label>
                    <div class="input-group mb-3">
                        <textarea class="form-control auto-expand" name="obj_general" onchange="validarCampos()" id="objectiveGeneralId"
                            oninput="limitarLongitud( this.id, 25, 'ObjetivoGeneralContador' )" class='form-control'
                            placeholder="Objetivo general" required>{{ $propuestaAnterior->obj_general }}</textarea>
                        <span class="input-group-text" id="basic-addon2">
                            <p class="fw-bold">--</p>
                        </span>
                    </div>
                    <p>Longitud máxima: <span id="ObjetivoGeneralContador"></span></p>
                    @component('components.calificacionObser', [
                        'nameSelect' => 'objGenCalificacion',
                        'nameTextArea' => 'objGenObservacion',
                    ])
                    @endcomponent
                </div>
                <br>
                <div class="mb-3">
                    <label class="form-label">Objetivos específicos</label>
                    <div class="input-group mb-3">
                        <textarea class="form-control auto-expand" name="obj_especificos" onchange="validarCampos()" class='form-control'
                            placeholder="Objetivos específicos" required>{{ $propuestaAnterior->obj_especificos }}</textarea>
                        <span class="input-group-text" id="basic-addon2">
                            <p class="fw-bold">--</p>
                        </span>
                    </div>
                    @component('components.calificacionObser', [
                        'nameSelect' => 'objEspCalificacion',
                        'nameTextArea' => 'objEspObservacion',
                    ])
                    @endcomponent
                    <br>
                    <div class="mb-3">
                        <button id="buttonToCreatePropuesta" class="btn"
                            style="background:#003E65; color:#fff">Agregar</button>
                        <button id="buttonEnviarCalificacion" formaction="{{ route('observaciones.store') }}" class="btn"
                            style="background:#003E65; color:#fff">Enviar calificación</button>
                    </div>
            </form>
            </p>
        </div>
    </div>
@section('js')
    <script>
        const mostrarCamposCalificacion = () => {
            const camposCalificacion = document.querySelectorAll('.campos-calificacion');

            camposCalificacion.forEach(campos => {
                campos.style.display = 'flex';
                // Agregar el atributo required a los campos dentro de la sección
                campos.querySelectorAll('input, textarea').forEach(campo => {
                    campo.required = true;
                });
            });

            // Mostrar el botón de enviar calificación
            const buttonEnviarCalificacion = document.getElementById('buttonEnviarCalificacion');
            const buttonToCreatePropuesta = document.getElementById('buttonToCreatePropuesta');

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
                });
            });

            // Ocultar el botón de enviar calificación
            const buttonEnviarCalificacion = document.getElementById('buttonEnviarCalificacion');
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

        document.addEventListener('DOMContentLoaded', function() {
            const buttonCalificar = document.getElementById('calificar');
            const buttonToCreatePropuesta = document.getElementById('buttonToCreatePropuesta');

            buttonCalificar.addEventListener('click', function() {
                mostrarCamposCalificacion();
            });

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
