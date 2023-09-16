<!--En esta vista se le da manejo al carro de compras mas en detalle, en este sitio se puede procesar la compra,
    tambien se muestra al usuarios cuanto debe pagar y se encuentra un formulario para llenar los datos del envio,
    todos  los campos con sus respectivas validaciones-->

@extends('layouts.layout')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <div class="bg-gray-100 pt-20 pb-20 mx-4 md:mx-auto" x-data="{ subtotal: {{ $subtotal }}, subtotalInUSD: {{ $subtotalInUSD }}, exchangeRate: {{ $exchangeRate }} }">
        <form action="{{ route('procesar.orden') }}" method="POST">
            @csrf
            <h1 class="mb-10 text-center text-2xl font-bold">Productos en el carrito</h1>
            <div class="mx-auto max-w-6xl justify-center px-6 md:flex md:space-x-6 xl:px-0 ">
                <div class="rounded-lg md:w-2/3">
                    <!-- Lista de productos en el carrito -->
                    <div>
                        @if ($products->isEmpty())
                            @include('components.empty-cart')
                        @else
                            @foreach ($products as $product)
                                @php
                                    $quantity = $productsCart[$product->id];
                                @endphp
                                <div
                                    class="relative justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start ">
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }} "
                                        class="w-60 h-60 rounded-lg p-1 object-cover" />
                                    <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                                        <div class="mt-5 sm:mt-0">
                                            <h2 class="text-lg font-bold text-gray-900">{{ $product->name }}</h2>
                                        </div>
                                        <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                                            <div class="absolute top-1 right-0 mt-2 mr-2">
                                                <a href="#"
                                                    @click="removeProduct('{{ route('cart.remove', $product->id) }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor"
                                                        class="h-5 w-5 cursor-pointer duration-150 hover:text-red-700">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </a>
                                            </div>
                                            @if ($product->service == 1)
                                                @if ($product->discount > 0)
                                                    @php
                                                        $discount = $product->sale_price - $product->sale_price * ($product->discount / 100);
                                                    @endphp

                                                    <div x-data="{ quantity: {{ $quantity }}, price: {{ $discount }}, maxQuantity: {{ $product->existence }} }" class="flex items-center border-gray-100">
                                                        <span
                                                            class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50"
                                                            @click="quantity > 1 ? (quantity--, subtotal -= price,  subtotalInUSD =  subtotal / exchangeRate) : ''"
                                                            :class="{ 'opacity-50 cursor-not-allowed': quantity === 1 }"
                                                            :disabled="quantity === 1">-</span>
                                                        <input
                                                            class="h-8 w-8 border bg-white text-center text-xs outline-none"
                                                            x-model="quantity" min="1" :max="maxQuantity"
                                                            readonly />
                                                        <span
                                                            class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50"
                                                            @click="quantity < maxQuantity ? (quantity++, subtotal += price, subtotalInUSD = subtotal / exchangeRate) : ''"
                                                            :class="{ 'opacity-50 cursor-not-allowed': quantity ===
                                                                maxQuantity }"
                                                            :disabled="quantity === maxQuantity">+</span>
                                                        <input type="hidden" name="product[{{ $product->id }}][quantity]"
                                                            x-bind:value="quantity" />
                                                    </div>
                                                @else
                                                    <div x-data="{ quantity: {{ $quantity }}, price: {{ $product->sale_price }}, maxQuantity: {{ $product->existence }} }" class="flex items-center border-gray-100">
                                                        <span
                                                            class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50"
                                                            @click="quantity > 1 ? (quantity--, subtotal -= price,  subtotalInUSD =  subtotal / exchangeRate) : ''"
                                                            :class="{ 'opacity-50 cursor-not-allowed': quantity === 1 }"
                                                            :disabled="quantity === 1">-</span>
                                                        <input
                                                            class="h-8 w-8 border bg-white text-center text-xs outline-none"
                                                            x-model="quantity" min="1" :max="maxQuantity"
                                                            readonly />
                                                        <span
                                                            class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50"
                                                            @click="quantity < maxQuantity ? (quantity++, subtotal += price , subtotalInUSD =  subtotal / exchangeRate) : ''"
                                                            :class="{ 'opacity-50 cursor-not-allowed': quantity ===
                                                                maxQuantity }"
                                                            :disabled="quantity === maxQuantity">+</span>
                                                        <input type="hidden" name="product[{{ $product->id }}][quantity]"
                                                            x-bind:value="quantity" />

                                                    </div>
                                                @endif
                                            @else
                                                <div>
                                                    <!--Selector de fechas -->
                                                    <div class="flex items-center border-gray-100 mb-5">
                                                        <label class="mr-2 text-xs font-bold text-gray-600">Seleccione fecha
                                                            y horarios <br> del servicio (7AM-10PM) <br>
                                                            (Al menos 8 dias de antelacion)
                                                        </label>
                                                    </div>
                                                    <div class="flex items-center border-gray-100 mb-2">
                                                        <label class="mr-2 text-xs text-gray-600">Fecha inicio:</label>
                                                    </div>
                                                    <div class="border border-gray-300 rounded-lg">
                                                        <input type="datetime-local"
                                                            class="h-8 w-auto bg-white text-center text-xs outline-none border rounded-lg"
                                                            name="product[{{ $product->id }}][start_date]"
                                                            id="start-date" />
                                                    </div>
                                                    @error("product.{$product->id}.start_date")
                                                        <p class="text-red-500 text-xs">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <div class="flex items-center border-gray-100 mb-2">
                                                        <label class="mr-2 text-xs text-gray-600">Fecha fin:</label>
                                                    </div>
                                                    <div class="border border-gray-300 rounded-lg">
                                                        <input type="datetime-local"
                                                            class="h-8 w-auto bg-white text-center text-xs outline-none border rounded-lg"
                                                            name="product[{{ $product->id }}][end_date]" id="end-date" />
                                                    </div>
                                                    @error("product.{$product->id}.end_date")
                                                        <p class="text-red-500 text-xs">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <!--Fin  selector de fechas-->
                                                <input type="hidden" name="product[{{ $product->id }}][quantity]"
                                                    value="1" />
                                            @endif
                                            <div class="flex justify-end">
                                                @if ($product->discount > 0)
                                                    <p class="text-lg font-medium text-gray-500 line-through">
                                                        ${{ number_format($product->sale_price, 0, '.', '.') }}</p>
                                                    <p class="ml-2 text-lg font-medium text-gray-900">
                                                        ${{ number_format($product->sale_price - $product->sale_price * ($product->discount / 100), 0, '.', '.') }}
                                                    </p>
                                                @else
                                                    <p class="text-lg font-bold text-gray-900">
                                                        ${{ number_format($product->sale_price, 0, '.', '.') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Contenedor padre para Subtotal y Comentario -->
                @unless ($products->isEmpty())
                    <div class="md:flex md:flex-col md:space-y-6 md:w-1/3 md:ml-6 md:mt-0">
                        <!-- Inicio cuadro Subtotal -->
                        <div class="h-full rounded-lg  border bg-white p-6 shadow-md">
                            <div class="mb-2 flex justify-between">
                                <p class="text-gray-700">Subtotal (COP)</p>
                                <p class="text-gray-700" x-text="'$' + subtotal.toLocaleString('es-CO')"></p>
                            </div>
                            <div class="mb-2 flex justify-between">
                                <p class="text-gray-700">Subtotal (USD)</p>
                                <p class="text-gray-700" x-text="'$ ' + subtotalInUSD.toFixed(2) + ' USD'"></p>
                            </div>

                            <hr class="my-4" />
                            <div class="flex justify-between">
                                <p class="text-lg font-bold">Total</p>
                                <div class="flex flex-col items-end">
                                    <p class="text-lg font-bold" x-text="'$' + subtotal.toLocaleString('es-CO') + ' COP'"></p>
                                    <p class="text-sm text-gray-700">incluyendo IVA</p>
                                </div>
                            </div>
                            <!--If de comprobacion de logueo-->
                            @if (auth()->check())
                                <input type="hidden" name="subtotal" x-bind:value="subtotal" />
                                <input type="hidden" name="subtotalInUSD" x-bind:value="subtotalInUSD" />
                                <input type="hidden" name="exchangeRate" x-bind:value="exchangeRate" />
                                <button type="submit"
                                    class="mt-6 w-full rounded-md bg-indigo-700 py-1.5 font-medium text-blue-50 hover:bg-indigo-500 mb-4">Procesar
                                    Compra</button>
                                <a class="block px-2 py-2 text-indigo-600 hover:text-indigo-500 rounded text-center"
                                    href="{{ route('store') }}" role="button">
                                    Seguir comprando
                                    <span aria-hidden="true"> &rarr;</span>

                                </a>
                            @else
                                <div class="flex mt-6 p-4 bg-blue-50 rounded-md">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true" class="w-7 h-7 text-blue-400">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z">
                                        </path>
                                    </svg>
                                    <p class="ml-3 text-lg text-blue-700">Para poder comprar <a href="{{ route('login') }}"
                                            class="font-semibold underline hover:text-blue-600">inicia sesión</a> o <a
                                            href="{{ route('register') }}"
                                            class="font-semibold underline hover:text-blue-600">registrate</a>.</p>
                                </div>
                                <!--La siguiente linea de codigo devuelve la vista despues del logueo -->
                                @php
                                    session(['url.intended' => route('cart.index')]);
                                @endphp
                            @endif
                            </a>
                        </div>
                        <!-- Final cuadro Subtotal -->
                    </div>
                </div>

                <!--Inicio Formulario datos de envio -->
                <div class="mx-auto max-w-9xl justify-center px-6">
                    <div class="flex justify-center">
                        <div class="mt-12 h-full rounded-lg border bg-white p-1 shadow-md  md:w-4/5 xl:w-5/4 ">
                            <div class="relative mb-0 rounded-lg bg-white p-2">
                                <div class="address-fields space-y-5 bg-white p-6 rounded-md">
                                    <h1 class="font-semibold text-xl text-center">Datos de envío</h1>
                                    <div class="flex flex-col sm:flex-row sm:space-x-5">
                                        <div class="field flex-grow mb-4 sm:mb-0">
                                            <label class="field__label block font-semibold mb-1" for="checkout_shipping_address_first_name">Nombre*</label>
                                            <input placeholder="Nombre" class="field__input w-full p-2 border border-gray-300 rounded @error('first_name') border-red-500 @enderror" type="text" name="first_name" id="first_name" value="{{ old('first_name') }}">
                                            @error('first_name')
                                                <p class="text-red-500 text-xs">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="field flex-grow">
                                            <label class="field__label block font-semibold mb-1" for="checkout_shipping_address_last_name">Apellido*</label>
                                            <input placeholder="Apellido" class="field__input w-full p-2 border border-gray-300 rounded @error('last_name') border-red-500 @enderror" type="text" name="last_name" id="last_name" value="{{ old('last_name') }}">
                                            @error('last_name')
                                                <p class="text-red-500 text-xs">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="field mb-4">
                                        <label class="field__label block font-semibold mb-1" for="checkout_shipping_address_company">Cédula*</label>
                                        <input placeholder="Cédula" class="field__input w-full p-2 border border-gray-300 rounded @error('cedula') border-red-500 @enderror" type="text" pattern="[0-9]{10}" title="Ingresa una cédula válida de 10 dígitos" name="cedula" id="cedula" value="{{ old('cedula') }}">
                                        @error('cedula')
                                            <p class="text-red-500 text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="field mb-4">
                                        <label class="field__label block font-semibold mb-1" for="checkout_shipping_address_address1">Dirección*</label>
                                        <input placeholder="Dirección" class="field__input w-full p-2 border border-gray-300 rounded @error('address') border-red-500 @enderror" type="text" name="address" id="address" value="{{ old('address') }}">
                                        @error('address')
                                            <p class="text-red-500 text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="field mb-4">
                                        <label class="field__label block font-semibold mb-1" for="checkout_shipping_address_address2">Apartamento, local, etc.</label>
                                        <input placeholder="Apartamento, local, etc." class="field__input w-full p-2 border border-gray-300 rounded @error('address2') border-red-500 @enderror" type="text" name="address2" id="address2" value="{{ old('address2') }}">
                                        @error('address2')
                                            <p class="text-red-500 text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col sm:flex-row sm:space-x-4">
                                        <div class="field flex-grow mb-4 sm:mb-0">
                                            <label class="field__label block font-semibold mb-1" for="checkout_shipping_address_province">Departamento*</label>
                                            <select class="field__input w-full p-2 border border-gray-300 rounded @error('departament') border-red-500 @enderror" name="departament" id="departament">
                                                <option value="" disabled selected>Departamento</option>
                                                @foreach ($departaments as $departament)
                                                    <option value="{{ $departament->id }}">{{ $departament->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('departament')
                                                <p class="text-red-500 text-xs">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="field flex-grow">
                                            <label class="field__label block font-semibold mb-1" for="checkout_shipping_address_province">Ciudad*</label>
                                            <select class="field__input w-full p-2 border border-gray-300 rounded @error('city') border-red-500 @enderror" name="city" id="city">
                                                <option value="" disabled selected>Ciudad</option>
                                                <!-- Las opciones de ciudad se cargarán dinámicamente usando JavaScript -->
                                            </select>
                                            @error('city')
                                                <p class="text-red-500 text-xs">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="field__label block font-semibold mb-1" for="checkout_shipping_address_phone">Número de Celular (Con WhatsApp)*</label>
                                        <input placeholder="Número de Celular (Con WhatsApp)" class="field__input w-full p-2 border border-gray-300 rounded @error('phone') border-red-500 @enderror" type="tel" name="phone" id="phone" value="{{ old('phone') }}" pattern="[0-9]{10}">
                                        @error('phone')
                                            <p class="text-red-500 text-xs">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endunless
    </div>
    </form>
    <!--Fin formulario -->
    </div>
@endsection

@section('scripts')
    <script>
        //El siguiente script se encarga de Eliminar el producto del carrito mediante el boton X
        function removeProduct(url) {
            fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Realizar acciones después de eliminar el producto (por ejemplo, actualizar la vista)
                    console.log("Producto eliminado con éxito.");
                    // También podrías actualizar la vista manualmente aquí si es necesario
                    window.location.href = '{{ route('cart.index') }}';
                })
                .catch(error => {
                    console.error("Error al eliminar el producto:", error);
                });
        }
    </script>

    <script>
        const getCityUrl =
        "{{ route('get.cities', ['departamentId' => ':departamentId']) }}"; // :departamentId será reemplazado con el valor real

        document.getElementById('departament').addEventListener('change', function() {
            var selectedDepartamentId = this.value;
            var citySelect = document.getElementById('city');
            citySelect.innerHTML =
            '<option value="" disabled selected>Ciudad</option>'; // Limpiar las opciones actuales

            // Si se selecciona un departamento, hacer una llamada al servidor para obtener las ciudades
            if (selectedDepartamentId) {
                const url = getCityUrl.replace(':departamentId', selectedDepartamentId);

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(city => {
                            var option = document.createElement('option');
                            option.value = city.id;
                            option.text = city.name;
                            citySelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error al obtener las ciudades:', error);
                    });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const citySelect = document.getElementById('city');

            citySelect.addEventListener('change', function() {
                const selectedCity = citySelect.value;

                if (selectedCity !== '150' && selectedCity !== '639') {
                    Swal.fire({
                        title: 'Lo sentimos, destino no disponible',
                        text: 'Estimado usuario, por el momento solo contamos con cobertura en el valle del cauca a las ciudades de Cali y Palmira',
                        imageUrl: '{{ asset('images/alertas/cara-triste.png.png') }}', // URL de la imagen
                        imageWidth: 150, // Ancho de la imagen
                        imageHeight: 150, // Alto de la imagen
                        confirmButtonText: 'Entiendo',
                        confirmButtonColor: '#8a2be2',
                    }).then(() => {
                        citySelect.value = ''; // Esto deseleccionará la opción en el select
                    });
                }
            });
        });
    </script>

    <script>
        // Obtén la fecha actual
        var currentDate = new Date();

        // Calcula la fecha mínima permitida (8 días a partir de hoy)
        var minDate = new Date();
        minDate.setDate(currentDate.getDate() + 8);

        // Formatea la fecha mínima en un formato que acepta input type="datetime-local"
        var minDateFormatted = minDate.toISOString().slice(0, 16);

        // Establece la fecha mínima en ambos campos de entrada de fecha
        document.getElementById("start-date").setAttribute("min", minDateFormatted);
        document.getElementById("end-date").setAttribute("min", minDateFormatted);
    </script>



    <script>
        // Obtén la fecha actual
        var currentDate = new Date();

        // Calcula la fecha mínima permitida (8 días a partir de hoy)
        var minDate = new Date();
        minDate.setDate(currentDate.getDate() + 8);

        // Formatea la fecha mínima en un formato que acepta input type="datetime-local"
        var minDateFormatted = minDate.toISOString().slice(0, 16);

        // Establece la fecha mínima en ambos campos de entrada de fecha
        document.getElementById("start-date").setAttribute("min", minDateFormatted);
        document.getElementById("end-date").setAttribute("min", minDateFormatted);
    </script>

    <script>
        // Este script establece las horas mínimas y máximas entre las cuales se puede hacer un alquiler
        const startDateInput = document.getElementById('start-date');
        const endDateInput = document.getElementById('end-date');

        const validateTimeRange = () => {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);
            const minTime = new Date(startDate);
            const maxTime = new Date(startDate);

            // Verificar que las fechas estén dentro del rango de 8 días de anticipación
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            const minDate = new Date(today);
            minDate.setDate(today.getDate() + 8);

            // Establecer las horas mínimas y máximas permitidas (7 AM - 10 PM)
            minTime.setHours(7, startDate.getMinutes(), 0, 0); // Los minutos son iguales a los de startDate
            maxTime.setHours(22, startDate.getMinutes(), 0, 0); // Los minutos son iguales a los de startDate


            if (startDate < minTime || startDate > maxTime || endDate < minTime || endDate > maxTime) {
                Swal.fire({
                    title: 'Horario no válido',
                    text: 'El servicio de alquiler solo está disponible entre las 7AM y 10PM.',
                    imageUrl: '{{ asset('images/alertas/tiempo.png') }}',
                    imageWidth: 100, // Ancho de la imagen
                    imageHeight: 100, // Alto de la imagen
                    confirmButtonText: 'Entiendo',
                    confirmButtonColor: '#8a2be2',
                });

                startDateInput.value = '';
                endDateInput.value = '';
            }
        };

        startDateInput.addEventListener('change', validateTimeRange);
        endDateInput.addEventListener('change', validateTimeRange);

        const setEndDate = () => {
            const startDate = moment(startDateInput.value);
            if (startDate.isValid()) {
                let hoursToAdd = 3; // Por defecto, agregamos 3 horas
                if (startDate.hour() === 20) { // Si la hora de inicio es 8 PM
                    if (startDate.minute() >= 1) { // Si es después de las 8:01 PM
                        hoursToAdd = 1;
                        Swal.fire({
                            title: 'Advertencia',
                            text: 'Aunque el tiempo del servicio sea menor al preestablecido el precio será el mismo',
                            imageUrl: '{{ asset('images/alertas/reloj.png') }}',
                            imageWidth: 100, // Ancho de la imagen
                            imageHeight: 100, // Alto de la imagen
                            confirmButtonText: 'Entiendo',
                            confirmButtonColor: '#8a2be2',
                        });
                    } else {
                        hoursToAdd = 2;
                        Swal.fire({
                            title: 'Advertencia',
                            text: 'Aunque el tiempo del servicio sea menor al preestablecido el precio será el mismo',
                            imageUrl: '{{ asset('images/alertas/reloj.png') }}',
                            imageWidth: 100, // Ancho de la imagen
                            imageHeight: 100, // Alto de la imagen
                            confirmButtonText: 'Entiendo',
                            confirmButtonColor: '#8a2be2',
                        });
                    }
                } else if (startDate.hour() === 21) { // Si la hora de inicio es 9 PM
                    hoursToAdd = 1;
                    Swal.fire({
                        title: 'Advertencia',
                        text: 'Aunque el tiempo del servicio sea menor al preestablecido el precio será el mismo',
                        imageUrl: '{{ asset('images/alertas/reloj.png') }}',
                        imageWidth: 100, // Ancho de la imagen
                        imageHeight: 100, // Alto de la imagen
                        confirmButtonText: 'Entiendo',
                        confirmButtonColor: '#8a2be2',
                    });
                }

                // Verificar si la hora de inicio supera la hora máxima permitida (10 PM)
                if (startDate.hour() === 22 || (startDate.hour() === 21 && startDate.minute() > 0)) {
                    Swal.fire({
                        title: 'Horario no válido',
                        text: 'La hora de finalizacion del servicio no puede ser después de las 10 PM.',
                        imageUrl: '{{ asset('images/alertas/tiempo.png') }}',
                        imageWidth: 100, // Ancho de la imagen
                        imageHeight: 100, // Alto de la imagen
                        confirmButtonText: 'Entiendo',
                        confirmButtonColor: '#8a2be2',
                    });

                    startDateInput.value = '';
                    endDateInput.value = '';
                    return;
                }

                // Sumamos las horas adecuadas a la fecha de inicio
                const endDate = startDate.clone().add(hoursToAdd, 'hours').minutes(startDate
            .minutes()); // Los minutos son iguales a los de startDate
                endDateInput.value = endDate.format('YYYY-MM-DDTHH:mm');
            }
        };

        startDateInput.addEventListener('change', setEndDate);

        // Hacer que el input de fecha final sea readonly para evitar la edición de minutos
        endDateInput.addEventListener('focus', () => {
            endDateInput.setAttribute('readonly', 'readonly');
        });
    </script>
@endsection
