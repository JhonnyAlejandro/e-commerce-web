<x-modal>
    <div class="p-6 border-gray-200 border-b-2">
        <h3 class="text-2xl font-semibold leading-7 text-center md:text-left">Agregar un nuevo producto</h3>
    </div>
    <div class="py-5 px-6">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="py-6 px-4 md:col-span-1 md:px-0">
                <dt class="text-lg font-semibold leading-7 text-gray-900">Código</dt>
                <dd class="mt-2 text-lg leading-7 text-gray-700">{{ $product->code }}</dd>
            </div>
            <div class="py-6 px-4 border-gray-100 border-t-2 md:col-span-1 md:px-0 md:border-t-0">
                <dt class="text-lg font-semibold leading-7 text-gray-900">Nombre</dt>
                <dd class="mt-2 text-lg leading-7 text-gray-700">{{ $product->name }}</dd>
            </div>
            <div class="py-6 px-4 border-gray-100 border-t-2 md:col-span-1 md:px-0">
                <dt class="text-lg font-semibold leading-7 text-gray-900">Referencia</dt>
                <dd class="mt-2 text-lg leading-7 text-gray-700">{{ $product->reference }}</dd>
            </div>
            <div class="py-6 px-4 border-gray-100 border-t-2 md:col-span-1 md:px-0">
                <dt class="text-lg font-semibold leading-7 text-gray-900">Categoría</dt>
                <dd class="mt-2 text-lg leading-7 text-gray-700">{{ $product->category }}</dd>
            </div>
            <div class="py-6 px-4 border-gray-100 border-t-2 md:col-span-1 md:px-0">
                <dt class="text-lg font-semibold leading-7 text-gray-900">Servicio</dt>
                <dd class="mt-2 text-lg leading-7 text-gray-700">
                    @if ($product->service == 1)
                        Venta
                    @elseif ($product->service == 2)
                        Alquiler
                    @endif
                </dd>
            </div>
            <div class="py-6 px-4 border-gray-100 border-t-2 md:col-span-1 md:px-0">
                <dt class="text-lg font-semibold leading-7 text-gray-900">Existencia</dt>
                <dd class="mt-2 text-lg leading-7 text-gray-700">{{ $product->existence }}</dd>
            </div>
            <div class="py-6 px-4 border-gray-100 border-t-2 md:col-span-1 md:px-0">
                <dt class="text-lg font-semibold leading-7 text-gray-900">Precio de venta</dt>
                <dd class="mt-2 text-lg leading-7 text-gray-700">${{ number_format($product->price, 0, '.', '.') }}</dd>
            </div>
            <div class="py-6 px-4 border-gray-100 border-t-2 md:col-span-1 md:px-0">
                <dt class="text-lg font-semibold leading-7 text-gray-900">Descuento</dt>
                <dd class="mt-2 text-lg leading-7 text-gray-700">{{ $product->discount }}%</dd>
            </div>
            <div class="py-6 px-4 border-gray-100 border-t-2 md:col-span-2 md:px-0">
                <dt class="text-lg font-semibold leading-7 text-gray-900">Descripción</dt>
                <dd class="mt-2 text-lg leading-7 text-gray-700">{!! nl2br($product->description) !!}</dd>
            </div>
        </div>
    </div>
    <div class="py-3 px-4 bg-gray-50 md:flex md:justify-end md:px-6">
        <x-secondary-button x-on:click="modal = false" type="button" class="inline-flex justify-center w-full mt-3 md:w-auto md:mt-0">
            {{ __('Cerrar') }}
        </x-secondary-button>
    </div>
</x-modal>
