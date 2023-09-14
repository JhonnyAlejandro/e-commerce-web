@extends('layouts.layout')

@section('content')
    <div class="relative">
        <div class="absolute hidden inset-0 md:flex md:flex-col">
            <div class="relative flex-1 w-full bg-gray-800">
                <div class="absolute inset-0 overflow-hidden">
                    <img src="{{ asset('images/a.jpg') }}" class="w-full h-full object-cover object-center">
                </div>
                <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
            </div>
            <div class="w-full h-32 bg-white lg:h-40 xl:h-48"></div>
        </div>
        <div class="relative max-w-3xl mx-auto pb-96 px-4 pb-24 text-center md:px-6 md:pb-0 xl:px-8">
            <div class="absolute flex flex-col inset-0 md:hidden">
                <div class="relative flex-1 w-full bg-gray-800">
                    <div class="absolute inset-0 overflow-hidden">
                        <img src="{{ asset('images/a.jpg') }}" class="w-full h-full object-cover object-center">
                    </div>
                    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
                </div>
                <div class="w-full h-48 bg-white"></div>
            </div>
            <div class="relative pt-40 pb-24">
                <h1 class="text-4xl font-semibold text-white md:text-5xl lg:text-6xl">¡Viva!</h1>
            </div>
        </div>
        <section class="relative -mt-96 md:mt-0">
            <div class="grid grid-cols-1 gap-y-6 max-w-md mx-auto px-4 md:grid-cols-3 md:gap-y-0 md:gap-x-9 md:max-w-7xl md:px-6 xl:gap-x-8 xl:px-8">
                <div class="group relative h-96 bg-white rounded-lg shadow-xl md:h-auto md:aspect-[4/5]">
                    <div>
                        <div class="absolute overflow-hidden inset-0 rounded-lg">
                            <div class="absolute overflow-hidden inset-0 group-hover:opacity-75">
                                <img src="{{ asset('images/b.jpg') }}" class="w-full h-full object-cover object-center">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 flex items-end p-6 rounded-lg">
                            <div>
                                <p class="text-sm text-white">Venta y alquiler de</p>
                                <h3 class="mt-1 text-lg font-semibold text-white">
                                    <p>
                                        <span class="absolute inset-0"></span>
                                        Inflables
                                    </p>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="group relative h-96 bg-white rounded-lg shadow-xl md:h-auto md:aspect-[4/5]">
                    <div>
                        <div class="absolute overflow-hidden inset-0 rounded-lg">
                            <div class="absolute overflow-hidden inset-0 group-hover:opacity-75">
                                <img src="{{ asset('images/c.jpg') }}" class="w-full h-full object-cover object-center">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 flex items-end p-6 rounded-lg">
                            <div>
                                <p class="text-sm text-white">Organización de</p>
                                <h3 class="mt-1 text-lg font-semibold text-white">
                                    <p>
                                        <span class="absolute inset-0"></span>
                                        Fiestas y eventos
                                    </p>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="group relative h-96 bg-white rounded-lg shadow-xl md:h-auto md:aspect-[4/5]">
                    <div>
                        <div class="absolute overflow-hidden inset-0 rounded-lg">
                            <div class="absolute overflow-hidden inset-0 group-hover:opacity-75">
                                <img src="{{ asset('images/d.jpg') }}" class="w-full h-full object-cover object-center">
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 flex items-end p-6 rounded-lg">
                            <div>
                                <p class="text-sm text-white">Shows y espectáculos</p>
                                <h3 class="mt-1 text-lg font-semibold text-white">
                                    <p>
                                        <span class="absolute inset-0"></span>
                                        Para niños
                                    </p>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section>
        <div class="max-w-7xl mx-auto py-24 px-4 md:py-32 md:px-6 xl:px-8 xl:pt-32">
            <div class="md:flex md:justify-between md:items-center ">
                <h2 class="text-3xl font-semibold text-gray-900">Productos mas vendidos</h2>
                <a href="{{ route('store') }}" class="hidden text-lg font-bold text-indigo-600 hover:text-indigo-500 md:flex md:items-center">
                    Ir a la tienda
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-4 ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                    </svg>
                </a>
            </div>
            <div class="grid mt-6 grid-cols-2 gap-x-4 gap-y-10 md:gap-x-6 lg:grid-cols-4 lg:gap-y-0 xl:gap-x-8">
                @foreach ($products as $product)
                    <div x-data="{ modal: false, product: {} }" class="relative group">
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
@stop
