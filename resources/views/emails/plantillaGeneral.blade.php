<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

     <!-- Bootstrap -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- estilos -->
    <link href="{{ asset('css/mail.css') }}" rel="stylesheet">

    <title>Document</title>
</head>
<body>
    <header>
        <p>Cordial saludo.</p>
    </header>

    <main class="text-center">
        @yield('contenido')
        <p>Nota: Por favor no responda este correo.</p>
    </main>

    <footer>
        <section class="footer-section">
            <div class="logo">
                <img src="{{ asset('imgs/logos/logoAunar2.png') }}" alt="">
            </div>
            <div class="info-emisor">
                <p>SEGETGRA</p>
                <p>Corporación Universitaria Autónoma de Nariño</p>
                <p>Extensión "AUNAR" Cali</p>
                <p class="Arial">Carrera 42 #5A-79 Barrio Tequendama</p>
                <p class="TrebuchetMS">Página Web: www.aunarcali.edu.co</p>
            </div>
        </section>

        <img src="{{ asset('imgs/logos/unnamed.png') }}" alt="">
    </footer>
</body>
</html>
