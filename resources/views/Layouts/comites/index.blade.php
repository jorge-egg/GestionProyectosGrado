@extends('dashboard')
@section('estilos_adicionales')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"
        rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel='stylesheet'>
@endsection
@section('dashboard_content')

    <h1>Comites</h1>
    <br>

    @if (session()->has('success'))
        <div class= 'alert alert-success'>
            {{ session()->get('success') }}
        </div>
    @endif

    <table class="table table-hover shadow-lg mt-4" style="width:100%" id='table-js'>
        <thead>
            <tr>
                <th scope="col">Programa</th>
                <th scope="col">Facultad</th>
                <th scope="col">Sede</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($comites as $comite)
                <tr>
                    <td>{{ $comite->programa }}</td>
                    <td>{{ $comite->nombre }}</td>
                    <td>{{ $comite->sede }}</td>
                    <td>
                        <form action="{{ route('comite.integrantes.create', $comite->idComite) }}" method="get">
                            <button type="submit" class="btn btn-warning">añadir integrante</button>
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

@stop
