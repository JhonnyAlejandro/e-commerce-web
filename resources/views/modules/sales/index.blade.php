@extends('dashboard')

@section('content')
    <div class="bg-white shadow-lg rounded-lg">
        <div class="py-5 px-6 border-gray-200 border-b-2">
            <h3 class="text-2xl font-semibold leading-7">Historial de ventas</h3>
        </div>
        <div class="py-12 px-8 space-y-20">
            <div>
                <div class="py-6 px-4 bg-gray-50 rounded-lg md:px-6">
                    <dl class="text-lg text-gray-600 space-y-6 divide-gray-200 divide-y-2 md:grid md:grid-cols-5 md:gap-x-6 md:space-y-0 md:divide-y-0 xl:gap-x-8">
                        <div class="flex justify-between md:block">
                            <dt class="font-semibold text-gray-900">Código</dt>
                            <dd class="md:mt-1">COD0123456</dd>
                        </div>
                        <div class="flex justify-between pt-6 md:block md:pt-0">
                            <dt class="font-semibold text-gray-900">Usuario</dt>
                            <dd class="md:mt-1">Jhonny Alejandro</dd>
                        </div>
                        <div class="flex justify-between pt-6 md:block md:pt-0">
                            <dt class="font-semibold text-gray-900">Método de pago</dt>
                            <dd class="md:mt-1">Mastercard</dd>
                        </div>
                        <div class="flex justify-between pt-6 md:block md:pt-0">
                            <dt class="font-semibold text-gray-900">Fecha de venta</dt>
                            <dd class="md:mt-1">agosto 09, 2023</dd>
                        </div>
                        <div class="flex justify-between pt-6 md:block md:pt-0">
                            <dt class="font-semibold text-gray-900">Precio total</dt>
                            <dd class="md:mt-1">$570.000</dd>
                        </div>
                    </dl>
                </div>
                <table class="w-full mt-4 text-gray-500">
                    <thead class="sr-only text-lg text-gray-500 text-left md:not-sr-only">
                        <tr>
                            <th scope="col" class="w-2/5 py-3 pr-8 font-normal xl:w-1/3">Producto</th>
                            <th scope="col" class="hidden w-1/5 py-3 pr-8 font-normal md:table-cell">Precio</th>
                            <th scope="col" class="hidden py-3 pr-8 font-normal md:table-cell">Estado</th>
                            <th scope="col" class="w-0 py-3 font-normal text-right">Información</th>
                        </tr>
                    </thead>
                    <tbody class="text-lg border-gray-200 border-b-2 md:border-t-2">
                        <tr>
                            <td class="py-6 pr-8">
                                <div class="flex items-center">
                                    <img src="" class="w-16 h-16 mr-6 rounded-md object-cover object-center">
                                    <div>
                                        <p class="font-semibold text-gray-900">Castillo dragón</p>
                                        <p class="mt-1 md:hidden">$570.000</p>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden py-6 pr-8 md:table-cell">$570.000</td>
                            <td class="hidden py-6 pr-8 md:table-cell">Completado</td>
                            <td class="py-6 font-semibold text-right whitespace-nowrap">
                                <a href="#" class="text-indigo-600 hover:text-indigo-500">Ver producto</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
