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


class saleshistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        if(Gate::allows('products.index')){

            $salesHistory = Sale::select(
                'sales.*',
                'sales.id as sale_id',
                'users.first_name as user_first_name',
                'sales_details.start_date as fecha_inicio',
                'sales_details.finish_date as fecha_fin',
                'sales_details.*',
                'sales_details.total_price',
                'products.name',
                'status.name as status_name', 
                'products.image',
                'payment_methods.name as payment_method_name',
                'shipping_informations.first_name',
                'shipping_informations.last_name',
                'shipping_informations.email',
                'shipping_informations.phone',
                'shipping_informations.identification_card',
                'shipping_informations.address',
                'shipping_informations.second_address',
                'cities.name as city_name',
                'departments.name as department_name',
                'shipping_informations.phone'
            )
            ->join('sales_details', 'sales.id', '=', 'sales_details.sale')
            ->join('products', 'products.id', '=', 'sales_details.product')
            ->join('users', 'users.id', '=', 'sales.user')
            ->join('shipping_informations', 'sales.id', '=', 'shipping_informations.sale')
            ->join('status','status.id', '=', 'sales.status')
            ->join('payment_methods', 'payment_methods.id', '=', 'sales.payment_method')
            ->join('cities', 'shipping_informations.city', '=', 'cities.id')
            ->leftJoin('departments', 'cities.department', '=', 'departments.id') // Inner join with payment_methods table
            ->orderBy('sales.created_at', 'desc');

        }else{

            $salesHistory = Sale::where('user', $user->id)
            ->join('sales_details', 'sales.id', '=', 'sales_details.sale')
            ->join('products', 'products.id', '=', 'sales_details.product')
            ->join('users', 'users.id', '=', 'sales.user')
            ->join('shipping_informations', 'sales.id', '=', 'shipping_informations.sale')
            ->join('status','status.id', '=', 'sales.status')
            ->join('payment_methods', 'payment_methods.id', '=', 'sales.payment_method')
            ->join('cities', 'shipping_informations.city', '=', 'cities.id')
            ->leftJoin('departments', 'cities.department', '=', 'departments.id') // Inner join with payment_methods table
            ->orderBy('sales.created_at', 'desc')
            ->select(
                'sales.*',
                'sales.id as sale_id',
                'users.first_name as user_first_name',
                'sales_details.start_date as fecha_inicio',
                'sales_details.finish_date as fecha_fin',
                'sales_details.*',
                'sales_details.total_price',
                'products.name',
                'status.name as status_name', 
                'products.image',
                'payment_methods.name as payment_method_name',
                'shipping_informations.first_name',
                'shipping_informations.last_name',
                'shipping_informations.email',
                'shipping_informations.phone',
                'shipping_informations.identification_card',
                'shipping_informations.address',
                'shipping_informations.second_address',
                'cities.name as city_name',
                'departments.name as department_name',
                'shipping_informations.phone'
            );
        }


        // Apply date filter if provided
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $salesHistory->whereBetween('sales.created_at', [$startDate, $endDate]);
        } elseif ($startDate) {
            $salesHistory->where('sales.created_at', '>=', $startDate);
        } elseif ($endDate) {
            $salesHistory->where('sales.created_at', '<=', $endDate);
        }

        $salesHistory = $salesHistory->get();

        // Calculate subtotals and total price for each sale
        foreach ($salesHistory as $sale) {
            $sale->subtotal = $sale->quantity * $sale->sale_price;
        }

        // Load the sales history view
        return view('modules.sales.history', compact('salesHistory'));
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