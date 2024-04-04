@extends('dashboard')
@section('estilos_adicionales')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel='stylesheet'>
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
                <th scope="col">integrante</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyectos as $proyecto)
                <tr>
                    <td>@if ( $proyecto->estado )
                        Activo
                        @else
                        Finalizado
                    @endif</td>
                    <td>{{ $proyecto->codigoproyecto }}</td>
                    <td>{{ $proyecto->usuario }}</td>
                    <td>
                        <form action="{{ route('propuesta.create', $proyecto->idProyecto) }}" method="get">
                            <button type="submit" class='btn btn-primary text-dark'>Propuesta</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('anteproyecto.create', $proyecto->idProyecto) }}" method="get">
                            {{-- @csrf --}}
                            {{-- <input type="hidden" name="idProyecto" value="{{ $proyecto->idProyecto }}"> --}}
                            <button type="submit" class="btn" style="background:#003E65; color:#fff">Anteproyecto</button>
                        </form>
                    </td>
                    <td>
                        <form action="#" >
                            @csrf
                            <button type="submit" class="btn" style="background:#003E65; color:#fff">Proyecto final</button>
                        </form>
                    </td>
                    <td>
                        <form action="#" >
                            @csrf
                            <button type="submit" class="btn" style="background:#003E65; color:#fff">Sustentación</button>
                        </form>
                    </td>
                </tr>
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
