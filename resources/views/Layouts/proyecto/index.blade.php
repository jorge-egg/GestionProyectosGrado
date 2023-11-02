@extends('dashboard')
@section('css')

@endsection
@section('dashboard_content')
    <div id="cardComponent">
        @component('components.integrantesCard')
        @endcomponent
    </div>
    <button type="button" class="btn btn-outline-primary" id="botonComponente">Crear un proyecto</button>
    <form action="{{ route('propuesta.create') }}" method="get">
        <button type="submit" class="btn btn-outline-warning">Crear Prouesta</button>
    </form>

@stop

@section('js_extra')
<script>
    document.getElementById('botonComponente').addEventListener('click', () => {
        var componente = document.getElementById('cardComponent');

        if (componente.style.display === 'none') {
            componente.style.display = 'block';
        } else {
            componente.style.display = 'none';
        }
    });
</script>
@endsection
