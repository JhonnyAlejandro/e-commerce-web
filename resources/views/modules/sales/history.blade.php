@extends('dashboard')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <div class="bg-white shadow-lg rounded-lg">
        <div class="py-5 px-6 border-gray-200 border-b-2">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-semibold">Historial de pedidos</h2>
                <form action="{{ route('sales.history') }}" method="GET">

                    <div class="relative flex items-center">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">

                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                            </svg>
                        </span>

                        <input type="date" name="start_date"
                            class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg bg-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            placeholder="Start Date">

                        <input type="date" name="end_date"
                            class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg bg-white placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            placeholder="End Date">
                        <button type="submit" class="ml-2 px-4 py-2 bg-indigo-500 text-white rounded-lg">Buscar</button>
                        <button class="ml-2 px-4 py-2 bg-indigo-500 text-white rounded-lg"
                            href="{{ route('history.index') }}">Refrescar</button>
                    </div>
                </form>

            </div>
        </div>

        @foreach ($salesHistory as $sale)
            <div class="py-12 px-8 space-y-20">
                <div>
                    <div class="py-6 px-4 bg-gray-50 rounded-lg md:px-6">
                        <dl
                            class="text-lg text-gray-600 space-y-6 divide-gray-200 divide-y-2 md:grid md:grid-cols-5 md:gap-x-6 md:space-y-0 md:divide-y-0 xl:gap-x-8">
                            <div class="flex justify-between md:block">
                                <dt class="font-semibold text-gray-900">Código</dt>
                                <dd class="md:mt-1">{{ $sale->code }}</dd>
                            </div>
                            <div class="flex justify-between pt-6 md:block md:pt-0">
                                <dt class="font-semibold text-gray-900">Usuario</dt>
                                <dd class="md:mt-1">{{ $sale->user_first_name }}</dd>
                            </div>
                            <div class="flex justify-between pt-6 md:block md:pt-0">
                                <dt class="font-semibold text-gray-900">Método de pago</dt>
                                <dd class="md:mt-1">{{ $sale->payment_method_name }}</dd>
                            </div>
                            <div class="flex justify-between pt-6 md:block md:pt-0">
                                <dt class="font-semibold text-gray-900">Fecha de venta</dt>
                                <dd class="md:mt-1">{{ $sale->created_at->format('F d, Y') }}</dd>
                            </div>
                            <div class="flex justify-between pt-6 md:block md:pt-0">
                                <dt class="font-semibold text-gray-900">Precio total</dt>
                                <dd class="md:mt-1">${{ $sale->total_sale }}</dd>
                            </div>
                        </dl>
                    </div>
                    <table class="w-full mt-4 text-gray-500">
                        <thead class="sr-only text-lg text-gray-500 text-left md:not-sr-only">
                            <tr>
                                <th scope="col" class="w-2/5 py-3 pr-8 font-normal xl:w-1/3">Producto</th>
                                <th scope="col" class="hidden w-1/5 py-3 pr-8 font-normal md:table-cell">Precio</th>
                                @if (!$sale->fecha_inicio == null)
                                    <th scope="col" class="w-2/5 py-3 pr-8 font-normal xl:w-1/3">Fecha de servicio</th>
                                @endif
                                <th scope="col" class="hidden py-3 pr-8 font-normal md:table-cell">Estado</th>
                                <th scope="col" class="hidden py-3 pr-8 font-normal md:table-cell">Información</th>
                                <th scope="col" class="hidden py-3 pr-8 font-normal md:table-cell">Datos de envio</th>
                            </tr>
                        </thead>
                        <tbody class="text-lg border-gray-200 border-b-2 md:border-t-2">
                            <tr>
                                <td class="py-6 pr-8">
                                    <div class="flex items-center">
                                        <img src="{{ asset($sale->image) }}" alt="{{ $sale->name }}"
                                            class="w-16 h-16 rounded">
                                        <div>
                                            <p class="font-semibold pl-4 text-gray-900">{{ $sale->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="hidden py-6 pr-8 md:table-cell">{{ $sale->total_price }}</td>
                                @if (!$sale->fecha_inicio == null)
                                    <td class="hidden py-6 pr-8 md:table-cell">
                                        {{ \Carbon\Carbon::parse($sale->fecha_inicio)->isoFormat('MMM DD, YYYY, hh:mm a') }}</br>{{ \Carbon\Carbon::parse($sale->fecha_fin)->isoFormat('MMM DD, YYYY, hh:mm a') }}
                                    </td>
                                @endif
                                <td class="hidden py-6 pr-8 md:table-cell">{{ $sale->status_name }}</td>
                    
                                <td class="hidden py-6 pr-8 md:table-cell">
                                    @can('products.index')
                                        @if ($sale->status == 3)
                                        <button
                                            class="p-4 rounded-lg  text-white hover:bg-indigo-400 bg-indigo-600 agendar-button"
                                            data-sale-id="{{ $sale->sale_id }}">
                                            Agendar
                                        </button>
                                        @endif
                                    @endcan
                                </td>
                                <td x-data="{ modal: false, sale: {} }" class="hidden py-6 pr-8 md:table-cell">
                                    <button x-on:click="modal =! modal" class="text-indigo-600 hover:text-indigo-500">Ver <span class="hidden xl:inline">datos</span></button>
                                    <template x-teleport="body">
                                        @include('modules.sales.details-quickview')
                                    </template>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
    <script>

        var csrfToken = '{{ csrf_token() }}';
    
        document.addEventListener('DOMContentLoaded', function () {
    
          
    
            // Escucha el clic en el botón "Agendar"
            document.querySelectorAll('.agendar-button').forEach(function (button) {
                button.addEventListener('click', function () {
                    const saleId = this.getAttribute('data-sale-id');
    
                    // Muestra un SweetAlert para confirmar la acción
                    Swal.fire({
                        title: '¿Deseas agendar esta venta?',
                        text: 'Al dar "aceptar" se da por hecho que esta venta fue revisada y agendada',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, agendar',
                        cancelButtonText: 'Cancelar',
                        imageUrl: '{{ asset('images/alertas/agendar.png') }}',
                        imageWidth: 150, // Ancho de la imagen
                        imageHeight: 150, // Alto de la imagen
                        confirmButtonColor: '#8a2be2',
                    }).then((result) => {
                        if (result.isConfirmed) {
    
                            var requestData = {
                                saleId: saleId,
                                newStatusId: 1,
                            };
    
                            // Realiza una solicitud AJAX para actualizar el estado
                            fetch("{{ route('sales.change') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                },
                                body: JSON.stringify(requestData),
                            }).then((response) => {
                                // Verifica si la respuesta es un JSON válido
                                return response.json();
                            }).then((data) => {
                                if (data.success) {
                                    // Actualización exitosa
                                    Swal.fire(
                                        'Venta Agendada',
                                        'Esta venta fue agendada',
                                        'success'
                                    ).then(() => {
    
                                        location.reload();
                                        
                                    });
                                } else {
                                    // Error en la actualización
                                    Swal.fire(
                                        'Error',
                                        'No se pudo cambiar el estado de la venta.',
                                        'error'
                                    );
                                }
                            }).catch((error) => {
                                // Maneja errores en la solicitud AJAX
                                console.error('Error en la solicitud AJAX:', error);
                            });
                        }
                    });
                });
            });
        });
    </script>
@endsection