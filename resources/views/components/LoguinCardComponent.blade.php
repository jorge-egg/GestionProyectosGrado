{{-- Loguin Card --}}
<div class="container d-flex justify-content-end col-sm-12 col-md-6 mt-4">
    <div class="card p-2 flex-wrap card-glass">

        <div class="col-sm-12 p-2">
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-center">
                    <h4 style="font-weight: bold">Iniciar sesión</h4>
                </div>
                <div class="col-sm-12 d-flex justify-content-center">
                    <img src="{{ asset('imgs/logos/logoAunar2.png') }}" alt="Logo2" width="70" class="img-fluid">
                </div>
            </div>
        </div>

        <form action="#">
            <div class="col-sm-12 d-flex justify-content-center flex-column p-2">

                <div class="row mb-2">
                    <div class="form-group mb-2">
                        <label for="userInputId">Usuario</label>
                        <input type="email" class="form-control" id="userInputId" aria-describedby="emailHelp" placeholder="Ingrese su usuario">
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="form-group">
                        <label for="passwordInputId">Contraseña</label>
                        <input type="password" class="form-control" id="passwordInputId" placeholder="Ingrese su contraseña">
                    </div>
                </div>

                <div class="button-group m-2 d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-outline-dark">Ingresar</button>
                </div>

                <div class="row mt-4">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <a href="#" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>

            </div>

        </form>

    </div>
</div>