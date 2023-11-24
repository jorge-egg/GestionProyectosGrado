@extends('dashboard')
@section('dashboard_content')

    <div class="card">
        <h5 class="card-title text-center">Crear propuesta</h5>
        <div class='card-body'>
            <p class="card-text">
                <button id="calificar" Class='btn btn-primary'>Calificar</button>
            <form action="{{ route('propuesta.store') }}" method='POST'>
                @csrf
                <input type="hidden" value="{{ $idProyecto }}" name="idProyecto">
                <div>
                    <label for="">Titulo</label>
                    <input type="text" name='titulo' onchange="validarCampos()" id="titleForPropuestaId"
                        oninput="limitarLongitud( this.id, 25, 'contadorTitle' )" class='form-control'
                        value = "{{ $propuestaAnterior->titulo }}" required>
                    <p>Longitud máxima: <span id="contadorTitle"></span></p>
                    <div class="mb-3 campos-calificacion" style="display: none;">
                        <label for="" class="form-label">Observacion</label>

                        <textarea class="form-control auto-expand" id="Observaciones" placeholder="Observaciones" name="tituloObservacion"></textarea>
                        <div>
                            <label for="">Calificación</label>
                            <input type="text" id="calificacion" name="tituloCalificacion" class="form-control">
                        </div>
                    </div>
                    <br>
                </div>
                <div><label for="">Linea de investigacion</label>
                    <input type="text" name='linea_invs' onchange="validarCampos()" class='form-control'
                        value = "{{ $propuestaAnterior->linea_invs }}" required>
                        <div class="mb-3 campos-calificacion" style="display: none;">
                            <label for="" class="form-label">Observacion</label>
                            <textarea class="form-control auto-expand" id="Observaciones" placeholder="Observaciones" name="lineaObservacion"></textarea>
                            <div>
                            <label for="">Calificación</label>
                            <input type="text" id="calificacion" name="lineaCalificacion" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label class="form-label">Descripción del problema</label>
                        <textarea class="form-control auto-expand" onchange="validarCampos()" id="descriptionPropuestaId"
                            oninput="limitarLongitud( this.id, 600, 'DescripcionContador' )" placeholder="Descripción del problema"
                            name="desc_problema" required>{{ $propuestaAnterior->desc_problema }}</textarea>
                        <p>Longitud máxima: <span id="DescripcionContador"></span></p>
                        <div class="mb-3 campos-calificacion" style="display: none;">
                            <label for="" class="form-label">Observacion</label>
                            <textarea class="form-control auto-expand" id="Observaciones" placeholder="Observaciones" name="descProbObservacion"></textarea>
                            <div>
                                <label for="">Calificación</label>
                                <input type="text" id="calificacion" name="descProbCalificacion" class="form-control">

                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label class="form-label">Objetivo general</label>
                        <textarea class="form-control auto-expand" onchange="validarCampos()" id="objectiveGeneralId" placeholder="Objetivo general"
                            oninput="limitarLongitud( this.id, 25, 'ObjetivoGeneralContador' )" name="obj_general" required>{{ $propuestaAnterior->obj_general }}</textarea>

                        <p>Longitud máxima: <span id="ObjetivoGeneralContador"></span></p>
                        <div class="mb-3 campos-calificacion" style="display: none;">
                            <label for="" class="form-label">Observacion</label>
                            <textarea class="form-control auto-expand" id="Observaciones" placeholder="Observaciones" name="objGenObservacion"></textarea>
                            <div>
                                <label for="">Calificación</label>
                                <input type="text" id="calificacion" name="objGenCalificacion" class="form-control">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label class="form-label">Objetivos específicos</label>
                        <textarea class="form-control auto-expand" onchange="validarCampos()" placeholder="Objetivos específicos" name="obj_especificos"
                            required>{{ $propuestaAnterior->obj_especificos }}</textarea>
                        <div class="mb-3 campos-calificacion" style="display: none;">
                            <label for="" class="form-label">Observacion</label>
                            <textarea class="form-control auto-expand" id="Observaciones" placeholder="Observaciones" name="objEspObservacion"></textarea>
                            <div>
                                <label for="">Calificación</label>
                                <input type="text" id="calificacion" name="objEspCalificacion" class="form-control">

                            </div>
                        </div>
                        <br>
                        <div class="mb-3">
                            <button id="buttonToCreatePropuesta" class="btn" style="background:#003E65; color:#fff">Agregar</button>
                            <button id="buttonEnviarCalificacion" formaction="{{ route('observaciones.store') }}" class="btn" style="background:#003E65; color:#fff">Enviar calificación</button>
                        </div>

            </form>

            </p>
        </div>
    </div>
    <style>
        /* Estilo para el campo de calificación */
        #calificacion {
            width: 50px; /* Ajusta el ancho según tus preferencias */
        }
    </style>

@section('js')
<script>

const mostrarCamposCalificacion = () => {
        const camposCalificacion = document.querySelectorAll('.campos-calificacion');

        camposCalificacion.forEach(campos => {
            campos.style.display = 'block';
            // Agregar el atributo required a los campos dentro de la sección
            campos.querySelectorAll('input, textarea').forEach(campo => {
                campo.required = true;
            });
        });

        // Mostrar el botón de enviar calificación
        const buttonEnviarCalificacion = document.getElementById('buttonEnviarCalificacion');
        buttonEnviarCalificacion.style.display = 'inline-block';
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
        }

        const button = document.getElementById('buttonToCreatePropuesta');
        button.disabled = camposVacios;

        input.addEventListener('paste', function(event) {
            event.preventDefault(); // Evita que se pegue el texto en el input
        });
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
            textarea.addEventListener('input', function () {
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
