@extends('dashboard')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel='stylesheet'>
@endsection
@section('dashboard_content')

<h1>Sedes</h1>
    <br>
<table class="table table-hover shadow-lg mt-4" style="width:100%" id='sede'>
        <thead class='bg-primary text-white'>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($comites as $comite)
                <tr>
                    <td>{{ $comite->nombre }}</td>
                    <td>
                    <td>
                        <form action="{{ route('comite.edit', $comite->idComite) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-success">Editar</button>
                        </form>
                    </td>
                    <td>
                       @if(request()->has('view_deleted'))
                       <a href="{{route('comite.restore', $comite->numeroDocumento)}}" class='btn btn-outline-success'>Restablecer</a>
                       @else    
                        <form action="{{ route('comite.destroy', $comite->idComite) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                        </form>
                        @endif
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