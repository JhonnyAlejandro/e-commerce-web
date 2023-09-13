<?php
namespace App\Http\Controllers;

use App\Models\Sale;
use App\Mail\FacturaEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class saleshistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get all sales for the user with related details and products
        $salesHistory = Sale::where('user', $user->id)
            ->join('sales_details', 'sales.id', '=', 'sales_details.sale')
            ->join('products', 'products.id', '=', 'sales_details.product')
            ->join('users', 'users.id', '=', 'sales.user')
            ->join('status','status.id', '=', 'sales.status')
            ->join('payment_methods', 'payment_methods.id', '=', 'sales.payment_method') // Inner join with payment_methods table
            ->orderBy('sales.created_at', 'desc')
            ->select(
                'sales.*',
                'sales.id as sale_id',
                'users.first_name as user_first_name',
                'sales_details.*',
                'sales_details.total_price',
                'products.name',
                'status.name as status_name', 
                'products.image',
                'payment_methods.name as payment_method_name' // Select the payment method name
            );

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

