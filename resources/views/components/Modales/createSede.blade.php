
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear una nueva sede</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sedes.store') }}" method="post">
                    @csrf
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="inputSede" class="col-form-label">Sede</label>
                    </div>
                    <div class="col-auto">
                        <input type="text" id="inputSede" class="form-control @error('inputSede') is-invalid @enderror" required name="inputSede">
                    </div>
                    <div class="col-auto">
                        @error('inputSede')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Crear</button>
            </div>
        </form>
        </div>
    </div>

