<h5 class="card-title text-center">Calificar anteproyecto</h5>
<div class='card-body'>
    <p class="card-text">
    <section id="cont-calf">

        <input type="hidden" value="{{ $array['anteproyecto']->idAnteproyecto }}" name='idFase'>
        @php
            $contador = 0;
            $jurado
        @endphp
        @foreach ($array['nameItems'] as $clave => $valor)

            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading{{ str_replace(" ", "", $clave) }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapse{{ str_replace(" ", "", $clave) }}" aria-expanded="false" aria-controls="flush-collapse{{ str_replace(" ", "", $clave) }}">
                            <h5>{{ $clave }}</h5>
                        </button><br>
                        <div class="input-group mb-3 campos-calificacion" style="display: flex; padding: 15px">
                            <textarea class="form-control auto-expand" id="Observaciones" placeholder="Observaciones" name="{{ 'obs'.$contador }}">
                                {{$array['observaciones'][$jurado][$contador][0]}}
                            </textarea>
                            <span class="input-group-text" id="basic-addon2" style="display: flex">
                                <p>{{$array['observaciones'][$jurado][$contador][1]}}</p>
                            </span>

                            <input type="hidden" name="{{ 'canti'.$contador }}" value="{{count($valor)}}">
                        </div>
                    </h2><br>

                    <div id="flush-collapse{{ str_replace(" ", "", $clave) }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ str_replace(" ", "", $clave) }}"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body" style="display: block">

                            @component('components.anteproyecto.calificacionObser', [
                                'subItems' => $valor,
                                'item' => str_replace(" ", "", $clave),
                                'jurado' => $jurado,
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


        {{-- @component('components.anteproyecto.calificacionObser', [
            'nameSelect' => 'tituloCalificacion',
            'nameTextArea' => 'tituloObservacion',
            'obsArray' => $array['observaciones'][$jurado][0],
            'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
            'styleDisplayGeneral' => 'flex',
        ])
        @endcomponent --}}
        {{-- <h5></h5>
        @component('components.anteproyecto.calificacionObser', [
            'nameSelect' => 'planProbCalificacion',
            'nameTextArea' => ,
            'obsArray' => $array['observaciones'][$jurado][2],
            'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
            'styleDisplayGeneral' => 'flex',
        ])
        @endcomponent --}}
        {{-- <h5></h5>
        @component('components.anteproyecto.calificacionObser', [
            'nameSelect' => 'justCalificacion',
            'nameTextArea' => ,
            'obsArray' => $array['observaciones'][$jurado][3],
            'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
            'styleDisplayGeneral' => 'flex',
        ])
        @endcomponent
        <h5></h5>
        @component('components.anteproyecto.calificacionObser', [
            'nameSelect' => 'marcRefCalificacion',
            'nameTextArea' => ,
            'obsArray' => $array['observaciones'][$jurado][4],
            'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
            'styleDisplayGeneral' => 'flex',
        ])
        @endcomponent
        <h5></h5>
        @component('components.anteproyecto.calificacionObser', [
            'nameSelect' => 'metodCalificacion',
            'nameTextArea' => ,
            'obsArray' => $array['observaciones'][$jurado][5],
            'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
            'styleDisplayGeneral' => 'flex',
        ])
        @endcomponent
        <h5></h5>
        @component('components.anteproyecto.calificacionObser', [
            'nameSelect' => 'admCtrCalificacion',
            'nameTextArea' => ,
            'obsArray' => $array['observaciones'][$jurado][6],
            'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
            'styleDisplayGeneral' => 'flex',
        ])
        @endcomponent
        <h5></h5>
        @component('components.anteproyecto.calificacionObser', [
            'nameSelect' => 'normBibliCalificacion',
            'nameTextArea' =>
            'obsArray' => $array['observaciones'][$jurado][7],
            'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
            'styleDisplayGeneral' => 'flex',
        ])
        @endcomponent --}}

        <br>
        <div class="mb-3">
            <button id="buttonEnviarCalificacion" formaction="{{ route('observaciones.store', 'anteproyecto') }}"
                class="btn" style="background:#003E65; color:#fff">Enviar
                calificación</button>
        </div>

    </section>
    </p>
</div>
