<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SEGETGRA</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logos/aunar.png') }}" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <link rel="stylesheet" href="{{ asset('css/Layout.css') }}">
    @yield('css')

    @yield('importaciones_js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

</head>

<body>

    {{-- Navbar --}}
    <nav id="logoTitulo">
        @component('components.NavbarComponent')
        @endcomponent
    </nav>
    <main>
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="titulo">
            <h1>Crear Usuario</h1>
        </div>
        <div class="formularioRegister">
            <form action="{{ route('usuarios.store') }}" method="post">
                @csrf
                <section class="sec1 secForm">
                <div class="mb-3" style="padding-right: 5px">
                    <label for="numeroDocumento" class="form-label">Número de Documento:</label>
                    <input type="text" name="numeroDocumento" class="form-control" required>
                </div>

                <div class="mb-3" style="padding-left: 5px">
                    <label for="numeroCelular" class="form-label">Número de Celular:</label>
                    <input type="text" name="numeroCelular" class="form-control" required>
                </div>
            </section>
            @error('numeroDocumento')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <section class="sec2 secForm">
                <div class="mb-3" style="padding-right: 5px">
                    <label for="nombre" class="form-label">Nombres:</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3" style="padding-left: 5px">
                    <label for="apellido" class="form-label">Apellidos:</label>
                    <input type="text" name="apellido" class="form-control" required>
                </div>
            </section>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <section class="sec3 secForm">

                <div class="mb-3" style="padding-right: 5px">
                    <label for="usua_sede" class="form-label">Sede:</label>
                    <select name="usua_sede" class="form-select" required onchange="getProgramasBySede(this.value)">
                        <option value="" selected disabled>Seleccionar Sede</option>
                        @foreach ($sedes as $sede)
                            <option value="{{ $sede->idSede }}">{{ $sede->sede }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- <div class="mb-3">
            <label for="roles" class="form-label">Roles:</label>
            @foreach ($roles as $role)
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}"
                        id="{{ $role->name }}" onchange="handleRoleChange()">
                    <label class="form-check-label" for="{{ $role->name }}">{{ $role->name }}</label>
                </div>
            @endforeach
        </div> --}}

                <div class="mb-3" style="padding-left: 5px">
                    <label for="programa" class="form-label">Programa:</label>
                    <select name="programa" class="form-select" id="programaSelect">
                        <option value="" selected>Seleccionar Programa</option> <!-- Opción por defecto -->
                        <!-- Las opciones se completarán dinámicamente según la sede seleccionada. -->
                    </select>
                </div>
            </section>
            <section class="sec4 secForm">
                <!-- Agregar campo para la contraseña -->
                <div class="mb-3" style="padding-right: 5px">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <!-- Agregar campo para confirmar la contraseña -->
                <div class="mb-3" style="padding-left: 5px">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña:</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <!-- Mensajes de error para la validación de la contraseña -->
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <!-- Mensajes de error para la validación de la confirmación de contraseña -->
                @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </section>
                <button type="submit" class="btn " style="background:#003E65; color:#fff">Crear Usuario</button>
            </form>
        </div>
    </main>



    <script>
        // function handleRoleChange() {
        //     const rolesCheckbox = document.getElementsByName('roles[]');
        //     const programaSelect = document.getElementById('programaSelect');

        //     // Verificar si el rol de estudiante está seleccionado
        //     const isEstudiante = Array.from(rolesCheckbox).some(checkbox => checkbox.value === 'estudiante' && checkbox
        //         .checked);

        //     // Habilitar/deshabilitar y establecer/eliminar 'required' en el campo de programa
        //     programaSelect.disabled = !isEstudiante;
        //     programaSelect.required = isEstudiante;
        // }

        function getProgramasBySede(sedeId) {
            // Hacer una solicitud AJAX para obtener los programas de la sede seleccionada
            // y actualizar dinámicamente el contenido del select de programas
            fetch("{{ url('get-programas-by-sede') }}/" + sedeId)
                .then(response => response.json())
                .then(data => {
                    const programaSelect = document.getElementById('programaSelect');
                    programaSelect.innerHTML = ""; // Limpiar las opciones actuales

                    // Agregar la opción por defecto
                    const defaultOption = document.createElement('option');
                    defaultOption.value = "";
                    defaultOption.text = "Seleccionar Programa";
                    programaSelect.add(defaultOption);

                    // Agregar las opciones dinámicamente
                    data.forEach(programa => {
                        const option = document.createElement('option');
                        option.value = programa.idPrograma;
                        option.text = programa.programa;
                        programaSelect.add(option);
                    });
                });
        }
    </script>
</body>

</html>
