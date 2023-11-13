@extends('dashboard')
@section('dashboard_content')

<div class="card">
    <h5 class="card-title text-center">Crear propuesta</h5>
    <div class='card-body'>
        <p class="card-text">
            <button id="buttonToCreatePropuesta" Class='btn btn-primary'>Calificar</button>
        <form action="{{route('propuesta.store')}}" method='POST'>
        @csrf
        <input type="hidden" value="{{ $idProyecto }}" name="idProyecto">
            <div>
                <label for="">Titulo</label>
                <input type="text" name='titulo' onchange="validarCampos()" id="titleForPropuestaId" oninput="limitarLongitud( this.id, 25, 'contadorTitle' )" class='form-control' value = "{{$propuestaAnterior->titulo}}" required >
                <p>Longitud máxima: <span id="contadorTitle"></span></p>
                <div class="form-floating">
                    <textarea class="form-control" id="observacionesTxt" placeholder="Obsevaciones" name="desc_problema" required></textarea>
                </div>
            </div>
            <div><label for="">Linea de investigacion</label>
            <input type="text" name='linea_invs' onchange="validarCampos()" class='form-control' value = "{{$propuestaAnterior->linea_invs}}" required>
            </div>
            <br>
            <div class="form-floating">
                <textarea class="form-control" onchange="validarCampos()" id="descriptionPropuestaId" oninput="limitarLongitud( this.id, 600, 'DescripcionContador' )" placeholder="Leave a comment here" name="desc_problema" required>{{$propuestaAnterior->desc_problema}}</textarea>
                <label for="">Descripción del problema</label>
                <p>Longitud máxima: <span id="DescripcionContador"></span></p>
            </div>
            <br>
            <div class="form-floating">
                <textarea class="form-control" onchange="validarCampos()" id="objectiveGeneralId" placeholder="Leave a comment here" oninput="limitarLongitud( this.id, 25, 'ObjetivoGeneralContador' )" name="obj_general" required>{{$propuestaAnterior->obj_general}}</textarea>
                <label for="">Objetivo general</label>
                <p>Longitud máxima: <span id="ObjetivoGeneralContador"></span></p>
            </div>
            <br>
            <div class="form-floating">
                <textarea class="form-control" onchange="validarCampos()" placeholder="Leave a comment here" name="obj_especificos" required>{{$propuestaAnterior->obj_especificos}}</textarea>
                <label for="">Objetivos específicos</label>
            </div>
            <!-- <br>
            <div><label for="">estado</label>
            <input type="text" name='estado' class='form-control' required>
            </div>
            <div><label for="">Fecha de cierre</label>
            <input type="date" name='fecha_cierre' class='form-control' required>
            </div>
            <div><label for="">prop_fase</label>
            <input type="text" name='prop_fase' class='form-control' required>
            </div> -->
            <br>
            <button id="buttonToCreatePropuesta" Class="btn" style="background:#003E65; color:#fff">Agregar</button>

        </form>
        </p>
    </div>
</div>

@section('js')
<script>

    const limitarLongitud = ( id, longitud, contadorId ) => {
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

</script>
@endsection
@stop
