<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Docentes</h5>
            <a href="{{ url()->previous() }}" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
        </div>
        <div class="modal-body">
            <h3><b>DIR = Director del proyecto</b></h3>
            <h3><b>AP = Anteproyecto</b></h3>
            <h3><b>PF = Proyecto final</b></h3>
            <div class="accordion" id="accordionExample">
                @php
                    $programas = App\Models\SedePrograma::all();
                @endphp

                @foreach ($programas as $programa)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $programa->idPrograma }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $programa->idPrograma }}" aria-expanded="false"
                                aria-controls="collapse{{ $programa->idPrograma }}">
                                {{ $programa->programa }}
                            </button>
                        </h2>
                        <div id="collapse{{ $programa->idPrograma }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $programa->idPrograma }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Docente</th>
                                            <th scope="col">Sede</th>
                                            <th scope="col">DIR</th>
                                            <th scope="col">AP</th>
                                            <th scope="col">PF</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $contador = 0;
                                        @endphp

                                        @foreach ($docentes as $docente)
                                            @if ($programa->idPrograma == $docente->programa)
                                                @php
                                                    $contador++;
                                                @endphp
                                                <tr>
                                                    <form method="post">
                                                        @csrf
                                                        <input type="hidden" value={{ $idProyecto }}
                                                            name="idProyecto">
                                                        <input type="hidden" value={{ $docente->numeroDocumento }}
                                                            name="numeroDocumento">
                                                        <th scope="row">{{ $contador }}</th>



                                                        <td>{{ $docente->nombre . ' ' . $docente->apellido }}</td>



                                                        <td>{{ $docente->sede }}</td>



                                                        <!--numero de Director de proyectos-->
                                                        <td>{{ App\Models\SedeProyectosGrado::where('docente', $docente->numeroDocumento)
                                                            ->count()
                                                        }}</td>



                                                        <!--numero de Anteproyeto commo jurados-->
                                                        <td>{{ App\Models\FaseAnteproyecto::where('juradoUno', $docente->numeroDocumento)
                                                            ->orWhere('juradoDos', $docente->numeroDocumento)
                                                            ->count()
                                                        }}</td>



                                                        <!--numero de Proyecto final commo jurados-->
                                                        <td>{{ App\Models\FaseProyectosfinale::where('juradoUno', $docente->numeroDocumento)
                                                            ->orWhere('juradoDos', $docente->numeroDocumento)
                                                            ->count()
                                                        }}</td>



                                                        <td>
                                                            @if ($fase == 'propuesta')
                                                                <button
                                                                    formaction="{{ route('propuesta.asigDocente') }}"
                                                                    type="submit"><i
                                                                        class="bi bi-person-fill-add"></i></button>
                                                            @endif
                                                            @if ($fase == 'anteproyecto')
                                                                <input type="hidden" class="JIdentificador" name="JIdentificador">
                                                                <button
                                                                    formaction="{{ route('anteproyecto.asigJurado') }}"
                                                                    type="submit"><i
                                                                        class="bi bi-person-fill-add"></i></button>
                                                            @endif
                                                            @if ($fase == 'proFinal')
                                                                <input type="text" class="JIdentificador" name="JIdentificador">
                                                                <button
                                                                    formaction="{{ route('proyectoFinal.asigJurado') }}"
                                                                    type="submit"><i
                                                                        class="bi bi-person-fill-add"></i></button>
                                                            @endif
                                                        </td>
                                                    </form>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
        <div class="modal-footer">
            <a href="{{ url()->previous() }}" class="btn btn-secondary text-dark" data-dismiss="modal">Cerrar</a>
        </div>
    </div>
</div>
