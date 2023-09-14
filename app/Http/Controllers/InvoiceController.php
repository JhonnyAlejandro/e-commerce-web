<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Mail\FacturaEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\File;


class InvoiceController extends Controller
{
    public function checkout()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Lógica para determinar la venta a procesar y obtener su ID
        $sale = Sale::where('user', $user->id)
        ->join('sales_details', 'sales.id', '=', 'sales_details.sale')
        ->latest('sales.created_at')
        ->select('sales.*') // Seleccionar campos necesarios de la venta
        ->first();

        if (!$sale) {
            return redirect()->route('factura')->with('error', 'No hay ventas pendientes.');

        }

        // Obtener los detalles de la venta seleccionada
        $sale = Sale::join('users', 'sales.user', '=', 'users.id')
        ->join('sales_details', 'sales.id', '=', 'sales_details.sale')
        ->join('products', 'products.id', '=', 'sales_details.product')
        ->join('shipping_informations', 'sales.id', '=', 'shipping_informations.sale')
        ->join('cities', 'shipping_informations.city', '=', 'cities.id')
        ->leftJoin('departments', 'cities.department', '=', 'departments.id')
        ->where('sales.id', $sale->id)
        ->select(
            'users.first_name as user_first_name',
            'users.email',
            'sales.code as sale_code',
            'sales.created_at',
            'sales_details.*',
            'products.sale_price',
            'sales_details.total_price',
            'sales.total_sale',
            'products.name',
            'products.service', // Asume que hay un campo service_type en la tabla de productos para identificar el servicio
            'shipping_informations.first_name',
            'shipping_informations.last_name',
            'shipping_informations.email',
            'shipping_informations.identification_card',
            'shipping_informations.address',
            'cities.name as city_name',
            'departments.name as department_name',
            'shipping_informations.second_address',
            'shipping_informations.phone'
        )
        ->get();



        // Calcular el precio total
        $total_price = 0;
        foreach ($sale as $item) {
            $item->subtotal = $item->quantity * $item->sale_price;
            $total_price += $item->subtotal;
        }


        $data = [
            'user' => $user,
            'sale' => $sale,
            'total_price' => $total_price,
        ];

        try {
            $html = view('modules.sales.sale-bill', $data)->render();
            $image = Browsershot::html($html)->clip(145, -10, 1100, 1400)->windowSize(1400, 0)->screenshot();
        
            $tempImagePath = public_path('images.png');
        
            File::put($tempImagePath, $image);
        
            $htmlWithImage = '<img src="' . asset('images.png'). '" alt="Imagen de la factura" width="700" height="1000">';
        
            File::delete($tempImagePath);
            
        } catch (\Exception $e) {
            $htmlWithImage = view('modules.sales.sale-bill', $data);
        }

        $pdf = Pdf::loadHtml($htmlWithImage);
        $pdfPath = storage_path('app/public/') . 'factura.pdf';
        $pdf->save($pdfPath);


        // Verificar si la factura ya ha sido enviada
        // Obtén la lista de facturas enviadas desde la sesión (si existe)
        $facturasEnviadas = Session::get('facturas_enviadas', []);

        // Verifica si la factura actual ya se envió anteriormente
        if (!in_array($sale[0]->id, $facturasEnviadas)) {
            // Envía la factura por correo
            Mail::to($sale[0]->email)->send(new FacturaEmail($pdfPath));

            // Agrega el ID de la factura a la lista de facturas enviadas
            $facturasEnviadas[] = $sale[0]->id;

            // Actualiza la lista en la sesión
            Session::put('facturas_enviadas', $facturasEnviadas);
        }

        
        File::delete($pdfPath);
        // Cargar la vista de la factura
        return view('modules.sales.sale-bill', compact('sale', 'total_price'));
    }
}