@include('notify::components.notify')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SEGETGRA</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logos/aunar.png') }}" type="image/x-icon">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/slidebar.css') }}">
    @yield('styles')
    @notifyCss
    @yield('js_head')
</head>

<body>
    <div id="app">
        <header>

            <div class="container">
                <div class="logo_content">
                    <i class='bx bx-menu' id="btn"></i>
                </div>
                <div class="logo_name">
                    <img src="{{ asset('imgs/logos/escudo.png') }}" alt="" width="70">
                    <div class="title">
                        SEGETGRA
                    </div>
                </div>
                <div class="name_user" style="color: #fff;">
                    @auth
                        @php
                            $user = Auth::user();
                            $usuario = App\Models\UsuariosUser::where('usua_users', $user->id)->first();
                            $nombre = $usuario ? $usuario->nombre . " " . $usuario->apellido : 'Nombre no disponible';
                        @endphp
                        <span id="nombreUsuario">{{ $nombre }}</span>

                        <a class="cerrar-sesion" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();"
                           title="Cerrar sesión">
                            <img src="{{ asset('imgs/logos/cerrar.png') }}" alt="">
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endauth
                </div>
            </div>
        </header>
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script>
        @yield('script')
        $('#table-js').DataTable({
        responsive: true,
        autoWidth: false,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "Sin registros",
            "info": "Pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraron resultados",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
    </script>

    @notifyJs
</body>

</html>
