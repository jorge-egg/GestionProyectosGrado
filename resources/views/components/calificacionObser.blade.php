<div class="input-group mb-3 campos-calificacion" style="display: none;">
    <textarea class="form-control auto-expand" id="Observaciones" placeholder="Observaciones" name="{{$nameTextArea}}">{{$obsArray}}</textarea>
    <span class="input-group-text" id="basic-addon2">
        <select class="form-select" aria-label="Default select example" name="{{$nameSelect}}">
            <option selected disabled>Calificación</option>
            <option value="si">Si</option>
            <option value="parcial">Parcial</option>
            <option value="no">No</option>
        </select>
    </span>
</div>
