@extends('dashboard')

@section('content')
    @if (session('notification'))
        <x-notification>
            {{ session('notification') }}
        </x-notification>
    @endif
    @if ($products->isEmpty())
    <x-empty-states>
        <x-slot name="modal">
            @include('modules.products.create')
        </x-slot>
    </x-empty-states>
    @else
        <div x-data="{ searchFilter: '', categoryFilter: '' }" class="bg-white shadow-lg rounded-lg">
            <div class="py-5 px-6 border-gray-200 border-b-2">
                <x-section-heading>
                    <x-slot name="title">Productos registrados</x-slot>
                    <x-slot name="content">
                        @foreach ($categories as $category)
                            <li x-on:click="dropdowns = false; activeItem = {{ $category->id }}; categoryFilter = '{{ $category->name }}'" :class="{ 'bg-indigo-600 text-white': activeItem === {{ $category->id }} }" class="p-4 text-lg text-gray-900 hover:text-white hover:bg-indigo-600">
                                <div class="flex justify-between items-center">
                                    <p class="font-semibold">{{ $category->name }}</p>
                                    <span x-show="activeItem === {{ $category->id }}" :class="{ 'text-white': activeItem === {{ $category->id }} }" class="text-indigo-600">
                                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
                                        </svg>
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </x-slot>
                </x-section-heading>
            </div>
            <ul role="list" class="grid grid-cols-1 gap-x-6 gap-y-8 py-12 px-8 xl:grid-cols-3">
                <div x-data="{ modal: false }" class="w-full h-full">
                    <button x-on:click="modal =! modal" class="relative block w-full h-full py-12 px-6 text-center rounded-lg border-gray-300 border-4 border-dashed focus:ring focus:ring-offset-4 focus:ring-indigo-500 hover:border-gray-400">
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-12 h-12 mx-auto text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="block mt-2 text-lg font-semibold leading-7 text-gray-900">Agregar un nuevo producto</span>
                    </button>
                    <template x-teleport="body">
                        @include('modules.products.create')
                    </template>
                </div>
                @foreach ($products as $product)
                    <li x-show="searchProducts('{{ $product->name }}', searchFilter) && categoryFilter === '' || categoryFilter === '{{ $product->categoryName }}'" class="overflow-hidden rounded-xl border-gray-200 border-2">
                        <div class="flex items-center gap-x-4 p-6 bg-gray-50 border-gray-900/[0.05] border-b-2">
                            <img src="{{ asset($product->image) }}" class="flex-none w-12 h-12 bg-white object-cover object-center ring-1 ring-gray-900/[0.1] rounded-lg">
                            <h3 class="overflow-hidden w-full text-lg font-semibold leading-7 text-gray-900 whitespace-nowrap text-ellipsis">{{ $product->name }}</h3>
                            <div x-data="{ dropdowns: false, product: {} }" class="relative ml-auto">
                                <button x-on:click="dropdowns =! dropdowns" class="block p-2.5 text-gray-400 hover:text-gray-500">
                                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                                    </svg>
                                </button>
                                <div x-show="dropdowns" x-on:click.outside="dropdowns = false" x-transition.origin.top.right class="absolute right-0 z-10 overflow-hidden w-60 mt-2 py-2 bg-white ring-1 ring-black/[0.1] rounded-md shadow-lg" style="display: none;">
                                    <div x-data="{ modal: false }">
                                        <button x-on:click="modal =! modal; dropdowns = false" class="flex items-center w-full py-3 px-4 text-lg leading-6 text-gray-700 hover:text-gray-900 hover:bg-gray-100">
                                            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6 mr-3">
                                                <path d="M8 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"></path>
                                                <path clip-rule="evenodd" fill-rule="evenodd" d="M4.5 2A1.5 1.5 0 003 3.5v13A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.5-1.5V7.621a1.5 1.5 0 00-.44-1.06l-4.12-4.122A1.5 1.5 0 0011.378 2H4.5zm5 5a3 3 0 101.524 5.585l1.196 1.195a.75.75 0 101.06-1.06l-1.195-1.196A3 3 0 009.5 7z"></path>
                                            </svg>
                                            Ver detalles
                                        </button>
                                        <template x-teleport="body">
                                            @include('modules.products.show')
                                        </template>
                                    </div>
                                    <div x-data="{ modal: false }">
                                        <button x-on:click="modal =! modal; dropdowns = false" class="flex items-center w-full py-3 px-4 text-lg leading-6 text-gray-700 hover:text-gray-900 hover:bg-gray-100">
                                            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6 mr-3">
                                                <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z"></path>
                                                <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z"></path>
                                            </svg>
                                            Editar
                                        </button>
                                        <template x-teleport="body">
                                            @include('modules.products.edit')
                                        </template>
                                    </div>
                                    <div x-data="{ modal: false }">
                                        <button x-on:click="modal =! modal; dropdowns = false" class="flex items-center w-full py-3 px-4 text-lg leading-6 text-gray-700 hover:text-gray-900 hover:bg-gray-100">
                                            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6 mr-3">
                                                <path clip-rule="evenodd" fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"></path>
                                            </svg>
                                            Eliminar
                                        </button>
                                        <template x-teleport="body">
                                            @include('modules.products.delete')
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <dl class="py-4 px-6 text-lg leading-7">
                            <div class="flex justify-between gap-x-px py-3">
                                <dt class="text-gray-500">Código</dt>
                                <dd class="overflow-hidden w-28 font-medium text-gray-900 text-end whitespace-nowrap text-ellipsis">{{ $product->code }}</dd>
                            </div>
                            <div class="flex justify-between gap-x-px py-3 border-t-2 border-gray-100">
                                <dt class="text-gray-500">Referencia</dt>
                                <dd class="overflow-hidden w-28 font-medium text-gray-900 text-end whitespace-nowrap text-ellipsis">{{ $product->referenceName }}</dd>
                            </div>
                            <div class="flex justify-between gap-x-px py-3 border-t-2 border-gray-100">
                                <dt class="text-gray-500">Categoría</dt>
                                <dd class="overflow-hidden w-28 font-medium text-gray-900 text-end whitespace-nowrap text-ellipsis">{{ $product->categoryName }}</dd>
                            </div>
                            <div class="flex justify-between gap-x-px py-3 border-t-2 border-gray-100">
                                <dt class="text-gray-500">Proveedor</dt>
                                <dd class="overflow-hidden w-28 font-medium text-gray-900 text-end whitespace-nowrap text-ellipsis">{{ $product->first_name }} {{ $product->last_name }}</dd>
                            </div>
                            <div class="flex justify-between gap-x-px py-3 border-t-2 border-gray-100">
                                <dt class="text-gray-500">Servicio</dt>
                                <dd class="overflow-hidden w-28 font-medium text-gray-900 text-end whitespace-nowrap text-ellipsis">
                                    @if ($product->service == 1)
                                        Venta
                                    @elseif ($product->service == 2)
                                        Alquiler
                                    @endif
                                </dd>
                            </div>
                            <div class="flex justify-between gap-x-px py-3 border-t-2 border-gray-100">
                                <dt class="text-gray-500">Existencia</dt>
                                <dd class="overflow-hidden w-28 font-medium text-gray-900 text-end whitespace-nowrap text-ellipsis">{{ $product->existence }}</dd>
                            </div>
                            <div class="flex justify-between gap-x-px py-3 border-t-2 border-gray-100">
                                <dt class="text-gray-500">Descripción</dt>
                                <dd class="overflow-hidden w-28 font-medium text-gray-900 text-end whitespace-nowrap text-ellipsis">{{ $product->description }}</dd>
                            </div>
                            <div class="flex justify-between items-center gap-x-px py-3 border-t-2 border-gray-100">
                                <dt class="text-gray-500">Precio base</dt>
                                <dd class="flex items-center gap-x-2">
                                    <div class="py-1 px-2 text-base font-medium text-blue-700  bg-blue-50 rounded-lg ring-1 ring-inset ring-blue-700/10">{{ $product->discount }}%</div>
                                    <div class="overflow-hidden w-16 font-medium text-gray-900 text-end whitespace-nowrap text-ellipsis">${{ number_format($product->price, 0, '.', '.') }}</div>
                                </dd>
                            </div>
                            <div class="flex justify-between gap-x-px py-3 border-t-2 border-gray-100">
                                <dt class="text-gray-500">Precio final</dt>
                                <dd class="overflow-hidden w-28 font-medium text-gray-900 text-end whitespace-nowrap text-ellipsis">${{ number_format($product->price - $product->price * ($product->discount / 100), 0, '.', '.') }}</dd>
                            </div>
                        </dl>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@stop

@section('scripts')
    <script>
        function searchProducts(name, searchFilter) {
            return name.toLowerCase().includes(searchFilter.toLowerCase());
        }
    </script>
@stop
