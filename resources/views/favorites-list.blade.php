<x-modal>
    @php
        $favorites = \App\Models\Favorite::join('products', 'favorites.product', '=', 'products.id')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->select('favorites.*', 'products.id as productId', 'products.image as productImage', 'products.name as productName', 'products.service as productService', 'categories.name as productCategory', 'products.sale_price as productSalePrice', 'products.discount as productDiscount')
            ->where('user', auth()->id())
            ->get();
    @endphp
    <div class="relative flex flex-col w-full pt-6 pb-8 md:pb-6 xl:py-8">
        <div class="flex justify-between items-center px-4 md:px-6 xl:px-8">
            <h2 class="text-2xl font-semibold text-gray-900 md:text-3xl">Lista de favoritos</h2>
            <button x-on:click="modal = false" type="button" class="text-gray-400 hover:text-gray-500">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <section>
            @if (auth()->check())
                @if ($favorites->isEmpty())
                    <p class="w-full pt-8 px-4 text-lg text-gray-500 md:px-6 xl:px-8">Parece que aún no has agregado ningún producto a tu lista de favoritos. ¡Explora nuestra selección y agrega tus productos favoritos ahora!</p>
                @else
                    <ul class="px-4 divide-gray-200 divide-y-2 md:px-6 xl:px-8">
                        @foreach ($favorites as $favorite)
                            <li class="flex py-8">
                                <div class="overflow-hidden w-24 h-24 rounded-md border-gray-200 border-2 md:w-32 md:h-32">
                                    <img src="{{ asset($favorite->productImage) }}" class="w-full h-full object-cover object-center">
                                </div>
                                <div class="flex flex-1 flex-col ml-4 md:ml-6">
                                    <div>
                                        <div class="flex justify-between text-xl font-semibold text-gray-900">
                                            <h3>{{ $favorite->productName }}</h3>
                                            <div class="block ml-4 md:flex md:items-center">
                                                <p class="font-medium text-gray-500 line-through">${{ number_format($favorite->productSalePrice, 0, '.', '.') }}</p>
                                                <p class="md:ml-2">${{ number_format($favorite->productSalePrice - $favorite->productSalePrice * ($favorite->productDiscount / 100), 0, '.', '.') }}</p>
                                            </div>
                                        </div>
                                        <p class="mt-1 text-lg text-gray-500">
                                            @if ($favorite->productService == 1)
                                                Venta - {{ $favorite->productCategory }}
                                            @elseif ($favorite->productService == 2)
                                                Alquiler - {{ $favorite->productCategory }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="flex flex-1 justify-between items-end text-lg">
                                        <p class="text-gray-500">{{ \Carbon\Carbon::parse($favorite->created_at)->isoFormat('MMM DD, YYYY') }}</p>
                                        <div class="flex">
                                            <form action="{{ route('favorites', ['product' => $favorite->productId]) }}" method="POST">
                                                @csrf
                                                <button class="font-semibold text-indigo-600 hover:text-indigo-500">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            @else
                <div class="flex mt-8 mx-4 p-4 bg-blue-50 rounded-md md:mx-6 xl:mx-8">
                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-blue-400">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"></path>
                    </svg>
                    <p class="ml-3 text-lg text-blue-700">Para agregar productos a la lista de favoritos debes <a href="{{ route('login') }}" class="font-semibold underline hover:text-blue-600">iniciar sesión</a> o <a href="{{ route('register') }}" class="font-semibold underline hover:text-blue-600">registrarse</a>.</p>
                </div>
            @endif
        </section>
    </div>
</x-modal>
