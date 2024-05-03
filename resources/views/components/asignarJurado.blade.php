<div class="modal fade" tabindex="-1" id="buscarDocente" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            @component('components.Modales.buscarDocente', [
                'docentes' => $array['miembrosComite'],
                'idProyecto' =>'idProyecto',
                'fase' => 'anteproyecto'
            ])
            @endcomponent
        </div>
<div class="card">
    <h5 class="card-title text-center">Jurados</h5>
    <div class='card-body'>
        <p class="card-text">

        </p>
            <button type="button" data-bs-toggle="modal" data-bs-target="#buscarDocente" class="btn"
                style="background:#003E65; color:#fff; width: 100%;">Seleccionar
                jurados</button>
    </div>
</div><br>
