<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Mail\FacturaEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use App\Models\Sales_detail;
use Illuminate\Support\Facades\DB;




class SalesHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        if (Gate::allows('products.index')) {

            $salesHistory = Sales_detail::select(
                'sales.id AS sale_id',
                'sales.code AS sale_code',
                'sales.total_sale',
                'sales.status',
                'sales.created_at',
                'users.first_name AS user_first_name',
                'sales_details.start_date AS fecha_inicio',
                'sales_details.finish_date AS fecha_fin',
                'sales_details.total_price as price',
                'products.name AS product_name',
                DB::raw('status.name AS status_name'), // Usamos \DB::raw para evitar problemas con el alias
                'products.image AS product_image',
                DB::raw('payment_methods.name AS payment_method_name'), // Usamos \DB::raw para evitar problemas con el alias
                'shipping_informations.first_name AS shipping_first_name',
                'shipping_informations.last_name AS shipping_last_name',
                'shipping_informations.email AS shipping_email',
                'shipping_informations.phone AS shipping_phone',
                'shipping_informations.identification_card AS shipping_identification_card',
                'shipping_informations.address AS shipping_address',
                'shipping_informations.second_address AS shipping_second_address',
                'cities.name AS city_name',
                'departments.name AS department_name'
            )
                ->join('sales', 'sales.id', '=', 'sales_details.sale')
                ->join('products', 'products.id', '=', 'sales_details.product')
                ->join('users', 'users.id', '=', 'sales.user')
                ->join('shipping_informations', 'sales.id', '=', 'shipping_informations.sale')
                ->join('status', 'status.id', '=', 'sales.status')
                ->join('payment_methods', 'payment_methods.id', '=', 'sales.payment_method')
                ->join('cities', 'shipping_informations.city', '=', 'cities.id')
                ->leftJoin('departments', 'cities.department', '=', 'departments.id')
                ->orderBy('sales_details.created_at', 'desc')
                ->orderBy('sales_details.start_date', 'desc')
                ->groupBy(
                    'sales.id',
                    'sales.code',
                    'sales.total_sale',
                    'sales.created_at',
                    'sales.status',
                    'users.first_name',
                    'sales_details.start_date',
                    'sales_details.finish_date',
                    'sales_details.total_price',
                    'products.name',
                    'status.name',
                    'products.image',
                    'payment_methods.name',
                    'shipping_informations.first_name',
                    'shipping_informations.last_name',
                    'shipping_informations.email',
                    'shipping_informations.phone',
                    'shipping_informations.identification_card',
                    'shipping_informations.address',
                    'shipping_informations.second_address',
                    'cities.name',
                    'departments.name'
                );
        } else {

            $salesHistory = Sales_detail::where('user', $user->id)->select(
                'sales.id AS sale_id',
                'sales.code AS sale_code',
                'sales.total_sale',
                'sales.status',
                'sales.created_at',
                'users.first_name AS user_first_name',
                'sales_details.start_date AS fecha_inicio',
                'sales_details.finish_date AS fecha_fin',
                'sales_details.total_price as price',
                'products.name AS product_name',
                DB::raw('status.name AS status_name'), // Usamos \DB::raw para evitar problemas con el alias
                'products.image AS product_image',
                DB::raw('payment_methods.name AS payment_method_name'), // Usamos \DB::raw para evitar problemas con el alias
                'shipping_informations.first_name AS shipping_first_name',
                'shipping_informations.last_name AS shipping_last_name',
                'shipping_informations.email AS shipping_email',
                'shipping_informations.phone AS shipping_phone',
                'shipping_informations.identification_card AS shipping_identification_card',
                'shipping_informations.address AS shipping_address',
                'shipping_informations.second_address AS shipping_second_address',
                'cities.name AS city_name',
                'departments.name AS department_name'
            )
                ->join('sales', 'sales.id', '=', 'sales_details.sale')
                ->join('products', 'products.id', '=', 'sales_details.product')
                ->join('users', 'users.id', '=', 'sales.user')
                ->join('shipping_informations', 'sales.id', '=', 'shipping_informations.sale')
                ->join('status', 'status.id', '=', 'sales.status')
                ->join('payment_methods', 'payment_methods.id', '=', 'sales.payment_method')
                ->join('cities', 'shipping_informations.city', '=', 'cities.id')
                ->leftJoin('departments', 'cities.department', '=', 'departments.id')
                ->orderBy('sales_details.created_at', 'desc')
                ->groupBy(
                    'sales.id',
                    'sales.code',
                    'sales.total_sale',
                    'sales.created_at',
                    'sales.status',
                    'users.first_name',
                    'sales_details.start_date',
                    'sales_details.finish_date',
                    'sales_details.total_price',
                    'products.name',
                    'status.name',
                    'products.image',
                    'payment_methods.name',
                    'shipping_informations.first_name',
                    'shipping_informations.last_name',
                    'shipping_informations.email',
                    'shipping_informations.phone',
                    'shipping_informations.identification_card',
                    'shipping_informations.address',
                    'shipping_informations.second_address',
                    'cities.name',
                    'departments.name'
                );
        }


        // Aplica el filtro de fecha si se proporciona
        $startDate = $request->input('start_date');

        if ($startDate) {
            $salesHistory->whereDate('sales.created_at', $startDate);
        }

        // Obtén los datos de ventas y detalles de ventas
        $salesHistory = $salesHistory->get();

        // Organiza los datos en un arreglo de ventas únicas con detalles
        $uniqueSales = [];

        foreach ($salesHistory as $sale) {
            $saleId = $sale->sale_id;

            if (!isset($uniqueSales[$saleId])) {
                $uniqueSales[$saleId] = [
                    'sale' => $sale,
                    'details' => [],
                ];
            }

            $uniqueSales[$saleId]['details'][] = $sale;
        }

        // Calcula los subtotales y el precio total para cada venta
        foreach ($uniqueSales as $saleId => $data) {
            $totalPrice = 0;

            foreach ($data['details'] as $detail) {
                $detail->subtotal = $detail->quantity * $detail->sale_price;
                $totalPrice += $detail->subtotal;
            }

            $data['sale']->total_price = $totalPrice;
            $uniqueSales[$saleId] = $data;
        }

        // Load the sales history view
        return view('modules.sales.history', compact('uniqueSales'));
    }

    public function updateStatus(Request $request)
    {
        $detalles = $request->json()->all();

        $id =  $detalles['saleId'];
        $status =  $detalles['newStatusId'];

        // Aquí realiza la actualización del estado en la base de datos
        // Por ejemplo, usando Eloquent:
        Sale::where('id', $id)->update(['status' => $status]);

        return response()->json(['success' => true]);
    }
}
