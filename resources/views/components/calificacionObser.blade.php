
<div class="input-group mb-3 campos-calificacion" style="display: {{ $styleDisplayGeneral }}">
    <textarea class="form-control auto-expand" id="Observaciones" placeholder="Observaciones" name="{{ $nameTextArea }}"
        @can('anteproyecto.subirDocumento','anteproyecto.aprobarDocumento')
            disabled
        @endcan>
    </textarea>
    @can('anteproyecto.calificar')
        <span class="input-group-text" id="basic-addon2" style="display: {{ $styleDisplaySpan }}">
            <select class="form-select" aria-label="Default select example" name="{{ $nameSelect }}">
                <option value="si">Si</option>
                <option value="parcial">Parcial</option>
                <option value="no" selected>No</option>
            </select>
        </span>
    @endcan

</div>
