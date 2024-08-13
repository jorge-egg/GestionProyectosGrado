
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
        <h4 style="display: inline"><b>Estado: </b></h4><p style="display: inline" class="mostrar-estado">{{$jurado == 0 ? $array['anteproyecto']->estadoJUno : $array['anteproyecto']->estadoJDos}}</p><br>
        <h4 style="display: inline"><b>Calificación: </b></h4><p style="display: inline" class="mostrar-calif">{{$calificacion}}</p>
        <br><br>
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
                    <button id="buttonActualizar" formaction="{{ route('observaciones.update') }}"
                        class="btn" style="background:#003E65; color:#fff; display:{{$array['anteproyecto']->estado =='Verificar' && $array['anteproyecto']->aprobacionDocen == 2 && $estadoJurado == 'Rechazado' ? 'block': 'none'}}">Actualizar</button>
                </div>
            @endif

        @endcan


    </section>
    </p>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-outline-success",
                cancelButton: "btn btn-outline-danger"
            },
            buttonsStyling: false
        });


        const buttons = document.querySelectorAll("#buttonEnviarCalificacion, #buttonActualizar");

        buttons.forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();

                const formaction = button.getAttribute('formaction');

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
                        // Crear y enviar un formulario con los datos necesarios
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = formaction;

                        // Agregar campos ocultos para el envío
                        const inputs = document.querySelectorAll("input[type='hidden']");
                        inputs.forEach(input => {
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = input.name;
                            hiddenInput.value = input.value;
                            form.appendChild(hiddenInput);
                        });

                        // Agregar campos de texto y select
                        const textareas = document.querySelectorAll("textarea");
                        const selects = document.querySelectorAll("select");
                        textareas.forEach(textarea => {
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = textarea.name;
                            hiddenInput.value = textarea.value;
                            form.appendChild(hiddenInput);
                        });
                        selects.forEach(select => {
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = select.name;
                            hiddenInput.value = select.value;
                            form.appendChild(hiddenInput);
                        });

                        document.body.appendChild(form);

                        // Mostrar alerta de éxito después de enviar el formulario
                        swalWithBootstrapButtons.fire({
                            title: "Enviado con éxito!",
                            text: "Tu acción ha sido completada con éxito",
                            icon: "success"
                        }).then(() => {
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
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('js/califAntFinal.js')}}"></script>
