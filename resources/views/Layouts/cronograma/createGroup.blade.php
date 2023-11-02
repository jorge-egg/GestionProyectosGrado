@extends('dashboard')

@section('estilos_adicionales')
    <link rel="stylesheet" href="{{ asset('css/coloresBtnCampos.css') }}">
@stop

@section('dashboard_content')
    <div class="card">
        <h5 class="card-header">CREAR GRUPO</h5>
        <form action="#" method="POST">
            @csrf
            <div class="card-body">

                <section>
                    <b>
                        <h5>Propuesta</h5>
                    </b>
                    <div class="date-horizontal">

                        <div class="date-padding">
                            <label for="">Fecha de apertura</label>
                            <input type="date" name='fecha_apertura_1' class='form-control' required>
                        </div>
                        <div class="date-padding">
                            <label for="">Fecha de cierre</label>
                            <input type="date" name='fecha_cierre_1' class='form-control' required>
                        </div>

                    </div>
                </section>
                <section>
                    <b>
                        <h5>Anteproyecto</h5>
                    </b>

                    <div class="date-horizontal">

                        <div class="date-padding">
                            <label for="">Fecha de apertura</label>
                            <input type="date" name='fecha_apertura_2' class='form-control' required>
                        </div>
                        <div class="date-padding">
                            <label for="">Fecha de cierre</label>
                            <input type="date" name='fecha_cierre_2' class='form-control' required>
                        </div>

                    </div>
                </section>
                <section>
                    <b>
                        <h5>Proyecto final</h5>
                    </b>
                    <div class="date-horizontal">

                        <div class="date-padding">
                            <label for="">Fecha de apertura</label>
                            <input type="date" name='fecha_apertura_3' class='form-control' required>
                        </div>
                        <div class="date-padding">
                            <label for="">Fecha de cierre</label>
                            <input type="date" name='fecha_cierre_3' class='form-control' required>
                        </div>

                    </div>
                </section>
                <section>
                    <b>
                        <h5>Sustentación</h5>
                    </b>
                    <div class="date-horizontal">

                        <div class="date-padding">
                            <label for="">Fecha de apertura</label>
                            <input type="date" name='fecha_apertura_4' class='form-control' required>
                        </div>
                        <div class="date-padding">
                            <label for="">Fecha de cierre</label>
                            <input type="date" name='fecha_cierre_4' class='form-control' required>
                        </div>

                    </div>
                </section>

                <br>
                <input type="hidden" value="{{ $idCronograma }}" name="idCronograma">
                <button Class='btn btn-outline-info'>Crear</button>

                </p>
            </div>
        </form>
    </div>


@stop
