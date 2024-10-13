<?php
use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>
<nav x-data="{ open: false }" class="sticky sm:relative top-0 left-0 right-0 w-full bg-gradient-to-b from-black/80 to-black/0">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-4 sm:px-2 lg:px-2">
        <div class="flex justify-between h-16">
            <!-- Left Side (Logo and Navigation Links) -->
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center px-4 lg:px-2">
                    <a href="{{ route('app') }}" wire:navigate>
                        <svg class="w-6 h-6 text-white " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="tinder">
                            <path fill="currentColor" stroke="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M3.588 13.923c-1.615-1.675-1.424-4.42.517-7.43.353-.548.718-1.045 1.14-1.551l.35-.421.034.376c.053.589.131.911.308 1.28.111.231.294.48.373.552.061.056.032.087.338-.072 2.016-1.125 2.224-2.961 2.11-4.541-.04-.464-.14-.98-.264-1.36C8.448.61 8.421.495 8.436.5c.014.005.265.248.558.54 2.796 2.79 4.308 5.713 4.505 8.703.061 3.427-1.849 5.254-4.629 5.643-2.373.375-4.012-.19-5.282-1.463z"></path>
                        </svg>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-4 md:flex">
                    <x-nav-link class="text-white text-3xl font-black " :href="route('app')" :active="request()->routeIs('app')" wire:navigate>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link class="text-white text-3xl font-black" :href="route('app')" :active="request()->routeIs('app')" wire:navigate>
                        {{ __('Products') }}
                    </x-nav-link>
                    <x-nav-link class="text-white text-3xl font-black" :href="route('app')" :active="request()->routeIs('app')" wire:navigate>
                        {{ __('Safety') }}
                    </x-nav-link>
                    <x-nav-link class="text-white text-3xl font-black" :href="route('app')" :active="request()->routeIs('app')" wire:navigate>
                        {{ __('Support') }}
                    </x-nav-link>
                    <x-nav-link class="text-white text-3xl font-black" :href="route('app')" :active="request()->routeIs('app')" wire:navigate>
                        {{ __('Download') }}
                    </x-nav-link>
                    <x-nav-link class="font-black text-3xl text-white " :href="route('app')" :active="request()->routeIs('app')" wire:navigate>
                        Language
                    </x-nav-link>
                    @guest
                    <div class="flex !ml-[300px] pr-10 space-x-4"> <!-- Dodan ml-auto i pr-10 za desni razmak -->

                        <a class="rounded-xl text-xl bg-white px-6 py-1 flex items-center justify-center font-bold my-auto" href="{{ route('login') }}">
                            Login
                        </a>
                    </div>
                    @endguest
                     <!-- Hamburger -->
                </div>
                <div class="-me-2 flex  items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Right Side (Language and Login) -->

        </div>

        <!-- Responsive Settings (for mobile view) -->

    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 flex flex-col gap-5 p-2 pt-2 pb-3">
            <x-nav-link class="text-white text-xl font-bold" :href="route('app')" :active="request()->routeIs('app')" wire:navigate>
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-link class="text-white text-xl font-bold" :href="route('app')" :active="request()->routeIs('app')" wire:navigate>
                {{ __('Products') }}
            </x-nav-link>
            <x-nav-link class="text-white text-xl font-bold" :href="route('app')" :active="request()->routeIs('app')" wire:navigate>
                {{ __('Learn') }}
            </x-nav-link>
            <x-nav-link class="text-white text-xl font-bold" :href="route('app')" :active="request()->routeIs('app')" wire:navigate>
                {{ __('Safety') }}
            </x-nav-link>
            <x-nav-link class="text-white text-xl font-bold" :href="route('app')" :active="request()->routeIs('app')" wire:navigate>
                {{ __('Support') }}
            </x-nav-link>
            <x-nav-link class="text-white text-xl font-bold" :href="route('app')" :active="request()->routeIs('app')" wire:navigate>
                {{ __('Download') }}
            </x-nav-link>

        </div>

        <!-- Responsive Settings Options -->
        <div class=" pt-4 pb-1 border-t border-gray-200">
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link class="text-" :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <button wire:click="logout"  class=" !text-black w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
