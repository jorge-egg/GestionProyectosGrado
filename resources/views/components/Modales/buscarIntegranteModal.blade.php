<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <form action="{{ route('proyecto.create', '2') }}" method="post">
            @csrf
            <div class="modal-body">
                <p class="card-text">
                    El codigo del estudiante corresponde a:
                </p>
                <input type="hidden" id="codUsuario" name="codUsuario">
                <br>
                <p class="card-text" id="nombreUsuario"></p>
            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-primary text-dark" id="btnEnviarSolicitud">Enviar</button>

            </div>
        </form>
    </div>
</div>
