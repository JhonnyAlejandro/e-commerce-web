<div class="xl:flex xl:justify-between xl:items-center">
    <h3 class="text-2xl font-semibold leading-7">{{ $slot }}</h3>
    <div x-data="{ dropdowns: false }" class="relative">
        <div class="flex mt-4 xl:mt-0 xl:ml-4">
            <div class="relative grow z-10">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                    </svg>
                </div>
                <x-input type="text" class="h-full pl-12 rounded-none rounded-l-md" placeholder="Buscar..." />
            </div>
            <x-secondary-button x-on:click="dropdowns =! dropdowns" type="button" class="relative inline-flex items-center gap-x-2 -ml-0.5 rounded-none rounded-r-md">
                {{ __('Mostrar todos') }}
                <svg x-bind:class="{ 'transform rotate-180': dropdowns }" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-5 h-5 text-gray-400 transition-transform duration-300 ease-in-out">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
            </x-secondary-button>
        </div>
        <ul x-show="dropdowns" x-transition.origin.top.right x-on:click.outside="dropdowns = false" role="list" class="absolute z-10 right-0 overflow-hidden w-72 mt-2 bg-white ring-1 ring-black/[0.1] rounded-md shadow-lg" style="display: none;">
            <li class="group p-4 text-lg text-gray-900 hover:text-white hover:bg-indigo-600">
                <div class="flex justify-between items-center">
                    <p class="font-semibold">Mostrar todos</p>
                    <span class="text-indigo-600">
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-5 h-5 group-hover:text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
                        </svg>
                    </span>
                </div>
            </li>
        </ul>
    </div>
</div>
