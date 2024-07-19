<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class ChartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     // Chart 1: Total proyectos
    //     $chart_options1 = [
    //         'chart_title' => 'Total proyectos',
    //         'report_type' => 'group_by_date',
    //         'model' => 'App\Models\SedeProyectosGrado',
    //         'group_by_field' => 'created_at',
    //         'group_by_period' => 'day',
    //         'chart_type' => 'bar',
    //     ];
    //     $chart1 = new LaravelChart($chart_options1);
    //     // Chart 2: Total usuarios
    //     $chart_options1 = [
    //         'chart_title' => 'Propuesta estados',
    //         'report_type' => 'group_by_string',
    //         'model' => 'App\Models\FasePropuesta',
    //         'group_by_field' => 'estado',
    //         'chart_type' => 'pie',
    //     ];
    //     $chart2 = new LaravelChart($chart_options1);
    //     // Chart 3: Total usuarios
    //     $chart_options1 = [
    //         'chart_title' => 'Anteproyectos estados',
    //         'report_type' => 'group_by_string',
    //         'model' => 'App\Models\FaseAnteproyecto',
    //         'group_by_field' => 'estado',
    //         'chart_type' => 'pie',
    //     ];
    //     $chart3 = new LaravelChart($chart_options1);
    //     // Chart 3: Total usuarios
    //     $chart_options1 = [
    //         'chart_title' => 'Proyectos finales estados',
    //         'report_type' => 'group_by_string',
    //         'model' => 'App\Models\FaseProyectosfinale',
    //         'group_by_field' => 'estado',
    //         'chart_type' => 'pie',
    //     ];
    //     $chart4 = new LaravelChart($chart_options1);
    //     // Chart 3: Total usuarios
    //     $chart_options1 = [
    //         'chart_title' => 'Sustentaciones estados',
    //         'report_type' => 'group_by_string',
    //         'model' => 'App\Models\FaseSustentaciones',
    //         'group_by_field' => 'estado',
    //         'chart_type' => 'pie',
    //     ];
    //     $chart5 = new LaravelChart($chart_options1);
    //     // Chart 3: Total usuarios
    //     $chart_options1 = [
    //         'chart_title' => 'Proyectos estados',
    //         'report_type' => 'group_by_string',
    //         'model' => 'App\Models\SedeProyectosGrado',
    //         'group_by_field' => 'estado',
    //         'chart_type' => 'pie',
    //     ];
    //     $chart6 = new LaravelChart($chart_options1);



    //     return view('Layouts.Charts.index', compact('chart1', 'chart2', 'chart3', 'chart4', 'chart5', 'chart6'));

    // }
    public function index(Request $request)
{
    // Obtener rango de fechas del request
    $startDate = $request->input('start_date', '2000-01-01');
    $endDate = $request->input('end_date', now()->toDateString());

    // Chart 1: Total proyectos
    $chart_options1 = [
        'chart_title' => 'Total proyectos',
        'report_type' => 'group_by_date',
        'model' => 'App\Models\SedeProyectosGrado',
        'group_by_field' => 'created_at',
        'group_by_period' => 'day',
        'chart_type' => 'bar',
        'filter_field' => 'created_at',
        'filter_from' => $startDate,
        'filter_to' => $endDate,
    ];
    $chart1 = new LaravelChart($chart_options1);

    // Chart 2: Propuesta estados
    $chart_options2 = [
        'chart_title' => 'Propuesta estados',
        'report_type' => 'group_by_string',
        'model' => 'App\Models\FasePropuesta',
        'group_by_field' => 'estado',
        'chart_type' => 'pie',
        'filter_field' => 'created_at',
        'filter_from' => $startDate,
        'filter_to' => $endDate,
    ];
    $chart2 = new LaravelChart($chart_options2);

    // Chart 3: Anteproyectos estados
    $chart_options3 = [
        'chart_title' => 'Anteproyectos estados',
        'report_type' => 'group_by_string',
        'model' => 'App\Models\FaseAnteproyecto',
        'group_by_field' => 'estado',
        'chart_type' => 'pie',
        'filter_field' => 'created_at',
        'filter_from' => $startDate,
        'filter_to' => $endDate,
    ];
    $chart3 = new LaravelChart($chart_options3);

    // Chart 4: Proyectos finales estados
    $chart_options4 = [
        'chart_title' => 'Proyectos finales estados',
        'report_type' => 'group_by_string',
        'model' => 'App\Models\FaseProyectosfinale',
        'group_by_field' => 'estado',
        'chart_type' => 'pie',
        'filter_field' => 'created_at',
        'filter_from' => $startDate,
        'filter_to' => $endDate,
    ];
    $chart4 = new LaravelChart($chart_options4);

    // Chart 5: Sustentaciones estados
    $chart_options5 = [
        'chart_title' => 'Sustentaciones estados',
        'report_type' => 'group_by_string',
        'model' => 'App\Models\FaseSustentacione',
        'group_by_field' => 'estado',
        'chart_type' => 'pie',
        'filter_field' => 'created_at',
        'filter_from' => $startDate,
        'filter_to' => $endDate,
    ];
    $chart5 = new LaravelChart($chart_options5);

    // Chart 6: Proyectos estados
    $chart_options6 = [
        'chart_title' => 'Proyectos estados',
        'report_type' => 'group_by_string',
        'model' => 'App\Models\SedeProyectosGrado',
        'group_by_field' => 'estado',
        'chart_type' => 'pie',
        'filter_field' => 'created_at',
        'filter_from' => $startDate,
        'filter_to' => $endDate,
    ];
    $chart6 = new LaravelChart($chart_options6);

    // Totales
    $totalProyectos = \App\Models\SedeProyectosGrado::whereBetween('created_at', [$startDate, $endDate])->count();
    $totalSustentaciones = \App\Models\FaseSustentacione::whereBetween('created_at', [$startDate, $endDate])->count();
    $totalProyectosFinales = \App\Models\FaseProyectosfinale::whereBetween('created_at', [$startDate, $endDate])->count();
    $totalAnteproyectos = \App\Models\FaseAnteproyecto::whereBetween('created_at', [$startDate, $endDate])->count();
    $totalPropuestas = \App\Models\FasePropuesta::whereBetween('created_at', [$startDate, $endDate])->count();

    return view('Layouts.Charts.index', compact(
        'chart1', 'chart2', 'chart3', 'chart4', 'chart5', 'chart6',
        'totalProyectos', 'totalSustentaciones', 'totalProyectosFinales', 'totalAnteproyectos', 'totalPropuestas',
        'startDate', 'endDate'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
