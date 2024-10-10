<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Swoosh</title>
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="antialiased font-sans bg-cover bg-center" style="background-image: url('{{ asset('tinder_hero_image.webp') }}'); background-size: cover; background-position: center;">
        <div class="bg-black/50 w-full h-full min-h-screen">
            <div class="relative min-h-screen flex flex-col selection:bg-[#FF2D20] selection:text-white">
                <div class="">
                    @if (Route::has('login'))
                        @include('livewire.layout.navigation')
                    @endif

                    <center class="m-auto flex flex-col justify-center items-center min-h-screen ">
                        <h3 class="font-bold text-7xl sm:text-8xl text-white pb-14">
                            Swipe Right
                            <sup>
                                <span class="text-xl p-2 px-3 border-4 rounded-full border-white">
                                    R
                                </span>
                            </sup>
                        </h3>
                        <a class="rounded-3xl bg-gradient-to-r from-pink-500 via-orange-500 to-rose-500 text-white text-xl font-bold px-8 py-2.5 max-w-fit mx-auto" href="{{route('register')}}">
                            Create account
                        </a>

                    </center>

                </div>
                {{-- Testimoniouns --}}
                <main class="bg-white w-full px-8 lg:px-6 py-9 mx-auto">
                    <section class="grid grid-cols-2 lg:grid-cols-3 gap-5">
                        <div class="border border-gray-300 shadow-md p-4 rounded-lg">
                            <h5 class="flex items-center justify-between font-bold my-3 text-xl">{{ fake()->name }}
                                <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-quote" viewBox="0 0 16 16">
                                    <path d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388q0-.527.062-1.054.093-.558.31-.992t.559-.683q.34-.279.868-.279V3q-.868 0-1.52.372a3.3 3.3 0 0 0-1.085.992 4.9 4.9 0 0 0-.62 1.458A7.7 7.7 0 0 0 9 7.558V11a1 1 0 0 0 1 1zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612q0-.527.062-1.054.094-.558.31-.992.217-.434.559-.683.34-.279.868-.279V3q-.868 0-1.52.372a3.3 3.3 0 0 0-1.085.992 4.9 4.9 0 0 0-.62 1.458A7.7 7.7 0 0 0 3 7.558V11a1 1 0 0 0 1 1z"/>
                                  </svg>
                            </h5>
                            <hr class="my-2">
                            <p class="text-gray-700">{{ fake()->text }}</p>
                        </div>
                        <div class="border border-gray-300 shadow-md p-4 rounded-lg">
                            <h5 class=" flex items-ce justify-between font-bold my-3 text-xl">
                                {{ fake()->name }}
                                <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-quote" viewBox="0 0 16 16">
                                    <path d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388q0-.527.062-1.054.093-.558.31-.992t.559-.683q.34-.279.868-.279V3q-.868 0-1.52.372a3.3 3.3 0 0 0-1.085.992 4.9 4.9 0 0 0-.62 1.458A7.7 7.7 0 0 0 9 7.558V11a1 1 0 0 0 1 1zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612q0-.527.062-1.054.094-.558.31-.992.217-.434.559-.683.34-.279.868-.279V3q-.868 0-1.52.372a3.3 3.3 0 0 0-1.085.992 4.9 4.9 0 0 0-.62 1.458A7.7 7.7 0 0 0 3 7.558V11a1 1 0 0 0 1 1z"/>
                                  </svg>
                            </h5>
                            <hr class="my-2">
                            <p class="text-gray-700">{{ fake()->text }}</p>
                        </div>
                        <div class="border border-gray-300 shadow-md p-4 rounded-lg">
                            <h5 class="flex items-center justify-between font-bold my-3 text-xl">{{ fake()->name }}
                                <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-quote" viewBox="0 0 16 16">
                                    <path d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388q0-.527.062-1.054.093-.558.31-.992t.559-.683q.34-.279.868-.279V3q-.868 0-1.52.372a3.3 3.3 0 0 0-1.085.992 4.9 4.9 0 0 0-.62 1.458A7.7 7.7 0 0 0 9 7.558V11a1 1 0 0 0 1 1zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612q0-.527.062-1.054.094-.558.31-.992.217-.434.559-.683.34-.279.868-.279V3q-.868 0-1.52.372a3.3 3.3 0 0 0-1.085.992 4.9 4.9 0 0 0-.62 1.458A7.7 7.7 0 0 0 3 7.558V11a1 1 0 0 0 1 1z"/>
                                  </svg>
                            </h5>
                            <hr class="my-2">
                            <p class="text-gray-700">{{ fake()->text }}</p>
                        </div>
                    </section>
                </main>

            </div>
        </div>
        @livewireScripts
    </body>
</html>
