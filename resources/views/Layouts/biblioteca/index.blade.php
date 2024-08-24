@extends('dashboard')
@section('estilos_adicionales')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"
        rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel='stylesheet'>
@endsection
@section('dashboard_content')

    <h1>Biblioteca de proyectos</h1>

    <table class="table table-hover shadow-lg mt-4" style="width:100%" id='table-js'>
        <thead>
            <tr>
                <th scope="col">estado</th>
                <th scope="col">codigo proyecto</th>
                {{-- <th scope="col">integrantes</th> --}}
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
                            <form action="{{ route('proyectoFinal.create', $proyecto->idProyecto) }}" method="get">
                                <button type="submit" class="btn"
                                style="background: #003E65; color:rgb(255, 255, 255)"
                                >Proyecto final</button>
                            </form>
                        </td>

                    </tr>
                @endif
            @endforeach

        </tbody>
    </table>
@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
@endsection
<script>
    let table = new DataTable('#proy');
</script>
@stop
