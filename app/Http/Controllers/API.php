<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PDF;

use App\Models\Sale;
use App\Models\Sales_detail;

class API extends Controller
{
    public function sales()
    {
        $sales = Sale::join('users', 'sales.user', '=', 'users.id')
            ->join('payment_methods', 'sales.payment_method', '=', 'payment_methods.id')
            ->join('status', 'sales.status', '=', 'status.id')
            ->select('sales.code', 'users.first_name as firstName', 'payment_methods.name as paymentMethods', 'status.name as statusName', 'sales.total_sale', 'sales.state', 'sales.created_at')
            ->where('sales.state', 1)
            ->get();

        $data = ['sales' => $sales];

        $pdf = PDF::loadView('sales-pdf', $data);

        return $pdf->download('ventas.pdf');
    }

    public function salesDetails()
    {
        $salesDetails = Sales_detail::join('sales', 'sales_details.sale', '=', 'sales.id')
            ->join('users', 'sales.user', '=', 'users.id')
            ->join('products', 'sales_details.product', '=', 'products.id')
            ->select('users.first_name as firstName', 'products.name as product', 'sales_details.start_date', 'sales_details.finish_date', 'sales_details.quantity', 'sales_details.total_price', 'sales_details.created_at')
            ->get();

            $data = ['salesDetails' => $salesDetails];

            $pdf = PDF::loadView('sales-details-pdf', $data);

            return $pdf->download('detalles-ventas.pdf');
    }
}
