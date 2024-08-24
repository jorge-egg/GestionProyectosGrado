@extends('dashboard')
@section('dashboard_content')
<div class="card">
    <h5 class="card-title text-center">Editar Comite</h5>
    <br>
    <div class='card-body'>
        <p class="card-text">
        <form action="{{route('programa.update', [$programas->idPrograma, $idSede])}}" method="post">
        @csrf
        <div><label for="">Programa</label>
            <input type="text" name='programa' class='form-control' value="{{$programas->programa}}" required>
        </div>
        <div>
            <label for="">Siglas</label>
            <input type="text" name='siglas' class='form-control' value="{{$programas->siglas}}" required>
        </div>
        <div>
            <label for="email">E-mail</label>
            <input type="email" name='email' class='form-control' value="{{$programas->email}}" required>
        </div>
        <div>
            <label for="email">Contraseña E-mail</label>
            <div class="input-group">
              <input type="password" name="passemail" class="form-control" id="email-password" required>
              <button class="btn btn-outline-secondary" type="button" id="toggleEmailPassword">
                <i class="bi bi-eye"></i> <!-- Icono de ojo -->
              </button>
            </div>
          </div>

          <script>
            document.getElementById('toggleEmailPassword').addEventListener('click', function () {
              const passwordField = document.getElementById('email-password');
              const passwordFieldType = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
              passwordField.setAttribute('type', passwordFieldType);

              // Cambia el icono del botón (opcional)
              this.querySelector('i').classList.toggle('bi-eye');
              this.querySelector('i').classList.toggle('bi-eye-slash');
            });
          </script>

        <br>
        <button Class="btn" style="background:#003E65; color:#fff">Agregar</button>
        </form>
        </p>

    </div>
</div>
@stop
