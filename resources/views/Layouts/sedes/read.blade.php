@extends('dashboard')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel='stylesheet'>
@endsection
@section('dashboard_content')

<h1>Sedes</h1>
    <br>
<table class="table table-hover shadow-lg mt-4" style="width:100%" id='sede'>
        <thead>
            <tr>
                <th scope="col">Sede</th>
                <th scope="col">Telefono</th>
                <th scope="col">E-mail</th>
                <th scope="col">Direccion</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($sedes as $sede)
                <tr>
                    <td>{{ $sede->sede }}</td>
                    <td>{{ $sede->telefono }}</td>
                    <td>{{ $sede->email }}</td>
                    <td>{{ $sede->direccion }}</td>
                    <td>
                        <form action="{{ route('facultades.index', $sede->idSede) }}" method="get">

                            <input type="hidden" class="form-control" name="idSede" value="{{$sede->idSede}}">
                            <button type="submit" class="btn btn-primary text-dark">Facultades</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('programa.index') }}" >
                            @csrf
                            <button type="submit" class="btn btn-primary text-dark">Programas</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('comite.index') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary text-dark">Comites</button>
                        </form>
                    </td>

                    <td>
                        <form action="{{ route('sedes.edit', $sede->idSede) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-success">Editar</button>
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
    let table = new DataTable('#sede');
</script>
@stop
