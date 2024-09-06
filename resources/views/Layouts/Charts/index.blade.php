{{-- @extends('dashboard')

@section('dashboard_content')

<div class="card text-center">
        <div class="card-header">
            Estadísticas
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h1>{{ $chart1->options['chart_title'] }}</h1>
                    {!! $chart1->renderHtml() !!}
                </div>
                <div class="col-md-3">
                    <h1>{{ $chart2->options['chart_title'] }}</h1>
                    {!! $chart2->renderHtml() !!}
                </div>
                <div class="col-md-3">
                    <h1>{{ $chart3->options['chart_title'] }}</h1>
                    {!! $chart3->renderHtml() !!}
                </div>
                <div class="col-md-3">
                    <h1>{{ $chart4->options['chart_title'] }}</h1>
                    {!! $chart4->renderHtml() !!}
                </div>
                <div class="col-md-3">
                    <h1>{{ $chart5->options['chart_title'] }}</h1>
                    {!! $chart5->renderHtml() !!}
                </div>
                <div class="col-md-3">
                    <h1>{{ $chart6->options['chart_title'] }}</h1>
                    {!! $chart6->renderHtml() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}
    {!! $chart2->renderJs() !!}
    {!! $chart3->renderJs() !!}
    {!! $chart4->renderJs() !!}
    {!! $chart5->renderJs() !!}
    {!! $chart6->renderJs() !!}
@endsection --}}
@extends('dashboard')

@section('dashboard_content')
<div class="card text-center">
    <div class="card-header">
        Estadísticas
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('charts.index') }}">
            <div class="row mb-4">
                <div class="col-md-3">
                    <h5 class="card-title">Fecha inicial</h5>
                    <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                </div>
                <div class="col-md-3">
                    <h5 class="card-title">Fecha final</h5>
                    <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn"
                        style="background:#003E65; color:#fff;">Filtrar</button>
                </div>
            </div>
        </form>
        <div class="row">
            @foreach (['Proyectos' => ['total' => $totalProyectos, 'estados' => $proyectoEstados],
                      'Sustentaciones' => ['total' => $totalSustentaciones, 'estados' => $sustentacionEstados],
                      'Proyectos Finales' => ['total' => $totalProyectosFinales, 'estados' => $proyectoFinalEstados],
                      'Anteproyectos' => ['total' => $totalAnteproyectos, 'estados' => $anteproyectoEstados],
                      'Propuestas' => ['total' => $totalPropuestas, 'estados' => $propuestaEstados]] as $titulo => $datos)
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $titulo }}</h5>
                            <p class="card-text">Total: {{ $datos['total'] }}</p>
                            @foreach ($datos['estados'] as $estado)
                                <p class="card-text">
                                    @if($titulo === 'Proyectos')
                                        {{ $estado->estado == 1 ? 'Activos' : 'Inactivos' }}: {{ $estado->total }}
                                    @else
                                        {{ $estado->estado }}: {{ $estado->total }}
                                    @endif
                                </p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-6">
                <h1>{{ $chart1->options['chart_title'] }}</h1>
                {!! $chart1->renderHtml() !!}
            </div>
            <div class="col-md-3">
                <h1>{{ $chart2->options['chart_title'] }}</h1>
                {!! $chart2->renderHtml() !!}
            </div>
            <div class="col-md-3">
                <h1>{{ $chart3->options['chart_title'] }}</h1>
                {!! $chart3->renderHtml() !!}
            </div>
            <div class="col-md-3">
                <h1>{{ $chart4->options['chart_title'] }}</h1>
                {!! $chart4->renderHtml() !!}
            </div>
            <div class="col-md-3">
                <h1>{{ $chart5->options['chart_title'] }}</h1>
                {!! $chart5->renderHtml() !!}
            </div>
            <div class="col-md-3">
                <h1>{{ $chart6->options['chart_title'] }}</h1>
                {!! $chart6->renderHtml() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}
    {!! $chart2->renderJs() !!}
    {!! $chart3->renderJs() !!}
    {!! $chart4->renderJs() !!}
    {!! $chart5->renderJs() !!}
    {!! $chart6->renderJs() !!}
@endsection
