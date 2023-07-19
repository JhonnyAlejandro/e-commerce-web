<x-modal>
    <div class="p-6 border-gray-200 border-b-2">
        <h3 class="text-2xl font-semibold leading-7 text-center md:text-left">Agregar un nuevo producto</h3>
    </div>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="py-5 px-6">
            @if ($errors->any())
                <x-alert>
                    <x-slot name="title">Se {{ $errors->count() > 1 ? 'encontraron' : 'encontró' }} {{ $errors->count() }} {{ $errors->count() > 1 ? 'errores' : 'error' }}:</x-slot>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </x-alert>
            @endif
            <div x-data="{ price: null, discount: null }" class="grid grid-cols-1 gap-x-6 gap-y-8 md:grid-cols-6">
                <div class="md:col-span-1">
                    <x-label for="code" value="{{ __('Código') }}" />
                    <x-input id="code" class="block mt-1 w-full" type="text" name="code" required />
                </div>
                <div class="md:col-span-5">
                    <x-label for="name" value="{{ __('Nombre') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" required />
                </div>
                <div class="md:col-span-2">
                    <x-label for="reference" value="{{ __('Referencia') }}" />
                    <x-select id="reference" class="block mt-1 w-full" name="reference" required>
                        <option value="" disabled selected hidden>Seleccione una categoría</option>
                        @foreach ($references as $reference)
                            <option value="{{ $reference->id }}">{{ $reference->name }}</option>
                        @endforeach
                    </x-select>
                </div>
                <div class="md:col-span-2">
                    <x-label for="category" value="{{ __('Categoría') }}" />
                    <x-select id="category" class="block mt-1 w-full" name="category" required>
                        <option value="" disabled selected hidden>Seleccione una categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </x-select>
                </div>
                <div class="md:col-span-2">
                    <x-label for="provider" value="{{ __('Proveedor') }}" />
                    <x-select id="provider" class="block mt-1 w-full" name="provider" required>
                        <option value="" disabled selected hidden>Seleccione un proveedor</option>
                        @foreach ($providers as $provider)
                            <option value="{{ $provider->id }}">{{ $provider->first_name }} {{ $provider->last_name }}</option>
                        @endforeach
                    </x-select>
                </div>
                <div class="md:col-span-2">
                    <x-label for="service" value="{{ __('Servicio') }}" />
                    <x-select id="service" class="block mt-1 w-full" name="service" required>
                        <option value="" disabled selected hidden>Seleccione un servicio</option>
                        <option value="1">Venta</option>
                        <option value="2">Alquiler</option>
                    </x-select>
                </div>
                <div class="md:col-span-1">
                    <x-label for="existence" value="{{ __('Existencia') }}" />
                    <x-input id="existence" class="block mt-1 w-full" type="text" name="existence" required />
                </div>
                <div class="md:col-span-2">
                    <x-label for="price" value="{{ __('Precio base') }}" />
                    <x-input x-model="price" id="price" class="block mt-1 w-full" type="text" name="price" required />
                </div>
                <div class="md:col-span-1">
                    <x-label for="discount" value="{{ __('Descuento') }}" />
                    <x-input x-model="discount" id="discount" class="block mt-1 w-full" type="text" name="discount" required />
                </div>
                <div class="md:col-span-full">
                    <p class="text-lg font-semibold text-gray-600">Precio final: <span x-text="(price - (price * discount / 100)).toLocaleString()"></span></p>
                </div>
                <div class="md:col-span-full">
                    <x-label for="description" value="{{ __('Descripción') }}" />
                    <x-textarea id="description" class="block mt-1 w-full" name="description" required />
                </div>
                <div class="md:col-span-full">
                    <x-label for="image" value="{{ __('Imagen') }}" />
                    <div class="flex justify-center mt-2 py-10 px-6 rounded-lg border-gray-900/[0.25] border-4 border-dashed">
                        <div class="text-center">
                            <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-16 h-16 mb-3 mx-auto text-gray-300">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"></path>
                            </svg>
                            <x-label for="image" class="text-indigo-600 cursor-pointer hover:text-indigo-500">
                                <span>Cargar un archivo</span>
                                <x-input id="image" class="sr-only" type="file" name="image" accept="image/*" />
                            </x-label>
                            <p class="text-lg leading-6 text-gray-700">PNG y JPG hasta 500KB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-3 px-4 bg-gray-50 md:flex md:flex-row-reverse md:px-6">
            <x-button type="submit" class="inline-flex justify-center w-full md:w-auto md:ml-3">
                {{ __('Agregar producto') }}
            </x-button>
            <x-secondary-button x-on:click="modal = false" type="button" class="inline-flex justify-center w-full mt-3 md:w-auto md:mt-0">
                {{ __('Cancelar') }}
            </x-secondary-button>
        </div>
    </form>
</x-modal>
