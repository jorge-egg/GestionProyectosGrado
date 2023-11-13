@extends('dashboard')
@section('dashboard_content')

<div class="card">
    <h5 class="card-title text-center">Crear propuesta</h5>
    <div class='card-body'>
        <p class="card-text">
            <button id="calificar" Class='btn btn-primary'>Calificar</button>
        <form action="{{route('propuesta.store')}}" method='POST'>
        @csrf
        <input type="hidden" value="{{ $idProyecto }}" name="idProyecto">
            <div>
                <label for="">Titulo</label>
                <input type="text" name='titulo' onchange="validarCampos()" id="titleForPropuestaId" oninput="limitarLongitud( this.id, 25, 'contadorTitle' )" class='form-control' value = "{{$propuestaAnterior->titulo}}" required >
                <p>Longitud máxima: <span id="contadorTitle"></span></p>
                <div class="form-floating campos-calificacion" style="display: none;">
                    <textarea class="form-control" id="Observaciones" placeholder="Observaciones" name="#" required></textarea>
                    <label for="">Observacion</label>
                    <div>
                        <label for="">Calificación</label>
                        <input type="text" id="calificacion" name="calificacion" class="form-control" required>
                    </div>
                </div>
                <br>
            </div>
            <div><label for="">Linea de investigacion</label>
            <input type="text" name='linea_invs' onchange="validarCampos()" class='form-control' value = "{{$propuestaAnterior->linea_invs}}" required>
            <div class="form-floating campos-calificacion" style="display: none;">
                <textarea class="form-control" id="Observaciones" placeholder="Observaciones" name="#" required></textarea>
                <label for="">Observacion</label>
                <div>
                    <label for="">Calificación</label>
                    <input type="text" id="calificacion" name="calificacion" class="form-control" required>
                </div>
            </div>
            <br>
            <div class="form-floating">
                <textarea class="form-control" onchange="validarCampos()" id="descriptionPropuestaId" oninput="limitarLongitud( this.id, 600, 'DescripcionContador' )" placeholder="Leave a comment here" name="desc_problema" required>{{$propuestaAnterior->desc_problema}}</textarea>
                <label for="">Descripción del problema</label>
                <p>Longitud máxima: <span id="DescripcionContador"></span></p>
                <div class="form-floating campos-calificacion" style="display: none;">
                    <textarea class="form-control" id="Observaciones" placeholder="Observaciones" name="#" required></textarea>
                    <label for="">Observacion</label>
                    <div>
                        <label for="">Calificación</label>
                        <input type="text" id="calificacion" name="calificacion" class="form-control" required>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-floating">
                <textarea class="form-control" onchange="validarCampos()" id="objectiveGeneralId" placeholder="Leave a comment here" oninput="limitarLongitud( this.id, 25, 'ObjetivoGeneralContador' )" name="obj_general" required>{{$propuestaAnterior->obj_general}}</textarea>
                <label for="">Objetivo general</label>
                <p>Longitud máxima: <span id="ObjetivoGeneralContador"></span></p>
                <div class="form-floating campos-calificacion" style="display: none;">
                    <textarea class="form-control" id="Observaciones" placeholder="Observaciones" name="#" required></textarea>
                    <label for="">Observacion</label>
                    <div>
                        <label for="">Calificación</label>
                        <input type="text" id="calificacion" name="calificacion" class="form-control" required>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-floating">
                <textarea class="form-control" onchange="validarCampos()" placeholder="Leave a comment here" name="obj_especificos" required>{{$propuestaAnterior->obj_especificos}}</textarea>
                <label for="">Objetivos específicos</label>
<div class="form-floating campos-calificacion" style="display: none;">
    <textarea class="form-control" id="Observaciones" placeholder="Observaciones" name="#" required></textarea>
    <label for="">Observacion</label>
    <div>
        <label for="">Calificación</label>
        <input type="text" id="calificacion" name="calificacion" class="form-control" required>
    </div>
</div>
            <br>
            <button id="buttonToCreatePropuesta" Class="btn" style="background:#003E65; color:#fff">Agregar</button>

        </form>
        </p>
    </div>
</div>

@section('js')
<script>
    const mostrarCamposCalificacion = () => {
        const camposCalificacion = document.querySelectorAll('.campos-calificacion');

        camposCalificacion.forEach(campos => {
            campos.style.display = 'block';
        });
    }

    const limitarLongitud = (id, longitud, contadorId) => {
        const input = document.getElementById( id );
        const contador = document.getElementById( contadorId );

        if( input.value.length <= 0 ){
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

        }else if(palabras.length <= maxPalabras){
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
            }else{
                camposVacios = false;
            }
        });

        const button = document.getElementById('buttonToCreatePropuesta');
        button.disabled = camposVacios;
    }

    window.addEventListener('load', validarCampos);

    document.addEventListener('DOMContentLoaded', function() {
        const buttonCalificar = document.getElementById('calificar');

        buttonCalificar.addEventListener('click', function() {
            mostrarCamposCalificacion();
        });
    });

</script>
@endsection
@stop
