<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Sale;

class API extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required|string'
        ];

        $request->validate($rules);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('Personal Access Token')->plainTextToken;
            $response = ['user' => $user, 'token' => $token];
            return response()->json($response, 200);
        }

        $response = ['message' => 'La dirección de correo electrónico y/o la contraseña son incorrectas.'];

        return response()->json($response, 400);
    }

    public function sales()
    {
        $sale = Sale::join('users', 'sales.user', '=', 'users.id')
        ->join('payment_methods', 'sales.payment_method', '=', 'payment_methods.id')
        ->join('status', 'sales.status', '=', 'status.id')
        ->select('sales.code', 'users.first_name as firstName', 'users.last_name as lastName', 'status.name', 'sales.total_sale', 'sales.state', 'sales.created_at')
        ->where('sales.state', 1)
        ->get();

        return response()->json($sale);
    }
}
