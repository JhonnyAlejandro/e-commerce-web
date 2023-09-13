<div>
    <div x-data="{ isOpen: false }">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
        @php
            $total = 0;
    
        @endphp
    
        <!-- Botón para abrir el panel -->
        <button type="button" @click="isOpen = true" class="group flex items-center -m-2 p-2">
    
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="shrink-0 w-7 h-7 text-gray-400 group-hover:text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
            </svg>
            <span class="ml-2 text-lg font-medium text-gray-700">{{ $totalCantidad }}</span>
        </button>
    
        @if (Route::currentRouteName() != 'cart.index' && Route::currentRouteName() != 'procesar.orden')
        <!-- Panel deslizable -->
        <div x-show="isOpen" x-transition:enter="transition ease-in-out duration-500" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-500"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                    <div class="pointer-events-auto w-screen max-w-md">
                        <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                            <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Carrito de compra</h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button @click="isOpen = false" type="button"
                                            class="-m-2 p-2 text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">Close panel</span>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
    
                                <div class="mt-8">
                                    <div class="flow-root">
                                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                                            <!-- Lista de productos -->
                                        @if ($productsCart->isEmpty())
                                             <x-empty-cart/>
                                         @else
    
                                            @foreach ($productsCart as $product)
                                                <li class="flex py-6">
                                                    <!-- Imagen del producto -->
                                                    <div
                                                        class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                                        <img src="{{ asset($product->image) }}"
                                                            alt="{{ $product['name'] }}."
                                                            class="h-full w-full object-cover object-center">
                                                    </div>
    
                                                    <!-- Detalles del producto -->
                                                    <div class="ml-4 flex flex-1 flex-col">
                                                        <div>
                                                            <div
                                                                class="flex justify-between text-base font-medium text-gray-900">
                                                                <h3>
                                                                    <a href="#">{{ $product['name'] }}</a>
                                                                </h3>
                                                                @if ($product->discount > 0)
                                                                    <p class="ml-4 text-lg font-medium text-gray-500 line-through">${{ number_format($product['sale_price'], 0, '.', '.') }}</p>
    
                                                                    <p class="ml-2 text-lg font-medium text-gray-900">${{number_format($product['sale_price'] - $product['sale_price'] * ($product['discount'] / 100), 0, '.', '.') }}</p>
                                                                @else
                                                                    <p class="ml-4">${{ number_format($product['sale_price'], 0, '.', '.') }}</p>
                                                                @endif
                                                            </div>
                                                            <p class="mt-1 text-sm text-gray-500">Salmon</p>
                                                        </div>
                                                        <div class="flex flex-1 items-end justify-between text-sm">
                                                            <p class="text-gray-500">Cantidad {{ $products[$product['id']] }}
                                                            </p>
    
                                                            <div class="flex">
                                                                <button type="button" wire:click="removeFromCart({{ $product->id }})"class="font-medium text-indigo-600 hover:text-indigo-500">Eliminar</button>
    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @php
                                                    $subtotal = $product['sale_price'] - $product['sale_price'] * $products[$product['id']] * ($product['discount'] / 100) ;
                                                    $total += $subtotal;
                                                @endphp
    
                                            @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
    
                            <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                                <div class="flex justify-between text-sm font-medium text-gray-900">
                                    <p>Subtotal</p>
                                    <p>${{ number_format($total, 0, '.', '.') }}</p>
                                </div>
                                <div class="flex justify-between text-xl font-bold text-gray-900 mt-2">
                                    <p>Total</p>
                                    <p>${{ number_format($total, 0, '.', '.') }} COP</p>
                                </div>
                                <p class="mt-0.5 text-sm text-gray-500">Gastos de envío e impuestos calculados en el momento de la compra.</p>
                                <div class="mt-6">
                                    <a wire:click="redirectToCart" href="#"
                                        class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">
                                        Ir al carrito</a>
                                </div>
                                <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                    <p>
                                        o
                                        <button @click="isOpen = false" type="button"
                                            class="font-medium text-indigo-600 hover:text-indigo-500">
                                            Seguir Comprando
                                            <span aria-hidden="true"> &rarr;</span>
                                        </button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    
</div>
