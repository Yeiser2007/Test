<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        @vite(['resources/sass/auth.scss'])
    </head>
    <body class="antialiased bg-light">
        <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 text-center">
                        <!-- Logo Container -->
                        <div class="mb-5">
                            <img src="https://cdn-icons-png.freepik.com/256/4344/4344949.png" alt="Logo" class="welcome-logo">
                        </div>
                        
                        <!-- Auth Buttons -->
                        @if (Route::has('login'))
                            <div class="d-flex justify-content-center gap-3">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn btn-primary px-4 py-2">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-outline-primary px-4 py-2">
                                        Iniciar sesión
                                    </a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2">
                                            Registrarse
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>