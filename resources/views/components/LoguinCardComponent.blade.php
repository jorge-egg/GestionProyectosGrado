{{-- Loguin Card --}}
<div class="container d-flex justify-content-end col-sm-12 col-md-6">
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


        <form method="POST" action="{{ route('login') }}">

            @csrf
            <div class="col-sm-12 d-flex justify-content-center flex-column p-2">

                <div class="row mb-2">
                    <div class="form-group mb-2">

                        <label for="usuario">Usuario</label>
                        <input name="usuario" type="text" class="form-control @error('usuario') is-invalid @enderror" id="usuario" aria-describedby="emailHelp" placeholder="Ingrese su usuario" required autofocus>
                        @error('usuario')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Ingrese su contraseña" required>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror</div>
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
                </div>

            </div>

        </form>

    </div>
</div>
