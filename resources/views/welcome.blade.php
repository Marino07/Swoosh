<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="antialiased font-sans">
        <div class="bg-gray-50 text-black/50">
            <div class="relative bg-gray-400 min-h-screen flex flex-col  selection:bg-[#FF2D20] selection:text-white">
                <div class="">
                        @if (Route::has('login'))
                           @include('livewire.layout.navigation')
                        @endif
                </div>
            </div>
        </div>
        @livewireScripts
    </body>
</html>
