<h5 class="card-title text-center">Calificar anteproyecto</h5>
<div class='card-body'>
    <p class="card-text">
    <section id="cont-calf">

        <input type="hidden" value="{{ $array['anteproyecto']->idAnteproyecto }}" name='idFase'>
        @php
            $subItems = [
                'Titulo' => [
                    '1.1 El título es coherente y adecuado con el contenido del Proyecto',
                    '1.2 Contiene el qué, para qué y cómo',
                ],
                'Introducción' => [
                    '2.1 Se ha hecho un análisis profundo sobre el tema, basado en información pertinente',
                    '2.2 Se ha identificado y planteado el problema (o hipótesis) claramente',
                    '2.3 Los objetivos están visiblemente presentados en la introducción',
                    '2.4 Los objetivos guardan relación de correspondencia con el título, metodología y resultados esperados',
                    '2.5 Existe correlación con la fundamentación de las secciones de anteproyecto',
                    '2.6 Las citas referenciadas son adecuadas',
                ],
                'Planteamiento del problema' => [
                    '3.1 Se Describe de manera precisa clara y completa el problema',
                    '3.2 La formulación del problema se hace a modo de pregunta y es coherente con los objetivos',
                    '3.3 El objetivo general tiene una relación clara y consistente con la descripción del problema, y responde al menos ¿Qué se va a hacer?, ¿Cómo? y ¿Para qué?',
                    '3.4 Los objetivos específicos describen el proceso a seguir para lograr el objetivo general. Son alcanzables, medibles y demostrables. Dan respuesta a una o más de las preguntas ¿Cuál será el conocimiento generado si el trabajo se realiza? ¿Qué solución, producto o tecnológica se espera desarrollar?',
                    '3.5 Las citas referenciadas son adecuadas',
                ],
                'Justificación' => [
                    '4.1 La justificación responde a preguntas de ¿Por qué y para qué es necesario este proyecto o investigación? ¿Qué beneficios se obtienen?',
                    '4.2 Es evidente la importancia, utilidad, novedad y aporte a la disciplina',
                    '4.3 Las citas referenciadas son adecuadas',
                ],
                'Marco referencial' => [
                    '5.1 Marco contextual: Presenta el marco contextual acorde con el entorno: macroentorno y microentorno',
                    '5.1.1 Las citas referencias son adecuadas',
                    '5.2 Marco teórico: Presenta el marco teórico, referenciando antecedentes y postulados teóricos',
                    '5.2.1 Las citas referencias son adecuadas',
                    '5.3 Marco legal: Plantea la normatividad que regula el proyecto de investigación de acuerdo al tema',
                    '5.3.1 Las citas referencias son adecuadas',
                    '5.4 Marco conceptual: Conceptualiza de manera técnica los términos propios de la investigación, que requieran ser definidos a partir del proyecto de investigación',
                    '5.4.1 Las citas referencias son adecuadas',
                    '5.5 El estado del arte, tiene coherencia con el proyecto y sus referencias son actuales',
                    '5.5.1 Las citas referencias son adecuadas',
                ],
                'Metodologia' => [
                    '6.1 La línea de investigación es acorde tanto con los lineamientos institucionales como con el proyecto de investigación',
                    '6.2 Hay claridad en el paradigma investigativo respecto a enfoque, tipo y método de investigación.',
                    '6.3 Se define con claridad el universo investigativo: población y muestra de acuerdo al proyecto de investigación',
                    '6.4 Describe las fuentes para la recolección de información que serán utilizadas en el proyecto',
                    '6.5 Propone los/las herramientas de recolección de información que serán utilizadas en el proyecto de investigación',
                    '6.6 Las citas referencias son adecuadas',
                ],
                'Elementos de administración y control' => [
                    '7.1 Describe detalladamente las tareas que se llevarán a cabo durante la ejecución del proyecto.',
                    '7.2 Describe los plazos en que cada actividad deberá completarse.',
                    '7.3 Presenta los recursos físicos y/o Tecnológico, así como también el Talento humano y el presupuesto proyectado
                    para la ejecución del proyecto de investigación, acorde con el cronograma de actividades a desarrollar.',
                ],
                'Normas de presentación en el documento y Referencias bibliográficas' => [
                    '8.1 El texto está bien redactado, con buena ortografía, coherencia y organización',
                    '8.2 Cumple con la aplicación de las normas vigentes de presentación en el documento',
                    '8.3 Las figuras y tablas son de buena calidad y se citan en el documento',
                    '8.4 Hay literatura consultada en un segundo idioma y de los últimos 5 años',
                    '8.5 Las referencias son pertinentes al objeto de investigación',
                    '8.6 Las referencias se citan de acuerdo con la norma APA',
                    '8.7 Las fuentes de consulta son fiables con autor específico y contienen rigor científico. (mínimo 15 referencias)',
                ],
            ]
        @endphp
        @foreach ($subItems as $clave => $valor)
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading{{ str_replace(" ", "", $clave) }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapse{{ str_replace(" ", "", $clave) }}" aria-expanded="false" aria-controls="flush-collapse{{ str_replace(" ", "", $clave) }}">
                            <h5>{{ $clave }}</h5>
                        </button>
                    </h2>

                    <div id="flush-collapse{{ str_replace(" ", "", $clave) }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ str_replace(" ", "", $clave) }}"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body" style="display: block">
                            @component('components.anteproyecto.calificacionObser', [
                                'subItems' => $valor,
                                'nameSelect' => 'tituloCalificacion',
                                'nameTextArea' => 'tituloObservacion',
                                'obsArray' => $array['observaciones'][$jurado][0],
                                'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
                                'styleDisplayGeneral' => 'flex',
                            ])
                            @endcomponent
                        </div>
                    </div>
                </div>
        @endforeach


        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    <h5></h5>
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the
                    <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this
                    being filled with some actual content.</div>
            </div>
        </div>






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
            'nameTextArea' => 'planProbObservacion',
            'obsArray' => $array['observaciones'][$jurado][2],
            'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
            'styleDisplayGeneral' => 'flex',
        ])
        @endcomponent --}}
        {{-- <h5></h5>
        @component('components.anteproyecto.calificacionObser', [
            'nameSelect' => 'justCalificacion',
            'nameTextArea' => 'justObservacion',
            'obsArray' => $array['observaciones'][$jurado][3],
            'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
            'styleDisplayGeneral' => 'flex',
        ])
        @endcomponent
        <h5></h5>
        @component('components.anteproyecto.calificacionObser', [
            'nameSelect' => 'marcRefCalificacion',
            'nameTextArea' => 'marcRefObservacion',
            'obsArray' => $array['observaciones'][$jurado][4],
            'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
            'styleDisplayGeneral' => 'flex',
        ])
        @endcomponent
        <h5></h5>
        @component('components.anteproyecto.calificacionObser', [
            'nameSelect' => 'metodCalificacion',
            'nameTextArea' => 'metodObservacion',
            'obsArray' => $array['observaciones'][$jurado][5],
            'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
            'styleDisplayGeneral' => 'flex',
        ])
        @endcomponent
        <h5></h5>
        @component('components.anteproyecto.calificacionObser', [
            'nameSelect' => 'admCtrCalificacion',
            'nameTextArea' => 'admCtrObservacion',
            'obsArray' => $array['observaciones'][$jurado][6],
            'styleDisplaySpan' => $valRolComite ? 'flex' : 'none',
            'styleDisplayGeneral' => 'flex',
        ])
        @endcomponent
        <h5></h5>
        @component('components.anteproyecto.calificacionObser', [
            'nameSelect' => 'normBibliCalificacion',
            'nameTextArea' => 'normBibliObservacion',
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
