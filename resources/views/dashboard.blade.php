@extends('Layouts.app')
@section('styles')

    @yield('estilos_adicionales')
@stop
@section('js_head')

@endsection
@section('content')
    <div class="sidebar">
        <ul class="nav_list">
            @can('usuario.leer')
            <li>
                <a href="{{ route('usuarios.index') }}">
                    <i class='bx bx-group'></i>
                    <span class="links_name">Usuarios</span>
                </a>
            </li>
            @endcan
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
                <a href="{{ route('comite.index') }}">
                    <i class='bx bx-sitemap'></i>
                    <span class="links_name">Comites</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="contenido">
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
