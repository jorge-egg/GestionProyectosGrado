@extends('dashboard')
@section('dashboard_content')
<div class="card">
    <h5 class="card-title text-center">Crear propuesta</h5>
    <br>
    <div class='card-body'>
        <p class="card-text">
        <form action="{{route('propuesta.store')}}" method='POST'>
        @csrf
        <div><label for="">titulo</label>
            <input type="text" name='Titulo' id="titleForPropuestaId" oninput="limitarLongitud( this.id, 18, 'contadorTitle' )" class='form-control' required>
            <p>Longitud máxima: <span id="contadorTitle"></span></p>
            </div>
            <div><label for="">Linea de investigacion</label>
            <input type="text" name='linea_invs' class='form-control' required>
            </div>
            <br>
            <div class="form-floating">
                <textarea class="form-control" id="descriptionPropuestaId" oninput="limitarLongitud( this.id, 600, 'DescripcionContador' )" placeholder="Leave a comment here" name="desc_problema" required></textarea>
                <label for="">Descripción del problema</label>
                <p>Longitud máxima: <span id="DescripcionContador"></span></p>
            </div>
            <br>
            <div class="form-floating">
                <textarea class="form-control" id="objectiveGeneralId" placeholder="Leave a comment here" oninput="limitarLongitud( this.id, 25, 'ObjetivoGeneralContador' )" name="obj_general" required></textarea>
                <label for="">Objetivo general</label>
                <p>Longitud máxima: <span id="ObjetivoGeneralContador"></span></p>
            </div>
            <br>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="obj_especificos" required></textarea>
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
            <button Class='btn btn-primary text-dark'>Agregar</button>
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
            palabras.pop();
            input.value = palabras.join(' ');
        }

        contador.textContent = palabras.length;
    }
</script>
@endsection
@stop
