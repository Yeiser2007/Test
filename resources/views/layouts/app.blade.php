<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    @vite(['resources/sass/auth.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
    <div class="d-flex">
        
            @include('partials.sidebar')
            <div id="main-content" class="flex-grow-1">
                @include('partials.navbar')
                <main class="p-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        toggleBtn.addEventListener('click', () => {
            toggleBtn.classList.toggle('active');

            if (window.innerWidth < 768) {
                document.body.classList.toggle('sidebar-mobile-active');
            } else {
                document.body.classList.toggle('sidebar-collapsed');
            }
        });
        document.addEventListener('DOMContentLoaded', function () {
            const themeToggle = document.getElementById('toggleTheme');
            const body = document.body;

            // Cargar tema desde localStorage
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                body.classList.add('dark-theme');
            }

            themeToggle.addEventListener('click', function () {
                body.classList.toggle('dark-theme');
                const isDark = body.classList.contains('dark-theme');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');

                const icon = themeToggle.querySelector('i');
                icon.className = isDark ? 'bi bi-sun' : 'bi bi-moon';
            });
        });
    </script>
</body>

</html>