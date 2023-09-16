<div class="hidden xl:fixed xl:inset-y-0 xl:flex xl:flex-col xl:w-72">
    <div class="flex flex-col grow gap-y-5 px-6 bg-white border-r border-gray-200">
        <div class="flex shrink-0 items-center h-16">
            LOGO
        </div>
        <x-vertical-navigation />
        <div class="-mx-6" for="navbarDropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{route('profile.show')}}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <button class="w-full py-3 px-6 font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                </button>
            </a>
        </div>
    </div>
</div>
<nav x-data="{ nav: false }" class="fixed top-0 z-30 w-full xl:hidden">
    <div x-show="nav" x-transition.opacity.duration.300ms class="fixed inset-0 bg-gray-900/[0.8] opacity-100" style="display: none;"></div>
    <div class="relative">
        <div class="flex justify-between items-center py-4 px-4 bg-white shadow-sm md:px-6">
            <button x-on:click="nav =! nav" type="button" class="p-2.5 -m-2.5 text-gray-700 hover:text-gray-900">
                <svg x-show="!nav" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                </svg>
                <svg x-show="nav" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-8 h-8" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div>LOGO</div>
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{route('profile.show')}}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <button class="text-gray-700 hover:text-gray-900">
                <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-8 h-8">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"></path>
                  </svg>
            </button>
        </a>
        </div>
        <div x-show="nav" x-on:click.outside="nav = false" x-transition.origin.top class="py-3 px-2 bg-white" style="display: none;">
            <x-vertical-navigation />
        </div>
    </div>
</nav>
