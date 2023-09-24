<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SEGETGRA</title>
    <link rel="shortcut icon" href="{{ asset('imgs/logos/logoAunar2.png') }}" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>

    <link rel="stylesheet" href="{{ asset('css/Layout.css') }}">
    @yield('css')

    @yield('importaciones_js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

</head>
<body>

    <div class="container p-2">
        
        <section>
            <div class="skewed"></div>
        </section>

        {{-- Navbar --}}
        <section>
            @component('components.NavbarComponent')
            @endcomponent
        </section>

        <section class="d-flex justify-content-center mb-2">
            {{-- HERO COMPONENT --}}
            @component('components.HeroComponent')
            @endcomponent

            {{-- lOGUIN CARD COMPONENT --}}
            @component('components.LoguinCardComponent')
            @endcomponent
        </section>

        <section id="infoCardsContainer">
            @component('components.infoCardsComponent')
                
            @endcomponent
        </section>
        

        @yield('contenido')
        


    </div>

    @yield('js')
</body>
</html>

