@extends('Layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/slidebar.css') }}">
    @yield('estilos_adicionales')
@stop

@section('content')
    <div class="sidebar">
        <ul class="nav_list">
            <li>
                <a href="{{ route('usuarios.index') }}">
                    <i class='bx bx-group'></i>
                    <span class="links_name">Usuarios</span>
                </a>
            </li>
            <li>
                <a href="{{ route('sedes.index') }}">
                    <i class='bx bxs-institution'></i>
                    <span class="links_name">Sedes</span>
                </a>
            </li>
            <li>
                <a href="{{ route('cronograma.index') }}">
                    <i class='bx bxs-user-badge'></i>
                    <span class="links_name">Cronograma</span>
                </a>
            </li>
            <li>
                <a href="{{ route('proyecto.index') }}">
                    <i class='bx bx-book'></i>
                    <span class="links_name">Proyectos</span>
                </a>
            </li>
            <li>
                <a href="{{ route('programa.index') }}">
                    <i class='bx bx-sitemap'></i>
                    <span class="links_name">Proyecto</span>
                </a>
            </li>
        </ul>

    </div>
    <div class="contenido">
        <header>
            <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
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
        @yield('js')
        @yield('dashboard_content')
        @yield('js_extra')
    </div>
@stop

@section('script')
    let btn = document.querySelector('#btn');
    let sidebar = document.querySelector('.sidebar');

    btn.onclick = function(){
        sidebar.classList.toggle('active');
    }
@stop
@section('script')
    let btn = document.querySelector('#btn');
    let sidebar = document.querySelector('.sidebar');

    let contenedor= document.querySelector('.contenido');

    btn.onclick = function(){
        sidebar.classList.toggle('active');
        contenedor.classList.toggle('active');
    }
@stop
