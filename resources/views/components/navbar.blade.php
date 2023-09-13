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
                    <a href="{{ route('home') }}"><img src="{{asset('images/logo.png')}}" width="90px"></a>
                </div>
                <div class="hidden lg:block lg:self-stretch lg:ml-8">
                    <div class="flex h-full space-x-8">
                        <a href="{{ route('home') }}" class="flex items-center text-lg font-medium text-gray-700 hover:text-gray-900">Inicio</a>
                        <a href="{{ route('store') }}" class="flex items-center text-lg font-medium text-gray-700 hover:text-gray-900">Tienda</a>
                        <a href="{{ url('/sobre-nosotros') }}" class="flex items-center text-lg font-medium text-gray-700 hover:text-gray-900">Sobre nosotros</a>
                        <a href="{{ url('contactanosView') }}" class="flex items-center text-lg font-medium text-gray-700 hover:text-gray-900">Contactanos</a>
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
                    <div x-data="{ modal: false }" class="flex lg:ml-6">
                        <button x-on:click="modal =! modal" type="button" class="flex items-center p-2 text-gray-400 hover:text-gray-500">
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"></path>
                            </svg>
                            @php
                                $count = \App\Models\Favorite::where('user', auth()->id())->count();
                            @endphp
                            <span class="ml-2 text-lg font-medium text-gray-700">{{$count}}</span>
                        </button>
                        <template x-teleport="body">
                            @include('favorites-list')
                        </template>
                    </div>
                    <div class="flow-root ml-4 lg:ml-6">
                        @livewire('shopcart')
                    </div>
                </div>
            </div>
        </div>
        <div x-show="nav" x-on:click.outside="nav = false" x-transition.origin.top class="py-3 px-2 bg-white" style="display: none;">
            <div class="pt-2 pb-3">
                <a href="{{ route('home') }}" class="block p-2 text-lg font-medium leading-7 text-gray-700 hover:text-gray-900">Inicio</a>
                <a href="{{ route('store') }}" class="block p-2 text-lg font-medium leading-7 text-gray-700 hover:text-gray-900">Tienda</a>
                <a href="{{ url('/sobre-nosotros') }}" class="block p-2 text-lg font-medium leading-7 text-gray-700 hover:text-gray-900">Sobre nosotros</a>
                <a href="{{ url('contactanosView') }}" class="block p-2 text-lg font-medium leading-7 text-gray-700 hover:text-gray-900">Contactanos</a>
            </div>
            <div class="pt-4 pb-3 border-gray-200 border-t-2">
                @if (Auth::guest())
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <a href="{{ route('login') }}" class="py-2 px-3 text-lg font-semibold text-gray-700 text-center ring-2 ring-inset ring-gray-300 rounded-md hover:bg-gray-50">Iniciar sesión</a>
                        <a href="{{ route('register') }}" class="py-2 px-3 text-lg font-semibold text-white text-center bg-indigo-600 rounded-md hover:bg-indigo-500">Registrarse</a>
                    </div>
                @else
                    <a href="{{ url('/dashboard') }}" class="block p-2 text-lg font-medium leading-7 text-gray-700 hover:text-gray-900">Mi cuenta</a>
                @endif
            </div>
        </div>
    </div>
</nav>
