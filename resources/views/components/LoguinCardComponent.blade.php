{{-- Loguin Card --}}
<div class="container-login d-flex justify-content-center col-sm-12 col-md-6">
    <div class="card flex-wrap ">

        <div class="col-sm-12 p-2">
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-center">
                    <h4 style="font-weight: bold">Iniciar sesión</h4>
                </div>
            </div>
        </div>


        <form method="POST" action="{{ route('login') }}">

            @csrf
            <div class="col-sm-12 d-flex justify-content-center flex-column p-2">

                <div class="row mb-2">
                    <div class="form-group mb-2">

                        <label for="usuario">Numero de documento</label>
                        <input name="usuario" type="text" class="form-control" id="usuario" aria-describedby="emailHelp" placeholder="Ingrese su numero de documento" required autofocus>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Ingrese su contraseña" required>
                    </div>
                </div>

                @if ($errors->any())

                <div class="row">
                    <div class="col-sm-12 d-flex justify-content-center flex-column">
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </div>
                    </div>
                </div>

                @endif

                <div class="button-group m-2 d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-outline-dark">Ingresar</button>
                </div>

                <div class="row mt-4">
                    @if (Route::has('password.request'))
                        <div class="col-sm-12 d-flex justify-content-end">
                            <a href="{{ route('password.request') }}" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">¿Olvidaste tu contraseña?</a>
                        </div>

                    @endif
                    <a href="{{ route('usuarios.create')}}" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Registrarse</a>
                </div>

            </div>

        </form>

    </div>
</div>
