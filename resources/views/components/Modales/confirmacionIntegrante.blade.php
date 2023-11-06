<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">¿Desea agregar un integrante?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
            <p>Nota. El integrante #2 solo se puede agregar en esta ocación, si crea el proyecto con un unico
                integrante, no podra agregar uno nuevo despues.</p>
        </div>
        <div class="modal-footer">
            <form action="{{ route('proyecto.create', '1') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-secondary text-dark" data-bs-dismiss="modal"
                    id="crear">Crear</button>
            </form>
            <button type="submit" class="btn btn-primary text-dark" id="agregar" onclick="actModalObtNom()">Agregar
                integrante</button>
        </div>
    </div>
</div>
