<div class="card text-center" style="width: 40rem;">
    <div class="card-header">
        Agrega un integrante a tu proyecto
    </div>
    <div class="card-body">
      <p class="card-text">
        Digita el código del estudiante (cédula) para enviar la invitación.
        <br>
        No agregue puntos, comas o espacios.
    </p>
    <br>
        <form action="" method="post">
            @csrf
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Cc.</span>
                <input type="text" class="form-control" placeholder="Cédula" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <a href="#" class="btn btn-primary">Enviar</a>
        </form>

    </div>
</div>



