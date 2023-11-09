@extends('Layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/slidebar.css') }}">
    @yield('estilos_adicionales')
@stop
@yield('css')
@section('content')
        <div class="sidebar">
            <div class="logo_content">
                <div class="logo">
                    <i class='bx bxs-universal-access'></i>
                    <div class="logo_name">

                    </div>
                </div>
                <i class='bx bx-menu' id="btn"></i>
            </div>
            <ul class="nav_list">
                <li>
                    <a href="{{ route('usuarios.index') }}">
                        <i class='bx bx-group'></i>
                        <span class="links_name">Usuarios</span>
                    </a>
                    <span class="tooltip">Usuarios</span>
                </li>
                <li>
                    <a href="{{ route('sedes.index') }}">
                        <i class='bx bxs-institution'></i>
                        <span class="links_name">Sedes</span>
                    </a>
                    <span class="tooltip">Sedes</span>
                </li>
                <li>
                    <a href="{{ route('cronograma.index') }}">
                        <i class='bx bxs-user-badge'></i>
                        <span class="links_name">Cronograma</span>
                    </a>
                    <span class="tooltip">Cronograma</span>
                </li>


                <li>
                    <a href="{{ route('proyecto.index') }}">
                        <i class='bx bx-book'></i>
                        <span class="links_name">Proyectos</span>
                    </a>
                    <span class="tooltip">Proyectos</span>
                </li>
                <li>
                    <a href="{{ route('programa.index') }}">
                        <i class='bx bx-sitemap'></i>
                        <span class="links_name">Proyecto</span>
                    </a>
                    <span class="tooltip">Proyecto</span>
                </li>

            </ul>
            <div id="div_cerrar_seccion" style="text-align: center;">
                <a id="cerrar_seccion" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <img src="{{asset('img/logout.png')}}" alt="">
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        <div class="contenido">
            <header>
                <div class="container">
                    @guest
                    @else
                        <div class="logo_name">
                            <img src="" alt="" width="70">
                            <div class="title"></div>
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

    btn.onclick = function(){
        sidebar.classList.toggle('active');
    }
    
@stop
