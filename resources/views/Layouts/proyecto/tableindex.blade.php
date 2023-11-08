@extends('dashboard')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel='stylesheet'>
@endsection
@section('dashboard_content')

<h1>Proyectos</h1>
<table class="table table-hover shadow-lg mt-4" style="width:100%" id='proy'>
        <thead>
            <tr>
                <th scope="col">estado</th>
                <th scope="col">codigo proyecto</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyectos as $proyecto)
                <tr>
                    <td>{{ $proyecto->estado }}</td>
                    <td>{{ $proyecto->codigoproyecto }}</td>
                    <td>
                        <form action="#" >
                            @csrf
                            <button type="submit" class='btn btn-primary text-dark'>ver propuesta</button>
                        </form>
                    </td>
                    <td>
                        <form action="#" >
                            @csrf
                            <button type="submit" class='btn btn-primary text-dark'>ver anteproyecto</button>
                        </form>
                    </td>
                    <td>
                        <form action="#" >
                            @csrf
                            <button type="submit" class='btn btn-primary text-dark'>ver sustentacion</button>
                        </form>
                    </td>
                    <td>
                        <form action="#" >
                            @csrf
                            <button type="submit" class='btn btn-primary text-dark'>ver proyecto final</button>
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