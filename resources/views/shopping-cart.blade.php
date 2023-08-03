<x-modal>
    <div class="relative flex flex-col w-full pt-6 pb-8 md:pb-6 xl:py-8">
        <div class="flex justify-between items-center px-4 md:px-6 xl:px-8">
            <h2 class="text-2xl font-semibold text-gray-900 md:text-3xl">Carro de compras</h2>
            <button x-on:click="modal = false" type="button" class="text-gray-400 hover:text-gray-500">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <section>
            <ul class="px-4 divide-gray-200 divide-y-2 md:px-6 xl:px-8">
                <li class="flex py-8">
                    <div class="overflow-hidden w-24 h-24 rounded-md border-gray-200 border-2 md:w-32 md:h-32">
                        <img src="">
                    </div>
                    <div class="flex flex-1 flex-col ml-4 md:ml-6">
                        <div>
                            <div class="flex justify-between text-xl font-semibold text-gray-900">
                                <h3>Castillo dragón</h3>
                                <p class="ml-4">$490.200</p>
                            </div>
                            <p class="mt-1 text-lg text-gray-500">Alquiler - Inflables</p>
                        </div>
                        <div class="flex flex-1 justify-between items-end text-lg">
                            <p class="text-gray-500">Cantidad: 1</p>
                            <div class="flex">
                                <button class="font-semibold text-indigo-600 hover:text-indigo-500">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </section>
        <section class="md:px-6 xl:px-8">
            <div class="p-6 bg-gray-50 md:p-8 md:rounded-lg">
                <div class="flow-root">
                    <dl class="-my-4 text-lg divide-gray-200 divide-y-2">
                        <div class="flex justify-between items-center py-4">
                            <dt class="text-gray-600">Subtotal</dt>
                            <dd class="text-gray-600">$490.200</dd>
                        </div>
                        <div class="flex justify-between items-center py-4">
                            <dt class="text-xl font-semibold text-gray-900">Precio total</dt>
                            <dd class="text-xl font-semibold text-gray-900">$490.200</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </section>
        <div class="flex justify-end mt-8 px-4">
            <a href="#" class="inline-flex justify-center w-full py-3 px-8 text-lg font-semibold text-white bg-indigo-600 rounded-md hover:bg-indigo-500 md:w-auto">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path>
                </svg>
                Continuar con el pago
            </a>
        </div>
    </div>
</x-modal>
