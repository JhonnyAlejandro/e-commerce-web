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
        <div class="p-6 w-full">
            <!-- Component Start  -->
            <div class="flex flex-col w-full border border-black">
                <div class="flex flex-shrink-0 bg-indigo-500 text-white">
                    <div class="flex items-center flex-grow w-0 h-10 px-2 border-b border-l border-black"><span>NOMBRE</span></div>
                    <div class="flex items-center flex-grow w-0 h-10 px-2 border-b border-l border-black"><span>CEDULA</span></div>
                    <div class="flex items-center flex-grow w-0 h-10 px-2 border-b border-l border-black"><span>CELULAR</span></div>
                    <div class="flex items-center flex-grow w-0 h-10 px-2 border-b border-l border-black"><span>DEPARTAMENTO</span></div>
                    <div class="flex items-center flex-grow w-0 h-10 px-2 border-b border-l border-black"><span>CIUDAD</span></div>
                    <div class="flex items-center flex-grow w-0 h-10 px-2 border-b border-l border-black"><span>DIRECCION</span></div>
                </div>
                <div class="overflow-auto">
                    <div class="flex flex-shrink-0">
                        <div class="flex items-center flex-grow w-0 h-10 px-2 border-b border-l border-black"><span>{{$sale->first_name}} {{$sale->last_name}}</span></div>
                        <div class="flex items-center flex-grow w-0 h-10 px-2 border-b border-l border-black"><span>{{$sale->identification_card}}</span></div>
                        <div class="flex items-center flex-grow w-0 h-10 px-2 border-b border-l border-black"><span>{{$sale->phone}}</span></div>
                        <div class="flex items-center flex-grow w-0 h-10 px-2 border-b border-l border-black"><span>{{$sale->department_name}}</span></div>
                        <div class="flex items-center flex-grow w-0 h-10 px-2 border-b border-l border-black"><span>{{$sale->city_name}}</span></div>
                        <div class="flex items-center flex-grow w-0 h-10 px-2 border-b border-l border-black"><span>{{$sale->address}}</span></div>
                    </div>
                </div>
            </div>
            <!-- Component End  -->
        </div>
    </div>
</x-modal>