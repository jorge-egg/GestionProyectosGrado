<form action="{{route('usuarios.update', $usuarios->numeroDocumento)}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="numeroDocumento" class="form-label">Documento</label>
            <input type="text" class="form-control" id="numeroDocumento" name="numeroDocumento" value="{{$usuarios->numeroDocumento}}">
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{$usuarios->nombre}}">
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="{{$usuarios->apellido}}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{$usuarios->email}}">
        </div>
        <div class="mb-3">
            <label for="numeroCelular" class="form-label">Telefono</label>
            <input type="text" class="form-control" id="numeroCelular" name="numeroCelular" value="{{$usuarios->numeroCelular}}">
        </div>
        <div class="mb-3">
            <label for="usua_sede" class="form-label">usua_sede</label>
            <input type="text" class="form-control" id="usua_sede" name="usua_sede" value="{{$usuarios->usua_sede}}">
        </div>
        <div class="mb-3">
            <label for="usua_users" class="form-label">usua_users</label>
            <input type="text" class="form-control" id="usua_users" name="usua_users" value="{{$usuarios->usua_users}}">
        </div>
        <button type="submit" class="btn btn-outline-warning">Actualizar</button>
    </form>
  