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
            <div id="div_cerrar_seccion" style="text-align: center;">
                <a id="cerrar_seccion" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();" style="color: #fff">
                    @php
                        $user = Auth()->id();
                        $usuario = App\Models\UsuariosUser::where('usua_users', $user)->first();
                        $nombre = $usuario->nombre . " " . $usuario->apellido;
                    @endphp
                    {{$nombre}}
                    {{-- <img src="{{ asset('imgs/logos/cerrar.png') }}" alt=""> --}}
                </a>
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                      Dropdown link
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </div>


                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        <div class="contenido">
            <header>
                <div class="container">
                    <div class="logo_content">
                        <i class='bx bx-menu' id="btn"></i>
                    </div>
                    @guest
                    @else
                        <div class="logo_name">
                            <img src="{{ asset('imgs/logos/escudo.png') }}" alt="" width="70">
                            <div class="title">SEGETGRA</div>
                        </div>
                    @endguest

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

    let contenedor= document.querySelector('.contenido');

    btn.onclick = function(){
        sidebar.classList.toggle('active');
        contenedor.classList.toggle('active');
    }


@stop
