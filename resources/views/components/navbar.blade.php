<nav x-data="{ nav: false }" class="relative">
    <div x-show="nav" x-transition.opacity.duration.300ms class="fixed inset-0 bg-gray-900/[0.8] opacity-100" style="display: none;"></div>
    <div class="relative">
        <div class="px-4 bg-white shadow-sm md:px-6 xl:px-8">
            <div class="flex items-center h-16">
                <button x-on:click="nav =! nav" type="button" class="p-2 text-gray-400 hover:text-gray-500 lg:hidden">
                    <svg x-show="!nav" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                    </svg>
                    <svg x-show="nav" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <div class="flex ml-4 lg:ml-0">
                    <a href="#">LOGO</a>
                </div>
                <div class="hidden lg:block lg:self-stretch lg:ml-8">
                    <div class="flex h-full space-x-8">
                        <a href="{{ route('home') }}" class="flex items-center text-lg font-medium text-gray-700 hover:text-gray-900">Inicio</a>
                        <a href="{{ route('store') }}" class="flex items-center text-lg font-medium text-gray-700 hover:text-gray-900">Tienda</a>
                        <a href="" class="flex items-center text-lg font-medium text-gray-700 hover:text-gray-900">Sobre nosotros</a>
                        <a href="{{ route('contact') }}" class="flex items-center text-lg font-medium text-gray-700 hover:text-gray-900">Contactanos</a>
                    </div>
                </div>
                <div class="flex items-center ml-auto">
                    @if (Auth::guest())
                        <div class="hidden lg:flex lg:flex-1 lg:justify-end lg:items-center lg:space-x-6">
                            <a href="{{ route('login') }}" class="text-lg font-medium text-gray-700 hover:text-gray-900">Iniciar sesión</a>
                            <span class="w-px h-6 bg-gray-200"></span>
                            <a href="{{ route('register') }}" class="text-lg font-medium text-gray-700 hover:text-gray-900">Registrarse</a>
                        </div>
                    @else
                        <a href="{{ url('/dashboard') }}" class="hidden text-lg font-medium text-gray-700 hover:text-gray-900 lg:block">Mi cuenta</a>
                    @endif
                    <div class="flex lg:ml-6">
                        <a href="" class="p-2 text-gray-400 hover:text-gray-500">
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="flow-root ml-4 lg:ml-6">
                        <a href="" class="group flex items-center -m-2 p-2">
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="shrink-0 w-7 h-7 text-gray-400 group-hover:text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                            </svg>
                            <span class="ml-2 text-lg font-medium text-gray-700">0</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div x-show="nav" x-on:click.outside="nav = false" x-transition.origin.top class="py-3 px-2 bg-white" style="display: none;">
            Hola
        </div>
    </div>
</nav>
