@extends('dashboard')

@section('dashboard_content')
    <h1>Añadir Integrante</h1>

    <form action="{{ route('comite.integrantes.store') }}" method="post">
        @csrf
        <div class="mb-3">
            {{dd($docentes)}}
            <label for="docente" class="form-label">Seleccionar Docente</label>
            <select class="form-control" id="docente" name="docente" required>

            <option value="" selected disabled>Seleccionar integrante</option>
                @foreach($docentes as $docente)

                    <option value="{{ $docente->id }}">{{ $docente->usuario }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Seleccionar Integrante</button>
    </form>
@endsection
