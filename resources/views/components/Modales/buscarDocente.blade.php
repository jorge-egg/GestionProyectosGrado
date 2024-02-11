
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Docentes</h5>
                <a href="{{ url()->previous() }}" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Docente</th>
                            <th scope="col">Sede</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $contador = 0;
                        @endphp
                        @foreach ($docentes as $docente)
                            @php
                                $contador++;
                            @endphp
                            <tr>
                                <form method="post">
                                    @csrf
                                    <input type="hidden" value={{ $idProyecto }} name="idProyecto">
                                    <input type="hidden" value={{ $docente->numeroDocumento }}
                                        name="numeroDocumento">
                                    <th scope="row">{{ $contador }}</th>
                                    <td>{{ $docente->nombre . ' ' . $docente->apellido }}</td>
                                    <td>{{ $docente->sede }}</td>
                                    <td><button formaction="{{ route('anteproyecto.asigDocente') }}" type="submit"><i class="bi bi-person-fill-add"></i></button></td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="{{ url()->previous() }}" class="btn btn-secondary text-dark" data-dismiss="modal">Cerrar</a>
            </div>
        </div>
    </div>

