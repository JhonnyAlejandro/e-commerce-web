<x-modal>
    <div x-data="{ isOpen: false }">
        <div class="relative w-full px-4">
            <button x-on:click="modal = false" type="button" class="absolute top-4 right-4 text-gray-400 hover:text-gray-500 md:top-8 md:right-6 xl:top-8 xl:right-8">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div class="p-6 border-gray-200 border-b-2">
                <h3 class="text-2xl font-semibold leading-7 text-center md:text-left">Datos de envío</h3>
            </div>
        </div>
        <div class="p-6 w-full overflow-x-auto">
            <!-- Component Start  -->
            <div class="flex flex-col w-full">
                <div class="shadow-md overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 bg-indigo-500 text-white">NOMBRE</th>
                                <th class="px-4 py-2 bg-indigo-500 text-white">CEDULA</th>
                                <th class="px-4 py-2 bg-indigo-500 text-white">CELULAR</th>
                                <th class="px-4 py-2 bg-indigo-500 text-white">DEPARTAMENTO</th>
                                <th class="px-4 py-2 bg-indigo-500 text-white">CIUDAD</th>
                                <th class="px-4 py-2 bg-indigo-500 text-white">DIRECCION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-2">{{$saleData['sale']->shipping_first_name}} {{$saleData['sale']->shipping_last_name}}</td>
                                <td class="px-4 py-2">{{$saleData['sale']->shipping_identification_card}}</td>
                                <td class="px-4 py-2">{{$saleData['sale']->shipping_phone}}</td>
                                <td class="px-4 py-2">{{$saleData['sale']->department_name}}</td>
                                <td class="px-4 py-2">{{$saleData['sale']->city_name}}</td>
                                <td class="px-4 py-2">{{$saleData['sale']->shipping_address}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Component End  -->
        </div>
    </div>
</x-modal>
