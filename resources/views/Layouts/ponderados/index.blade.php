@extends('dashboard')
@section('estilos_adicionales')
    <link rel="stylesheet" href="{{ asset('css/coloresBtnCampos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contenedorButtons.css') }}">
@stop
@section('dashboard_content')
<div class="grid-4">
    <form action="{{ route('proyecto.indextable') }}" method="get">
        <button type="submit" class="btn btn-primary  btnGrandeRectangular">Propuesta</button>
    </form>
    <form action="{{ route('proyecto.indextable') }}" method="get">
        <button type="submit" class="btn btn-primary  btnGrandeRectangular">Anteproyecto</button>
    </form>
    <form action="{{ route('proyecto.indextable') }}" method="get">
        <button type="submit" class="btn btn-primary  btnGrandeRectangular">Proyecto final</button>
    </form>
    <form action="{{ route('proyecto.indextable') }}" method="get">
        <button type="submit" class="btn btn-primary  btnGrandeRectangular">Sustentación</button>
    </form>
</div>

@section('js')
    <script></script>
@endsection
@stop
