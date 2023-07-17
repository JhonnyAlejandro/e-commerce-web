<x-modal>
    <div class="relative flex items-center w-full pt-14 px-4 pb-8 md:pt-8 md:px-6 xl:p-8">
        <button x-on:click="modal = false" type="button" class="absolute top-4 right-4 text-gray-400 hover:text-gray-500 md:top-8 md:right-6 xl:top-8 xl:right-8">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 items-start w-full md:grid-cols-12 xl:gap-x-8">
            <div class="md:col-span-4 xl:col-span-5">
                <div class="overflow-hidden bg-gray-100 rounded-lg aspect-[1/1]">
                    <img src="{{ asset($product->image) }}" class="w-full h-full object-cover object-center">
                </div>
            </div>
            <div class="md:col-span-8 xl:col-span-7">
                <h2 class="text-3xl font-semibold text-gray-900 md:pr-12">{{ $product->name }}</h2>
                <section class="mt-3">
                    <p class="text-2xl font-medium text-gray-900">${{ $product->price }}</p>
                    <p class="mt-6 text-lg text-gray-700">{!! nl2br($product->description) !!}</p>
                </section>
                <section class="mt-6">
                    <form action="">
                        <div class="mt-6">
                            <x-button class="inline-flex justify-center w-full py-3 px-8">
                                <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 mr-3">
                                    <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"></path>
                                </svg>
                                {{ __('Agregar al carro') }}
                            </x-button>
                        </div>
                        <p class="absolute top-4 left-4 text-center md:static md:mt-6">
                            <a href="{{ route('productOverview', ['name' => Str::slug(Str::lower($product->name))]) }}" class="text-lg font-semibold text-indigo-600 hover:text-indigo-500">Ver detalles completos</a>
                        </p>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-modal>
