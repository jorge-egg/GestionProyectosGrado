@extends('dashboard')
@section('dashboard_content')
<div class="card">
    <h5 class="card-title text-center">Editar Facultad</h5>
    <br>
    <div class='card-body'>
        <p class="card-text">
        <form action="{{route('facultades.update', ['idFacultad'=>$facultad->idFacultad, 'idSede'=>$idSede])}}" method="post">
        @csrf
        <div><label for="">Facultad</label>
            <input type="text" name='nombre' class='form-control @error('nombre') is-invalid @enderror' value="{{$facultad->nombre}}" required>
            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <br>
        <button Class="btn" style="background:#003E65; color:#fff">Actualizar</button>
        </form>
        </p>

    </div>
</div>
@stop
