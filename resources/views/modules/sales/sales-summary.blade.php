<!--En esta vista se le hace al usuario un resumen de su compra con sus datos y aparece el boton de paypal que le permite pagar -->
@extends('layouts.layout')
@section('content')
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}&components=buttons"></script>
    <div class="justify-center items-center bg-gray-100 pt-20 pb-20 mx-4 md:mx-auto pl-4 pr-4" x-data="{ subtotal: {{ $subtotalGeneral }}, subtotalInUSD: {{ $subtotalInUSD }}, exchangeRate: {{ $exchangeRate }} }">
        <div class="max-w-8xl">

            <h1 class="mb-10 text-center text-3xl font-bold">Resumen de Compra</h1>

            <div class="flex flex-col md:flex-row md:space-x-6 xl:px-0">

            <!-- Dirección de envío -->

                <div class="rounded-lg w-full md:w-2/3 mx-auto max-w-5xl mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Datos de Envío</h3>
                        <div>
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                        <p class="text-gray-700"><span class="font-semibold">Nombre Completo: </span>{{ $form['first_name'] }}
                                            {{ $form['last_name'] }}</p>
                                    </div>

                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                        </svg>
                                        <p class="text-gray-700"><span class="font-semibold">Cédula:</span>
                                            {{ $form['cedula'] }}</p>
                                    </div>


                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
                                        </svg>
                                        <p class="text-gray-700"><span class="font-semibold">Dirección:</span>
                                            {{ $form['address'] }}</p>
                                    </div>


                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819" />
                                        </svg>
                                        <p class="text-gray-700"><span class="font-semibold">Apartamento, local, etc.:</span> {{ $form['address2'] }}
                                        </p>
                                    </div>

                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z" />
                                        </svg>
                                        <p class="text-gray-700"><span class="font-semibold">Ciudad:</span> {{ $form['city'] }}</p>
                                    </div>

                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>

                                        <p class="text-gray-700"><span class="font-semibold">Departamento:</span> {{ $form['departament'] }}</p>
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                        </svg>
                                        <p class="text-gray-700"><span class="font-semibold">Celular:</span> {{ $form['phone'] }}</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resumen de Compra -->
                <div class="bg-white p-5 rounded-lg w-full md:w-1/3 md:mt-0">

                    <!-- Detalles de los productos seleccionados -->

                    @foreach ($productInfo as $item)
                        <div class="flex items-center mb-4">
                            <div class="relative">
                                <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}"
                                    class="w-16 h-16 rounded">
                                <div
                                    class="absolute top-0 right-0 bg-gray-500 bg-opacity-95 rounded-full text-white w-6 h-6 flex items-center justify-center text-xs transform translate-x-1/2 -translate-y-1/2">
                                    {{ $item->productData['quantity'] }}
                                </div>
                            </div>
                            <div class="flex-grow ml-4">
                                <div class="flex justify-between">
                                    <div>
                                        <p class="text-lg font-semibold">{{ $item->product->name }}</p>
                                        @if (isset($item->productData['start_date']) || isset($item->productData['end_date']))
                                            <p class="text-sm text-gray-600">F. de inicio:
                                            {{ \Carbon\Carbon::parse($item->productData['start_date'])->isoFormat('MMM DD, YYYY, hh:mm a')}}</p>
                                            <p class="text-sm text-gray-600">F. de fin:
                                            {{ \Carbon\Carbon::parse($item->productData['end_date'])->isoFormat('MMM DD, YYYY, hh:mm a')}}</p>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        @if ($item->product->discount > 0)
                                            <p class="text-lg font-medium text-gray-500 line-through">
                                                ${{ number_format($item->product->sale_price, 0, '.', '.') }}</p>
                                            <p class="ml-2 text-lg font-medium text-gray-900">
                                                ${{ number_format($item->product->sale_price - $item->product->sale_price * ($item->product->discount / 100), 0, '.', '.') }}
                                            </p>
                                        @else
                                            <p class="text-lg font-bold text-gray-900">
                                                ${{ number_format($item->product->sale_price, 0, '.', '.') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Mostrar subtotal y total -->
                    <div class="mt-8">

                        <div class="mb-2 flex justify-between">
                            <p class="text-gray-700">Subtotal(COP)</p>
                            <p class="text-gray-700">${{ number_format($subtotalGeneral, 0, '.', '.') }}</p>
                        </div>
                        <div class="mb-2 flex justify-between">
                            <p class="text-gray-700">Subtotal (USD)</p>
                            <p class="text-gray-700" x-text="'$ ' + subtotalInUSD.toFixed(2) + ' USD'"></p>
                        </div>
                        <hr class="my-4" />
                        <div class="flex justify-between">
                            <p class="text-lg font-bold">Total</p>
                            <div class="flex flex-col items-end">
                                <p class="text-lg font-bold">Total: ${{ number_format($subtotalGeneral, 0, '.', '.') }}
                                </p>
                                <p class="text-sm text-gray-700">incluyendo IVA</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 max-w-2xl mx-auto">
                        <div id="paypal-button-container" class="max-w-full"
                            style="max-width: 1000px; position: sticky; bottom: 0;">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    var csrfToken = '{{ csrf_token() }}';

    paypal.Buttons({
        style: {
            disableMaxWidth: true
        },
        createOrder: function(data, actions) {
            var subtotal = '{{ $subtotalGeneral }}'; // Obtener el subtotal de la vista
            var formattedSubtotal = (subtotal / {{ $exchangeRate }}).toFixed(2);

            return actions.order.create({
                purchase_units: [{
                    amount: {
                        currency_code: 'USD', // Cambia esto a tu moneda local
                        value: formattedSubtotal, // Utiliza el subtotal que obtuviste de la vista
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            actions.order.capture().then(function(details) {
                console.log(details); // Para verificar los detalles capturados

                // Recopilar información del formulario de envío
                var formulario = {
                    email: "{{$form['email']}}",
                    first_name: "{{$form['first_name']}}",
                    last_name: "{{$form ['last_name']}}",
                    cedula: "{{$form['cedula']}}",
                    address: "{{$form ['address']}}",
                    address2: "{{$form ['address2']}}",
                    city: "{{$form['idCity']}}",
                    phone: "{{$form ['phone']}}"
                };


                // Obtener los productos
                var productsFromView = {!! json_encode($productInfo) !!};

                // Agregar datos adicionales
                var requestData = {
                    details: details,
                    products: productsFromView,
                    subtotal: '{{ $subtotalGeneral }}',
                    user_id: '{{ auth()->id() }}',
                    formulario: formulario
                };

                // Realizar la solicitud POST al controlador procesarOrden
                return fetch("{{ route('procesar.compra') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify(requestData), // Envía los detalles de PayPal y los datos adicionales
                    })
                    .then(function(response) {
                        if (response.ok) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Tu compra ha sido procesada',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            window.location.href = "{{ route('factura') }}";

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'viva petro',
                                text: 'Something went wrong!',
                                footer: '<a href="">Why do I have this issue?</a>'
                                })
                            }
                    })
                    .catch(function(error) {
                        console.error('Error during fetch:', error);
                    });
            });
        }
    }).render('#paypal-button-container');
</script>
@endsection
