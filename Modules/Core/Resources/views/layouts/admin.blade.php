<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        {{ module_vite('build-core', 'Resources/assets/sass/app.scss') }}
        {{ module_vite('build-core', 'Resources/assets/js/app.js') }}
    </head>
    <body>
        <div id="app">
            @include('core::includes.sidebar')
            <div class="wrapper d-flex flex-column min-vh-100 bg-light">
                @include('core::includes.header')
                <div class="body flex-grow-1 px-3">
                    @yield('content')
                </div>
                @include('core::includes.footer')
            </div>
        </div>
    </body>
</html>
