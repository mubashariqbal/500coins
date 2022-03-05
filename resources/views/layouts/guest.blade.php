<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        @livewireStyles
    </head>
    <body class="bg-gray-100">

        <header class="max-w-7xl mx-auto flex justify-center py-10">
            <h1>
                <img class="h-20" src="/img/logo.svg" alt="">
            </h1>
        </header>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        <footer class="mt-6 text-center text-sm text-gray-700">Data provided by <a target="_blank" class="hover:underline" href="https://nomics.com/">Nomics</a></footer>

        @livewireScripts
    </body>
</html>
