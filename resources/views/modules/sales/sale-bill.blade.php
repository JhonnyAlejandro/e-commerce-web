<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <!-- Agrega el enlace al archivo de Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-cover bg-center pt-10"
    style="background-image: url('{{ asset('images/factura/fondo.jpg') }}'); background-size: 100% 100%;">
    <div>
        <div class="container mx-auto my-6 px-4">
            <div class="flex justify-center p-2">
                <div class="w-full lg:w-7/12 relative ">
                    <div class="bg-white shadow-md rounded-lg relative z-10 p-5">
                        <div class="absolute left-1/2 transform -translate-x-1/2 -top-8 w-2/4 h-16"
                            style="background-image: url('{{ asset('images/factura/arcoiris.png') }}');  background-size: 100% 100%;">
                        </div>

                        <div class="p-5 pt-12">

                            <p class="text-2xl text-center p-4">
                                <strong>INFLA TU DIVERSION CON NOSOTROS. CALI, COLOMBIA</strong>
                            </p>

                            <div class="border-gray-200 pt-4 mt-4 mb-8">
                                <div class="flex flex-col lg:flex-row">
                                    <div class="lg:w-1/2 mb-4 lg:mb-0">
                                        <div class="text-gray-800 mb-2 text-xl"
                                            style="text-transform: uppercase !important;">
                                            <strong>{{ $sale[0]->user_first_name }}</strong>
                                        </div>
                                        <div class="text-gray-500 mb-2 text-lg">{{ $sale[0]->email }}</div>
                                    </div>
                                    <div class="lg:w-1/2 text-left">
                                        <div class="text-gray-800 mb-2"><strong class="text-xl">FACT.
                                                {{ $sale[0]->sale_code }}</strong></div>
                                         <div class="text-gray-500 mb-1 text-sm">Emisión: {{ $sale[0]->created_at->format('d/m/Y H:i:s') }}</div>
                                        <div class="text-gray-500 text-sm">Fecha límite: {{ $sale[0]->created_at->addDays(7)->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-400"></div>
                            <div class="mt-8 pt-2 mb-8">
                                <div class="overflow-x-auto">
                                    <table class="w-full table-auto">
                                        <thead>
                                            <tr>
                                                <th class="text-gray-800 text-lg p-2 mb-3">NOMBRE</th>
                                                <th class="text-gray-800 text-lg p-2 mb-3">CANT.</th>
                                                <th class="text-gray-800 text-lg p-2 mb-3">PRECIO</th>
                                                @if ($sale->contains('service', 2)) {{-- Verificar si hay productos de tipo "alquiler" --}}
                                                    <th class="text-gray-800 text-lg p-2 mb-3">F. DE INICIO</th>
                                                    <th class="text-gray-800 text-lg p-2 mb-3">F. DE FIN</th>
                                                @else {{-- Si no hay productos de tipo "alquiler", mostrar celdas simuladas --}}
                                                    <th class="text-gray-800 text-lg p-2 mb-3 w-1/4"></th>
                                                    <th class="text-gray-800 text-lg p-2 mb-3 w-1/4"></th>
                                                @endif
                                            </tr>
                                        </thead>





                                        <tbody>
                                            @foreach ($sale as $item)
                                                <tr>
                                                    <td class="px-4 py-2 text-gray-500 text-base">{{ $item->name }}</td>
                                                    <td class="px-4 py-2 text-gray-500 text-base">{{ $item->quantity }}</td>
                                                    <td class="px-4 py-2 text-gray-500 text-base">{{ $item->total_price }}</td>
                                                    @if ($sale->contains('service', 2)) {{-- Verificar si hay productos de tipo "alquiler" --}}
                                                        <td class="px-4 py-2 text-gray-500 text-base">
                                                            @if ($item->service == 2) {{-- Verificar si el servicio es de tipo "alquiler" --}}
                                                                <?php
                                                                // Establecer la zona horaria local
                                                                date_default_timezone_set('America/Bogota');
                                                                // Formatear la fecha en hora local en formato de 12 horas
                                                                echo date('d/m/Y', strtotime($item->start_date));
                                                                ?>
                                                                <br>
                                                                <?php
                                                                // Obtener la hora en formato de 12 horas
                                                                $startHour = date('h', strtotime($item->start_date));
                                                                $startMinute = date('i', strtotime($item->start_date));
                                                                $startAmPm = date('A', strtotime($item->start_date));
                                                                // Formatear y mostrar la hora en formato de 12 horas
                                                                echo "$startHour:$startMinute $startAmPm";
                                                                ?>
                                                            @endif
                                                        </td>
                                                        <td class="px-4 py-2 text-gray-500 text-base">
                                                            @if ($item->service == 2) {{-- Verificar si el servicio es de tipo "alquiler" --}}
                                                                <?php
                                                                // Establecer la zona horaria local
                                                                date_default_timezone_set('America/Bogota');
                                                                // Formatear la fecha en hora local en formato de 12 horas
                                                                echo date('d/m/Y', strtotime($item->finish_date));
                                                                ?>
                                                                <br>
                                                                <?php
                                                                // Obtener la hora en formato de 12 horas
                                                                $finishHour = date('h', strtotime($item->finish_date));
                                                                $finishMinute = date('i', strtotime($item->finish_date));
                                                                $finishAmPm = date('A', strtotime($item->finish_date));
                                                                // Formatear y mostrar la hora en formato de 12 horas
                                                                echo "$finishHour:$finishMinute $finishAmPm";
                                                                ?>
                                                            @endif
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>







                                </div>

                                <div class="flex justify-end mt-2 pl-4">
                                    <div class="text-gray-800 font-bold mr-10"> <!-- Aumentamos el tamaño del texto -->
                                        TOTAL:
                                    </div>
                                    <div class="text-gray-500 text-base  mr-2">
                                        {{$sale[0]->total_sale }}
                                    </div>
                                </div>

                            </div>

                            <div class="h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-400"></div>

                            <p class="text-gray-800 text-xl pt-8">
                                <strong>DATOS DE ENVIO:</strong>
                            </p>
                            @if (count($sale) > 0)
                            @if ($sale[0]->first_name)
                            <div class="pt-5 mb-8 space-y-4">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                    <p class=" text-gray-500 text-base">Nombre Completo: {{ $sale[0]->first_name }} {{ $sale[0]->last_name }}</p>
                                </div>

                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                    </svg>
                                    <p class=" text-gray-500 text-base">Cédula:{{ $sale[0]->identification_card }}</p>
                                </div>

                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
                                    </svg>
                                    <p class=" text-gray-500 text-base">Dirección:{{ $sale[0]->address }}</p>
                                </div>

                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.500M6.75 7.364V3h-3v18m3-13.636l10.5-3.819" />
                                    </svg>
                                    <p class=" text-gray-500 text-base">Apartamento, local, etc.:{{ $sale[0]->second_address }}
                                    </p>
                                </div>

                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>

                                    <p class=" text-gray-500 text-base">Departamento: {{ $sale[0]->department_name }}</p>
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                    </svg>
                                    <p class="text-gray-500 text-base">Celular:{{ $sale[0]->phone }}</p>
                                </div>
                                @endif
                                @else
                                <p>No hay datos de venta disponibles.</p>
                                @endif
                            </div>

                            <div class="h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-400"></div>

                            <div class="flex pt-16 pb-2 flex-col lg:flex-row">
                                <div class="lg:w-1/2 mr-32 lg:mr-32">
                                    <p class="text-gray-800 text-xl pb-2">
                                        <strong>ARCOIRIS KIDS</strong>
                                    </p>
                                    <div class="text-gray-500 mb-1 text-xl pb-2">Diversion y entretenimiento</div>
                                    <div class="text-gray-500 text-sm"></div>
                                </div>

                                <div class="lg:w-1/2 ">
                                    <img src="{{ asset('images/factura/gracias.jpeg') }}" width="200" height="200">
                                </div>

                            </div>

                            <a href="{{ route('home') }}"
                                class="bg-blue-900 text-white btn-lg text-sm hover:shadow-lg flex items-center justify-center uppercase font-semibold transition duration-300 ease-in-out mt-4 mx-5 mb-5">
                                ir a la pagina de nuevo
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
