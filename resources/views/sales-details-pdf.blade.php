<html>
    <body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
        <h1 style="padding-bottom: 1.25rem; color: rgb(17, 24, 39);">Reportes de detalles de ventas</h1>
        <div style="border: rgba(0, 0, 0, 0.05) 2px solid; border-radius: 0.5rem;">
            <table style="min-width: 100%; border-collapse: collapse;">
                <thead style="padding-top: 0.875rem; padding-bottom: 0.875rem; text-align: center; background-color: rgb(243, 244, 246)">
                    <th style="padding-top: 0.875rem; padding-bottom: 0.875rem; color: rgb(17, 24, 39);">Usuario</th>
                    <th style="padding-top: 0.875rem; padding-bottom: 0.875rem; color: rgb(17, 24, 39);">Producto</th>
                    <th style="padding-top: 0.875rem; padding-bottom: 0.875rem; color: rgb(17, 24, 39);">F. inicio</th>
                    <th style="padding-top: 0.875rem; padding-bottom: 0.875rem; color: rgb(17, 24, 39);">F. fin</th>
                    <th style="padding-top: 0.875rem; padding-bottom: 0.875rem; color: rgb(17, 24, 39);">Cantidad</th>
                    <th style="padding-top: 0.875rem; padding-bottom: 0.875rem; color: rgb(17, 24, 39);">Precio total</th>
                    <th style="padding-top: 0.875rem; padding-bottom: 0.875rem; color: rgb(17, 24, 39);">F. creación</th>
                </thead>
                <tbody style="text-align: center;">
                    @foreach ($salesDetails as $item)
                        <tr>
                            <td style="padding-top: 1rem; padding-bottom: 1rem; color: rgb(107, 114, 128);">{{ $item->firstName }}</td>
                            <td style="padding-top: 1rem; padding-bottom: 1rem; color: rgb(107, 114, 128);">{{ $item->product }}</td>
                            <td style="padding-top: 1rem; padding-bottom: 1rem; color: rgb(107, 114, 128);">{{ \Carbon\Carbon::parse($item->start_date)->isoFormat('MM/DD/YYYY - hh:mm a') }}</td>
                            <td style="padding-top: 1rem; padding-bottom: 1rem; color: rgb(107, 114, 128);">{{ \Carbon\Carbon::parse($item->finish_date)->isoFormat('MM/DD/YYYY - hh:mm a') }}</td>
                            <td style="padding-top: 1rem; padding-bottom: 1rem; color: rgb(107, 114, 128);">{{ $item->quantity }}</td>
                            <td style="padding-top: 1rem; padding-bottom: 1rem; color: rgb(107, 114, 128);">${{ number_format($item->total_price, 0, '.', '.') }}</td>
                            <td style="padding-top: 1rem; padding-bottom: 1rem; color: rgb(107, 114, 128);">{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('MM/DD/YYYY - hh:mm a') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>
