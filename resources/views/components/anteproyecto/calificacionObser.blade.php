@foreach ($subItems as $subItem)
    <div class="input-group mb-3 campos-calificacion" style="display: flex">
        <p class="form-control auto-expand">

            {{ $subItem }}

        </p>

        <span class="input-group-text" id="basic-addon2" style="display: flex">
            <select class="form-select" aria-label="Default select example" name="c1">
                <option value="si">Si</option>
                <option value="parcial">Parcial</option>
                <option value="no" selected>No</option>
            </select>
        </span>


    </div>
@endforeach

{{-- <textarea class="form-control auto-expand" id="Observaciones" placeholder="Observaciones" name="{{ $nameTextArea }}">
    {{$obsArray}}
</textarea> --}}
