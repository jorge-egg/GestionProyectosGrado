@extends('dashboard')
@section('estilos_adicionales')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"
        rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel='stylesheet'>
@endsection
@section('dashboard_content')

    <h1>Proyectos</h1>

    <div class="alert alert-info" role="alert">
        <span style="color: rgb(0, 105, 0);">■</span> Aprobado &nbsp;&nbsp;
        <span style="color: rgb(135, 0, 0);">■</span> Rechazado &nbsp;&nbsp;
        <span style="color: rgb(171, 171, 0);">■</span> Aplazado &nbsp;&nbsp;
        <span style="color: rgb(0, 0, 89);">■</span> Pendiente
    </div>

    <table class="table table-hover shadow-lg mt-4" style="width:100%" id='table-js'>
        <thead>
            <tr>
                <th scope="col">estado</th>
                <th scope="col">codigo proyecto</th>
                {{-- <th scope="col">integrantes</th> --}}
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @php
                $idProyectos = [];
            @endphp
            @foreach ($proyectos as $proyecto)
                @php
                    $idProyecto = $proyecto->idProyecto;
                @endphp
                @if (!in_Array($idProyecto, $idProyectos))
                    @php
                        array_push($idProyectos, $idProyecto);
                    @endphp

                    <tr>
                        <td>
                            @if ($proyecto->estado)
                                Activo
                            @else
                                Finalizado
                            @endif
                        </td>
                        <td>{{ $proyecto->codigoproyecto }}</td>
                        {{-- <td>
                        @foreach ($proyecto->integrantes as $key => $integrante)
                            {{ $key > 0 ? ', ' : '' }}
                            {{ $integrante->usuarios_user->nombre }} {{ $integrante->usuarios_user->apellido }}
                        @endforeach
                    </td> --}}
                        <td>
                            <form action="{{ route('propuesta.create', $proyecto->idProyecto) }}" method="get">

                                <button type="submit" class='btn btn-primary text-dark'>Propuesta</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('anteproyecto.create', $proyecto->idProyecto) }}" method="get">
                                {{-- @csrf --}}
                                {{-- <input type="hidden" name="idProyecto" id="idProyecto" value="{{ $proyecto->idProyecto }}"> --}}
                                <button type="submit" class="btn"
                                    style="background:#003E65; color:#fff">Anteproyecto</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('proyectoFinal.create', $proyecto->idProyecto) }}" method="get">
                                <button type="submit" class="btn" style="background:#003E65; color:#fff">Proyecto
                                    final</button>
                            </form>
                        </td>
                        <td>
                            <form action="#">
                                @csrf
                                <input type="hidden" name="idProyecto" id="idProyecto" value="{{ $proyecto->idProyecto }}">
                                <button type="submit" class="btn" style="background:#003E65; color:#fff"
                                    data-bs-toggle="modal" data-bs-target="#SustentacionModal"
                                    onclick="obtenerNombre()">Sustentación</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach

        </tbody>
    </table>

    <div class="modal fade" id="SustentacionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Sustentación</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    Jurado 1: <p id="juradoUno"></p><br>
                    Jurado 2: <p id="juradoDos"></p><br>
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="idProyectoSus" id="idProyectoSus">
                        <section class="text-center mt-2">
                            <button class="btn btn-danger" formaction="{{route('sustentacion.store.rechazado')}}">Rechazado</button>
                            <button class="btn btn-info" formaction="{{route('sustentacion.store.aprobado')}}">Aprobado</button>
                            <div class="mb-3 mt-2">
                                <label for="soporte" class="form-label">Carge el documento de soporte sustentación</label>
                                <input class="form-control @error('soporte') is-invalid @enderror" type="file" name='soporte'
                                    id="soporte" required>
                            </div>
                            @error('soporte')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </section>
                    </form>
                </div>
                <div class="modal-footer text-center" style="background: #003E65; margin: 0 auto">
                    <b><h1 id="estadoH2" style="color: rgb(255, 255, 255)"></h1></b>
                </div>
            </div>
        </div>
    </div>
@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        function obtenerNombre() {

            // var nombreUsuario = document.getElementById(
            //     'nombreUsuario'); //etiqueta <p></p> donde se va a mostrar el nombre del usuario buscado en el modal

            var codProyecto = document.getElementById(
                'idProyecto').value; //etiqueta <p></p> donde se va a mostrar el codigo del usuario buscado en el modal

            var nombreJUno = document.getElementById('juradoUno');
            var nombreJDos = document.getElementById('juradoDos');
            var estadoH2 = document.getElementById('estadoH2');
            var idProyectoSus = document.getElementById('idProyectoSus');
            idProyectoSus
            $.ajax({
                url: "{{ route('sustentacion.consultar') }}",
                type: 'get',
                data: {
                    idProyecto: codProyecto
                },
                dataType: 'json',
                success: function(response) {
                    nombreJUno.textContent = response.juradoUno;
                    nombreJDos.textContent = response.juradoDos;
                    idProyectoSus.value = response.data.idSustentacion;
                    estadoH2.textContent = response.data.estado
                },
                error: function() {
                    alert('Hubo un error obteniendo los datos!');
                }
            });
        }
    </script>
@endsection
<script>
    let table = new DataTable('#proy');
</script>
@stop
