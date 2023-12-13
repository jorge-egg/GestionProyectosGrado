@extends('dashboard')

@section('dashboard_content')

    <h1>Crear Usuario</h1>

    <form action="{{ route('usuarios.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido:</label>
            <input type="text" name="apellido" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="numeroDocumento" class="form-label">Número de Documento:</label>
            <input type="text" name="numeroDocumento" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="numeroCelular" class="form-label">Número de Celular:</label>
            <input type="text" name="numeroCelular" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="usua_sede" class="form-label">Sede:</label>
            <select name="usua_sede" class="form-select" required onchange="getProgramasBySede(this.value)">
                <option value="" selected disabled>Seleccionar Sede</option>
                @foreach ($sedes as $sede)
                    <option value="{{ $sede->idSede }}">{{ $sede->sede }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="roles" class="form-label">Roles:</label>
            @foreach ($roles as $role)
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" id="{{ $role->name }}" onchange="handleRoleChange()">
                    <label class="form-check-label" for="{{ $role->name }}">{{ $role->name }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="programa" class="form-label">Programa:</label>
            <select name="programa" class="form-select" id="programaSelect" disabled>
                <option value="" selected disabled>Seleccionar Programa</option> <!-- Opción por defecto -->
                <!-- Las opciones se completarán dinámicamente según la sede seleccionada. -->
            </select>
        </div>


        <button type="submit" class="btn " style="background:#003E65; color:#fff">Crear Usuario</button>
    </form>

    <script>
        function handleRoleChange() {
            const rolesCheckbox = document.getElementsByName('roles[]');
            const programaSelect = document.getElementById('programaSelect');

            // Verificar si el rol de estudiante está seleccionado
            const isEstudiante = Array.from(rolesCheckbox).some(checkbox => checkbox.value === 'estudiante' && checkbox.checked);

            // Habilitar/deshabilitar y establecer/eliminar 'required' en el campo de programa
            programaSelect.disabled = !isEstudiante;
            programaSelect.required = isEstudiante;
        }

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
@endsection
