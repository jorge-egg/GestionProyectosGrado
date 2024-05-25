
<h5 class="card-title text-center">Calificar anteproyecto</h5>
<div class='card-body'>
    <p class="card-text">
    <section id="cont-calf">

        <input type="text" value="{{ $idFase }}" name='idFase'>
        @php
            $contador = 0;
            $jurado
        @endphp
        @foreach ($array['nameItems'] as $clave => $valor)
            @php
                $g = count($valor);
            @endphp
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading{{ str_replace(" ", "", $clave) }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapse{{ str_replace(" ", "", $clave) }}" aria-expanded="false" aria-controls="flush-collapse{{ str_replace(" ", "", $clave) }}">
                            <h5>{{ $clave }}</h5>
                        </button><br>
                        <div class="input-group mb-3 campos-calificacion" style="display: flex; padding: 15px">
                            <textarea class="form-control auto-expand" id="Observaciones" placeholder="Observaciones" name="{{ 'obs'.$contador }}" {{$array['anteproyecto']->juradoDos == App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento || $array['anteproyecto']->juradoUno == App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento ? '' : 'disabled'}} {{$array['observaciones'][$jurado][$contador][0] == '' ? '': 'disabled'}}>
                                {{$array['observaciones'][$jurado][$contador][0]}}
                            </textarea>

                            <span class="input-group-text" id="basic-addon2" style="display: flex">
                                <p class="pCalif">{{round($array['observaciones'][$jurado][$contador][1], 3)}}</p>
                            </span>

                            <input type="hidden" name="{{ 'canti'.$contador }}" value="{{count($valor)}}">
                        </div>
                    </h2><br>






                    <div id="flush-collapse{{ str_replace(" ", "", $clave) }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ str_replace(" ", "", $clave) }}"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body" style="display: block">

                            @component('components.anteproyecto.calificacionObser', [
                                'idJurado' => $array,
                                'subItems' => $valor,
                                'longitud' => $g,
                                'jurado' => $jurado,
                                'valSelects' => $array['observaciones'][$jurado][$contador],
                                'itemId' => $array['observaciones'][2],
                                'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
                                'styleDisplayGeneral' => 'flex',
                            ])
                            @endcomponent
                        </div>
                    </div>
                </div>
                @php
                    $contador++;
                @endphp

        @endforeach

        <br>
        @can('anteproyecto.calificar')
        @if ($array['anteproyecto']->juradoDos == App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento || $array['anteproyecto']->juradoUno == App\Models\UsuariosUser::where('usua_users', auth()->id())->whereNull('deleted_at')->first()->numeroDocumento)
        <div class="mb-3">
            <button id="buttonEnviarCalificacion" formaction="{{ route('observaciones.store', $fase) }}"
                class="btn" style="background:#003E65; color:#fff">Enviar
                calificación</button>
        </div>
        @endif

        @endcan


    </section>
    </p>
</div>


<script>
    let array5 = [];

    var array1 =  {!! json_encode($array['observaciones'][$jurado][0]) !!};

    console.log(array1);
    const pCalif = document.querySelectorAll('.pCalif').forEach(function(input){

        array5.push(Number(input.textContent));

    });


</script>

