@extends('dashboard')
@section('css')

@endsection
@section('dashboard_content')
<form action="{{ route('proyecto.create') }}" method="get">
    <button type="submit" class="btn btn-outline-primary">Crear un proyecto</button>
</form>
<form action="{{ route('propuesta.create') }}" method="get">
    <button type="submit" class="btn btn-outline-warning">Crear Prouesta</button>
</form>

@stop
