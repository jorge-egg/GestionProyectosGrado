<h5 class="card-title text-center">Calificar anteproyecto</h5>

<div class='card-body'>
    <p class="card-text">
    <section id="cont-calf">

        <input type="hidden" value="{{ $idFase }}" name='idFase'>


@php
    $calificacion = 0.0;
    foreach ($array['observaciones'][$jurado] as $calif ) {
        $calificacion += round($calif[1], 2);
    }
@endphp

        <br>
        <h4 style="display: inline"><b>Estado: </b></h4><p style="display: inline" class="mostrar-estado">{{$jurado == 0 ? $array['anteproyecto']->estadoJUno : $array['anteproyecto']->estadoJDos}}</p><br>
        <h4 style="display: inline"><b>Calificación: </b></h4><p style="display: inline" class="mostrar-calif">{{$calificacion}}</p>
        <br>
        <br>
        @php
            $contador = 0;
            $jurado;
        @endphp
        @foreach ($array['nameItems'] as $clave => $valor)
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading{{ str_replace(' ', '', $clave) }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapse{{ str_replace(' ', '', $clave) }}" aria-expanded="false"
                            aria-controls="flush-collapse{{ str_replace(' ', '', $clave) }}">
                            <h5>{{ $clave }}</h5>
                        </button><br>
                        @php

                            $estadoJurado = 'espera';
                            if ($jurado == 0) {
                                $estadoJurado = $array['anteproyecto']->estadoJUno;
                            }else if($jurado == 1){
                                $estadoJurado = $array['anteproyecto']->estadoJDos;
                            }
                        @endphp
                        <div class="input-group mb-3 campos-calificacion" style="display: flex; padding: 15px">
                            <textarea class="form-control auto-expand" id="Observaciones" placeholder="Observaciones" name="{{ 'obs' . $contador }}"
                                {{ $array['anteproyecto']->juradoDos == App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento || $array['anteproyecto']->juradoUno == App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento ? '' : 'disabled' }}
                                {{ $array['observaciones'][$jurado][$contador][0] == '' || $estadoJurado == 'Aplazado con modificaciones' || $estadoJurado == 'Rechazado' ? '' : 'disabled' }}>
                                {{ $array['observaciones'][$jurado][$contador][0] }}
                            </textarea>

                            <span class="input-group-text" id="basic-addon2" style="display: flex">
                                <p class="pCalif-{{ $contador }}">
                                    {{ round($array['observaciones'][$jurado][$contador][1], 3) }}</p>
                            </span>

                            <input type="hidden" name="{{ 'canti' . $contador }}" value="{{ count($valor[0]) }}">
                        </div>
                    </h2><br>






                    <div id="flush-collapse{{ str_replace(' ', '', $clave) }}" class="accordion-collapse collapse"
                        aria-labelledby="flush-heading{{ str_replace(' ', '', $clave) }}"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body" style="display: block">




                            @php
                                $contador2 = 0;
                                $ponderado = null;
                                //dd($valor[1]);
                                //dd($itemId);
                                foreach ($array['observaciones'][2] as $item) {
                                    if ($item->item_pond == $valor[1]) {
                                        $ponderado = $item->ponderado;
                                        $ponderadoSub = $ponderado / count($valor[0]);
                                    }
                                }

                                $array2 = [];
                                //dd($ponderadoSub);
                                if (isset($array['observaciones'][$jurado][$contador][2][0])) {
                                    foreach ($array['observaciones'][$jurado][$contador][2] as $key) {
                                        array_push($array2, $key->valor);
                                    }
                                    //dd($array.'2');
                                } else {
                                    //dd($valor);

                                    for ($i = 0; $i < count($valor[0]); $i++) {
                                        array_push($array2, 'no');
                                    }
                                }

                            @endphp
                            <p class="ponderadoSub" style="display: none;">{{ $ponderadoSub }}</p>
                            <p class="cantSubItems" style="display: none;">{{ count($valor[0]) }}</p>

                            @foreach ($valor[0] as $subItem)
                                <div class="input-group mb-3 campos-calificacion" style="display: flex">
                                    <p class="form-control auto-expand">

                                        {{ $subItem->SubItem }}

                                    </p>

                                    <span class="input-group-text" id="basic-addon2" style="display: flex">

                                        <select class="form-select {{ $contador }}" id="{{ $contador2 + 1 }}"
                                            aria-label="Default select example" name="{{ $subItem->codigo . $jurado }}"
                                            {{ $array['anteproyecto']->juradoDos == App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento || $array['anteproyecto']->juradoUno == App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento ? '' : 'disabled' }}>

                                            <option value="si" {{ $array2[$contador2] == 'si' ? 'selected' : '' }}>
                                                Si
                                            </option>

                                            <option value="parcial"
                                                {{ $array2[$contador2] == 'parcial' ? 'selected' : '' }}>Parcial
                                            </option>

                                            <option value="no" {{ $array2[$contador2] == 'no' ? 'selected' : '' }}>
                                                No
                                            </option>
                                        </select>
                                    </span>

                                </div>

                                @php
                                    $contador2++;
                                @endphp
                            @endforeach

                        </div>
                    </div>
                </div>
                @php
                    $contador++;
                @endphp
        @endforeach

        <br>
        @can('anteproyecto.calificar')
            @if (
                $array['anteproyecto']->juradoDos ==
                    App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento ||
                    $array['anteproyecto']->juradoUno ==
                        App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento)
                <div class="mb-3">
                    <button id="buttonEnviarCalificacion" formaction="{{ route('observaciones.store', $fase) }}"
                        class="btn" style="background:#003E65; color:#fff; display:{{($estadoJurado == 'Aplazado con modificaciones' || $estadoJurado == 'Pendiente') && $array['anteproyecto']->aprobacionDocen == 2 ? 'block': 'none'}}">Enviar
                        calificación</button>
                </div>
                <div class="mb-3">
                    <input type="hidden" value="{{$fase}}" name="fase">
                    <input type="hidden" value="{{$fase == "anteproyecto" ? $array['anteproyecto']->ante_proy : ($fase == "proyFinal" ? $array['anteproyecto']->pfin_proy : null)}}" name="idProyecto">
                    <button id="buttonEnviarCalificacion" formaction="{{ route('observaciones.update') }}"
                        class="btn" style="background:#003E65; color:#fff; display:{{$array['anteproyecto']->estado =='Verificar' && $array['anteproyecto']->aprobacionDocen == 2 && $estadoJurado == 'Rechazado' ? 'block': 'none'}}">Actualizar</button>
                </div>
            @endif

        @endcan


    </section>
    </p>
</div>


<script>
    let array5 = [];
    let array3 = [];
    var ponderadoSub = document.querySelectorAll('.ponderadoSub').forEach(function(p) {
        array3.push(Number(p.textContent));
    });

    console.log(array3);
    const pCalif = document.querySelectorAll('.pCalif').forEach(function(input) {

        array5.push(Number(input.textContent));

    });

    // califSelect es un diccionario que almacenara cada uno de los valores de los select de calificaciones con la idea de con cada cambio del select, este se guarde en el array y recalcule
    var califSelect = [];
    var cantItems = array3.length;
    var cantSubItems = document.querySelectorAll('.cantSubItems');

    cantSubItems.forEach(cantSubItem => {
        // Mueve la declaración de incrementador aquí para evitar que se reinicie en cada iteración del bucle forEach
        let incrementador = 1;

        // Agrega una nueva entrada al array califSelect
        califSelect.push([]);

        // Bucle para agregar "no" al array recién agregado según el contenido de cantSubItem
        for (let i = 0; i < parseInt(cantSubItem.textContent); i++) {
            califSelect[califSelect.length - 1].push("no");
        }
        califSelect[califSelect.length - 1].push(0.0);
        // Incrementa el incrementador aquí para que se incremente una vez por cada iteración del bucle forEach
        incrementador++;
    });

    console.log(califSelect);


    document.addEventListener("DOMContentLoaded", function() {


        const selects = document.querySelectorAll('.form-select');

        // Asocia el evento change a cada select
        selects.forEach(select => {
            select.addEventListener('change', handleSelectChange);
        });


        function handleSelectChange(event) {

            // Obtiene el select que lanzó el evento
            const selectElement = event.target;

            // Obtiene el data-id del select
            let selectClass1 = selectElement.classList[1];
            let selectClass2 = event.target.id;

            // Obtiene el valor seleccionado y lo convierte a número
            const selectedValue = selectElement.value;

            console.log(selectClass2);




            califSelect[selectClass1][selectClass2 - 1] = selectedValue;

            var array = recalcularCalif(selectClass1, (selectClass2 - 1), califSelect);

            var calificacionCalc = 0.0;

            array.forEach(element => {
                calificacionCalc += element[element.length - 1];
            });


            var mostrarCalif = document.querySelectorAll('.mostrar-calif').forEach(function(calif){
                calif.textContent = calificacionCalc.toFixed(2);
            });

            var mostrarEstado = document.querySelectorAll('.mostrar-estado').forEach(function(estado){
                if(calificacionCalc >= 3.50){
                    estado.textContent = 'Aprobado';
                }else if(calificacionCalc >= 3 && calificacionCalc < 3.50){
                    estado.textContent = 'Aplazado con modificaciones';
                }else{
                    estado.textContent = 'Rechazado';
                }

            });


        }


        function recalcularCalif(posicion1, posicion2, array) {
            var valorTotal = 0.0;
            let valores = array[posicion1];
            var si = array3[posicion1];
            var parcial = array3[posicion1] / 2;
            var no = 0;

            valores.forEach(element => {
                if (element == 'si') {
                    valorTotal += si;
                } else if (element == 'parcial') {
                    valorTotal += parcial;
                } else if (element == 'no') {
                    valorTotal += no;
                }
            });
            //console.log(posicion1 + ' ' + (array[posicion1].length) - 1);


            array[posicion1][array[posicion1].length - 1] = valorTotal;


            // Selecciona el elemento <p> que tiene ambas clases
            let pCalif = document.querySelectorAll('.pCalif-' + posicion1).forEach(function(input) {

                // Verifica si el elemento fue encontrado
                if (input) {
                    // Asigna un nuevo valor al elemento
                    input.textContent = (array[posicion1][array[posicion1].length - 1]).toFixed(1);
                } else {
                    console.log('El elemento no fue encontrado.');
                }

            });
            //let pCalif = document.querySelectorAll('.pCalif-' + posicion1);


            console.log(array);
            return array;
        }

    });
</script>
