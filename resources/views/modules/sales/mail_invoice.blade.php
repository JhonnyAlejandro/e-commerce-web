<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
</head>

<body style="background-color: rgb(189, 187, 187);">
    <div style="background-color: white; margin: 0 auto; max-width: 500px; padding: 50px; position: relative; border-radius: 10px;">
        <div style="text-align: center; padding: 20px;">
            <strong style="font-size: 24px; ">INFLA TU DIVERSION CON NOSOTROS. CALI, COLOMBIA</strong>
        </div>

            <div>
                <div style="display: flex; flex-direction: row; justify-content: space-between; margin-top: 50px;">
                    <div style="flex-basis: 50%;">
                        <div style="font-size: 16px; text-transform: uppercase;"><strong>{{ $sale[0]->user_first_name }}</strong></div>
                        <div style="font-size: 14px; color: #888;">{{ $sale[0]->email }}</div>
                    </div>
                    <div style="flex-basis: 50%; text-align: left;">
                        <div style="font-size: 16px;"><strong>FACT. {{ $sale[0]->sale_code }}</strong></div>
                        <div style="font-size: 14px; color: #888;">Emisión: {{ $sale[0]->created_at->format('d/m/Y H:i:s') }}</div>
                        <div style="font-size: 14px; color: #888;">Fecha límite: {{ $sale[0]->created_at->addDays(7)->format('d/m/Y') }}</div>
                    </div>
                </div>
            </div>

            <div style="height: 4px; background: linear-gradient(to right, #00f, #800080, #ff69b4); margin-top: 25px; margin-bottom: 20; border-radius: 4px;"></div>


            <div style="margin-top: 30px; padding-top: 2px; margin-bottom: 15px;">
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="text-align: left; font-size: 16px; padding: 8px;">NOMBRE</th>
                                <th style="text-align: left; font-size: 16px; padding: 8px;">CANT.</th>
                                <th style="text-align: left; font-size: 16px; padding: 8px;">PRECIO</th>
                                @if ($sale->contains('service', 2))
                                    <th style="text-align: left; font-size: 16px; padding: 8px;">F. DE INICIO</th>
                                    <th style="text-align: left; font-size: 16px; padding: 8px;">F. DE FIN</th>
                                @else
                                    <th style="text-align: left; font-size: 16px; padding: 8px;"></th>
                                    <th style="text-align: left; font-size: 16px; padding: 8px;"></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale as $item)
                                <tr>
                                    <td style="font-size: 14px; padding: 8px;">{{ $item->name }}</td>
                                    <td style="font-size: 14px; padding: 8px;">{{ $item->quantity }}</td>
                                    <td style="font-size: 14px; padding: 8px;">{{ $item->total_price }}</td>
                                    @if ($sale->contains('service', 2))
                                        <td style="font-size: 14px; padding: 8px;">
                                            @if ($item->service == 2)
                                                <?php
                                                date_default_timezone_set('America/Bogota');
                                                echo date('d/m/Y', strtotime($item->start_date));
                                                ?>
                                                <br>
                                                <?php
                                                $startHour = date('h', strtotime($item->start_date));
                                                $startMinute = date('i', strtotime($item->start_date));
                                                $startAmPm = date('A', strtotime($item->start_date));
                                                echo "$startHour:$startMinute $startAmPm";
                                                ?>
                                            @endif
                                        </td>
                                        <td style="font-size: 14px; padding: 8px;">
                                            @if ($item->service == 2)
                                                <?php
                                                date_default_timezone_set('America/Bogota');
                                                echo date('d/m/Y', strtotime($item->finish_date));
                                                ?>
                                                <br>
                                                <?php
                                                $finishHour = date('h', strtotime($item->finish_date));
                                                $finishMinute = date('i', strtotime($item->finish_date));
                                                $finishAmPm = date('A', strtotime($item->finish_date));
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

                <div style="display: flex; justify-content: flex-end; margin-top: 2px; padding-left: 8px;">
                    <div style="font-size: 16px; font-weight: bold; margin-right: 10px;">TOTAL:</div>
                    <div style="font-size: 14px; color: #888;">{{ $sale[0]->total_sale }}</div>
                </div>
            </div>

            <div style="height: 4px; background: linear-gradient(to right, #00f, #800080, #ff69b4); margin-top: 25px; border-radius: 4px;"></div>

            <div style="text-align: left; font-size: 16px; padding-top: 45px;">
                <strong>DATOS DE ENVIO:</strong>
            </div>

            @if (count($sale) > 0)
                @if ($sale[0]->first_name)
                    <div style="padding-top: 20px; margin-bottom: 20px;">
                        <div style="font-size: 14px; display: flex; align-items: center; margin-bottom: 10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" style="width: 24px; height: 24px; margin-right: 10px;">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <div style="font-size: 16px; color: #333;">Nombre Completo: {{ $sale[0]->first_name }} {{ $sale[0]->last_name }}</div>
                        </div>

                        <div style="font-size: 14px; display: flex; align-items: center; margin-bottom: 10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" style="width: 24px; height: 24px; margin-right: 10px;">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                            </svg>
                            <div style="font-size: 16px; color: #333;">Cédula: {{ $sale[0]->identification_card }}</div>
                        </div>

                        <div style="font-size: 14px; display: flex; align-items: center; margin-bottom: 10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" style="width: 24px; height: 24px; margin-right: 10px;">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
                            </svg>
                            <div style="font-size: 16px; color: #333;">Dirección: {{ $sale[0]->address }}</div>
                        </div>
                        <div style="font-size: 14px; display: flex; align-items: center; margin-bottom: 10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" style="width: 24px; height: 24px; margin-right: 10px;">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.500M6.75 7.364V3h-3v18m3-13.636l10.5-3.819" />
                            </svg>
                            <div style="font-size: 16px; color: #333;">Apartamento, local, etc.: {{ $sale[0]->second_address }}</div>
                        </div>
                        <div style="font-size: 14px; display: flex; align-items: center; margin-bottom: 10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" style="width: 24px; height: 24px; margin-right: 10px;">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            <div style="font-size: 16px; color: #333;">Departamento: {{ $sale[0]->department_name }}</div>
                        </div>
                        <div style="font-size: 14px; display: flex; align-items: center; margin-bottom: 10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" style="width: 24px; height: 24px; margin-right: 10px;">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                            </svg>
                            <div style="font-size: 16px; color: #333;"> Celular:{{ $sale[0]->phone }}</div>
                        </div>
                        <div style="font-size: 14px; display: flex; align-items: center; margin-bottom: 10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" style="width: 24px; height: 24px; margin-right: 10px;">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
                            </svg>
                            <div style="font-size: 16px; color: #333;">Ciudad: {{ $sale[0]->city_name}}</div>
                        </div>
                    </div>
                @else
                    <p style="font-size: 14px;">No hay datos de venta disponibles.</p>
                @endif
            @endif

            <div style="height: 4px; background: linear-gradient(to right, #00f, #800080, #ff69b4); margin-top: 35px; border-radius: 4px;"></div>

            <div style="display: flex; justify-content: center; flex-direction: row; padding-top:45px; padding-bottom: 2px; margin-botton: 25px;">
                <div style="flex-basis: 50%; margin-right: 32px;">
                    <p style="font-size: 16px; text-align: center;"><strong>ARCOIRIS KIDS</strong></p>
                    <div style="font-size: 14px; text-align: center;">Diversion y entretenimiento</div>
                </div>
                
            </div>

            <a href="{{ route('home') }}"
                style="background-color: rgb(12, 12, 105); color: #fff; text-align: center; font-size: 15px; text-transform: uppercase; font-weight: bold; text-decoration: none; padding: 10px; display: inline-block; margin-top: 30px; margin-left: 120px; margin-bottom: 5px; border-radius: 4px; cursor: pointer;">ir a la pagina de nuevo</a>
        </div>
    </div>
</body>

</html>