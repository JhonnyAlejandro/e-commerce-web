@extends('layouts.layout')

@section('content')
    <div x-data="{ searchFilter: '' }" class="max-w-7xl mx-auto px-4 md:px-6 xl:px-8">
        <div class="pt-24 pb-6 border-gray-200 border-b-2">
            <div class="xl:flex xl:justify-between xl:items-center">
                <h3 class="text-4xl font-semibold leading-7">Tienda</h3>
                <div class="flex mt-4 xl:mt-0 xl:ml-4">
                    <div class="relative grow z-10">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                            </svg>
                        </div>
                        <x-input x-model="searchFilter" type="text" class="h-full pl-12 xl:w-96" placeholder="Buscar..." />
                    </div>
                    <button class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 md:ml-6 xl:hidden">
                        <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M3.792 2.938A49.069 49.069 0 0112 2.25c2.797 0 5.54.236 8.209.688a1.857 1.857 0 011.541 1.836v1.044a3 3 0 01-.879 2.121l-6.182 6.182a1.5 1.5 0 00-.439 1.061v2.927a3 3 0 01-1.658 2.684l-1.757.878A.75.75 0 019.75 21v-5.818a1.5 1.5 0 00-.44-1.06L3.13 7.938a3 3 0 01-.879-2.121V4.774c0-.897.64-1.683 1.542-1.836z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <section class="pt-6 pb-32">
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 xl:grid-cols-4">
                <div class="hidden xl:block">
                    <div x-data="{ open: false, selectedCategories: [] }" class="py-6 border-gray-200 border-b-2">
                        <h3 class="flow-root -my-3">
                            <button x-on:click="open =! open" type="button" class="flex justify-between items-center w-full py-3 text-gray-400 hover:text-gray-500">
                                <span class="text-lg font-semibold text-gray-900">Categoría</span>
                                <span class="flex items-center ml-6">
                                    <svg x-bind:class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-5 h-5 transition-transform duration-300 ease-in-out">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                                    </svg>
                                </span>
                            </button>
                        </h3>
                        <div x-show="open" x-transition.origin.top class="pt-6 space-y-4" style="display: none;">
                            @foreach ($categories as $category)
                                <div class="flex items-center">
                                    <x-checkbox x-model="selectedCategories" id="{{ $category->name }}" name="category" value="{{ $category->name }}" />
                                    <x-label for="{{ $category->name }}" class="ml-3" value="{{ $category->name }}" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div x-data="{ open: false, selectedServices: [] }" class="py-6 border-gray-200 border-b-2">
                        <h3 class="flow-root -my-3">
                            <button x-on:click="open =! open" type="button" class="flex justify-between items-center w-full py-3 text-gray-400 hover:text-gray-500">
                                <span class="text-lg font-semibold text-gray-900">Servicio</span>
                                <span class="flex items-center ml-6">
                                    <svg x-bind:class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-5 h-5 transition-transform duration-300 ease-in-out">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                                    </svg>
                                </span>
                            </button>
                        </h3>
                        <div x-show="open" x-transition.origin.top class="pt-6 space-y-4" style="display: none;">
                            <div class="flex items-center">
                                <x-checkbox x-model="selectedServices" id="sale" name="service" value="1" />
                                <x-label for="sale" class="ml-3" value="{{ __('Venta') }}" />
                            </div>
                            <div class="flex items-center">
                                <x-checkbox x-model="selectedServices" id="rent" name="service" value="2" />
                                <x-label for="rent" class="ml-3" value="{{ __('Alquiler') }}" />
                            </div>
                        </div>
                    </div>
                    <div x-data="{ open: false, selectedDiscount: [] }" class="py-6 border-gray-200 border-b-2">
                        <h3 class="flow-root -my-3">
                            <button x-on:click="open =! open" type="button" class="flex justify-between items-center w-full py-3 text-gray-400 hover:text-gray-500">
                                <span class="text-lg font-semibold text-gray-900">Precio de venta</span>
                                <span class="flex items-center ml-6">
                                    <svg x-bind:class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-5 h-5 transition-transform duration-300 ease-in-out">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                                    </svg>
                                </span>
                            </button>
                        </h3>
                        <div x-show="open" x-transition.origin.top class="pt-6 space-y-4" style="display: none;">
                            <div class="flex items-center">
                                <x-checkbox x-model="selectedDiscount" id="discount" name="discount" />
                                <x-label for="discount" class="ml-3" value="{{ __('Descuentos') }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-x-6 gap-y-10 md:grid-cols-2 xl:col-span-3 xl:gap-x-8">
                    @foreach ($products as $product)
                        <div x-data="{ modal: false, product: {}, selectedCategories: [], selectedServices: [], searchFilter: '' }" class="relative group" data-product-id="{{ $product->id }}">
                            <div class="overflow-hidden w-full h-56 rounded-md group-hover:opacity-75 xl:h-72">
                                <img src="{{ asset($product->image) }}" class="w-full h-full object-cover object-center">
                            </div>
                            <h3 class="mt-4 text-lg font-semibold text-gray-700">
                                <button x-on:click="modal =! modal">
                                    <span class="absolute inset-0"></span>
                                    {{ $product->name }}
                                </button>
                                <template x-teleport="body">
                                    @include('product-quickview')
                                </template>
                            </h3>
                            <p class="mt-1 text-md text-gray-500">
                                @if ($product->service == 1)
                                    Venta - {{ $product->categoryName }}
                                @elseif ($product->service == 2)
                                    Alquiler - {{ $product->categoryName }}
                                @endif
                            </p>
                            @if ($product->discount > 0)
                                <div class="flex items-center mt-1">
                                    <p class="text-lg font-medium text-gray-500 line-through">${{ number_format($product->sale_price, 0, '.', '.') }}</p>
                                    <p class="ml-2 text-lg font-medium text-gray-900">${{ number_format($product->sale_price - $product->sale_price * ($product->discount / 100), 0, '.', '.') }}</p>
                                </div>
                            @else
                                <p class="mt-1 text-lg font-medium text-gray-900">${{ number_format($product->sale_price, 0, '.', '.') }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@stop

@section('scripts')
    <script>
        function searchProducts(product, searchFilter, selectedCategories, selectedServices, selectedDiscount) {
            const nameMatch = product.name.toLowerCase().includes(searchFilter.toLowerCase());

            if (selectedCategories.length === 0 && selectedServices.length === 0 && !selectedDiscount) {
                return nameMatch;
            }

            const categoryMatch = selectedCategories.length === 0 || selectedCategories.includes(product.categoryName);
            const serviceMatch = selectedServices.length === 0 || selectedServices.includes(product.service.toString());
            const discountMatch = !selectedDiscount || (product.discount > 0);

            return nameMatch && categoryMatch && serviceMatch && discountMatch;
        }

        function getSelectedCheckboxes(categoryOrService) {
            const selected = [];
            document.querySelectorAll(`input[name="${categoryOrService}"]:checked`).forEach(input => {
                selected.push(input.value);
            });
            return selected;
        }

        function calculateFinalPrice(product) {
            if (product.discount > 0) {
                return product.sale_price - (product.sale_price * (product.discount / 100));
            } else {
                return product.sale_price;
            }
        }

        function applyFilter() {
            const selectedCategories = getSelectedCheckboxes('category');
            const selectedServices = getSelectedCheckboxes('service');
            const selectedDiscount = document.querySelector('input[name="discount"]').checked;
            const searchFilter = document.querySelector('input[type="text"]').value.toLowerCase();
            const products = @json($products);

            products.forEach(product => {
                const productElement = document.querySelector(`[data-product-id="${product.id}"]`);
                const shouldShow = searchProducts(product, searchFilter, selectedCategories, selectedServices,
                    selectedDiscount);
                productElement.style.display = shouldShow ? 'block' : 'none';
            });
        }

        window.addEventListener('load', () => {
            applyFilter();
        });

        document.querySelectorAll('input[type="checkbox"]').forEach(input => {
            input.addEventListener('change', () => {
                applyFilter();
            });
        });

        document.querySelector('input[type="text"]').addEventListener('input', () => {
            applyFilter();
        });
    </script>
@stop
