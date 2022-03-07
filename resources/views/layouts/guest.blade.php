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

        @env('production')
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-51PMCTKJ6F"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-51PMCTKJ6F');
        </script>
        @else 
        <!-- Global site tag (gtag.js) - Google Analytics -->
        @endenv
    </head>
    <body class="bg-gray-100">

        <header class="max-w-7xl mx-auto flex items-center justify-between py-6">
            <h1>
                <img class="h-10" src="/img/logo.svg" alt="">
            </h1>
            <div class="text-gray-600 text-sm">
                Data provided by <a target="_blank" class="hover:underline" href="https://nomics.com/">Nomics</a>
            </div>
        </header>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        <footer class="mt-6 text-center text-sm text-gray-700">
            Built by <a class="hover:underline" href="https://twitter.com/mubashariqbal">@mubashariqbal</a>
        </footer>

        @livewireScripts
    </body>
</html>
