@extends('dashboard')
@section('estilos_adicionales')
    <link rel="stylesheet" href="{{ asset('css/coloresBtnCampos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/proyectos.css') }}">
@stop
@section('dashboard_content')
    <div class="contenedor_buttons">
        <div class="modal fade" tabindex="-1" id="confirmacionIntegrante">
            @component('components.Modales.confirmacionIntegrante')
            @endcomponent
        </div>

        <div class="modal fade" tabindex="-1" id="integrantesModal">
            @component('components.Modales.integrantesModal')
            @endcomponent
        </div>
        <div class="modal fade" tabindex="-1" id="buscarIntegranteModal">
            @component('components.Modales.buscarIntegranteModal')
            @endcomponent
        </div>

        @if ($estado)
            <button type="submit" class="btn btn-outline-primary btnGrandeRectangular btn-deshabilitado" data-bs-toggle="modal"
                data-bs-target="#confirmacionIntegrante">Crear un
                proyecto
            </button>
        @else
            <button type="submit" class="btn btn-primary  btnGrandeRectangular" data-bs-toggle="modal"
            data-bs-target="#confirmacionIntegrante">Crear un proyecto</button>
        @endif

        <form action="{{ route('proyecto.indextable') }}" method="get">
            <button type="submit" class="btn btn-primary  btnGrandeRectangular">Ver proyectos</button>
        </form>

    </div>
@stop

@section('js')
    <script>
        function actModalObtNom() { //Activa el modal para buscar un nuevo integrante
            $('#confirmacionIntegrante').modal('hide');
            $('#integrantesModal').modal('show');
        }

        function obtenerNombre() {

            var nombreUsuario = document.getElementById(
                'nombreUsuario'); //etiqueta <p></p> donde se va a mostrar el nombre del usuario buscado en el modal

            var codUsuario = document.getElementById(
                'codUsuario'); //etiqueta <p></p> donde se va a mostrar el codigo del usuario buscado en el modal

            var codigoUsuario = document.getElementById('usuario')
                .value; //obtenemos el codigo de usuario o documento de identidad
            $.ajax({
                url: "{{ route('buscarIntegrante') }}",
                type: 'get',
                data: {
                    documento: codigoUsuario
                },
                dataType: 'json',
                success: function(response) {
                    codUsuario.value = response.codigoUsuario;
                    nombreUsuario.innerText = response.data;
                    if (response.data === "Usuario no encontrado") {
                        $('#btnEnviarSolicitud').css('display', 'none');
                    } else {
                        $('#btnEnviarSolicitud').css('display', 'block');
                    }
                    $('#integrantesModal').modal('hide');
                    $('#buscarIntegranteModal').modal('show');
                },
                error: function() {
                    alert('Hubo un error obteniendo el usuario!');
                }
            });
        }
    </script>
@stop
