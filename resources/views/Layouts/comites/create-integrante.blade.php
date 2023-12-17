@extends('dashboard')

@section('dashboard_content')
    <div class="cont_integrante" style="display: flex; flex-direction:row; width: 100%; height: 100%">
        <section style="width: 50%; border-right: solid 1px #000;padding:2%;">
            <h1>Añadir Integrante</h1>
            <form action="{{ route('comite.integrantes.store') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $idComite }}" name="idComite">
                <div class="mb-3">
                    <label for="docente" class="form-label">Seleccionar Docente</label>
                    <select class="form-control" id="docente" name="docente" required>
                        <option value="" selected disabled>Seleccionar integrante</option>
                        @foreach ($docentes as $docente)
                            <option value="{{ $docente->id }}">
                                {{ $docente->numeroDocumento . ' - ' . $docente->nombre . ' ' . $docente->apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-success">Seleccionar Integrante</button>
            </form>
        </section>
        <section style="width: calc(50% - 1px); padding:2%;">
            <table class="table table-hover shadow-lg mt-4" style="width:100%" id='table-js'>
                <thead>
                    <tr>
                        <th scope="col">Documento</th>
                        <th scope="col">Nombre</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        </section>
    </div>
@endsection
