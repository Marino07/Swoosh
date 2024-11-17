<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ env('APP_NAME') }}</title>
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased flex flex-col h-screen">
        <div class="flex flex-1 overflow-hidden">

            <!-- Sidebar: visible on large screens, hidden on small screens -->
            <aside class=" md:flex flex-col bg-gray-100 sm:w-[22rem] w-full">
                <header class="bg-tinder py-5 flex items-center p-2.5 sticky top-0">
                    {{--Avatar --}}
                    <x-avatar class="w-10 h-10"></x-avatar>
                    <div class="ml-auto flex items-center gap-3">
                        <a wire:navigate href="/app">
                            <span class="p-2.5 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="h-10 w-10 bg-tinder rounded-full p-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                  </svg>

                            </span>

                        </a>
                    </div>

                </header>

                <livewire:components.tabs />


                <!-- Sidebar content goes here -->
            </aside>

            <!-- Page Content -->
            <main class="hidden flex-1 flex-col overflow-y-auto  md:flex">
                <!-- "You're logged in" or other main content -->
                <div class="block md:hidden text-center text-2xl font-semibold">
                    You're logged in
                </div>
                <!-- Slot content that will appear on larger screens -->
                <div class="hidden md:block">
                    <livewire:home/>
                </div>
            </main>
        </div>

        <!-- Scripts -->
        @livewireScripts
    </body>
</html>
