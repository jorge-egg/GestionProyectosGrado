
<h1>usuarios</h1>
    <br>
<table class="table">
        <thead>
            <tr>
                <th scope="col">Documento</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Email</th>
                <th scope="col">Telefono</th>
                <th scope="col">usua_sede</th>
                <th scope="col">usua_users</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <th>{{ $usuario->numeroDocumento }}</th>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->apellido }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->numeroCelular}}</td>
                    <td>{{ $usuario->usua_sede }}</td>
                    <td>{{ $usuario->usua_users }}</td>
                    <td>
                    </td>
                    <td>
                        <form action="{{ route('usuarios.edit', $usuario->numeroDocumento) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-success">Editar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

   