<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\citie;
use App\Models\department;
use App\Models\Product;
use App\Models\Shipping_information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Sale;
use App\Models\Sales_detail;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;



class CartController extends Controller
{

    // Service =
    // 1 Venta
    // 2 Alquiler

    public function __construct()
    {
        $this->middleware('web');
    }


    public function index()
    {
        // Obtener los productos del carrito de la sesión
        $productsCart = session('carrito', []);

        // Obtener los detalles completos de los productos según los ids del carrito
        $products = Product::whereIn('id', array_keys($productsCart))->get();
        $subtotal = 0;
        foreach ($products as $product) {
            $quantity = $productsCart[$product->id];

            // Verificar si la cantidad en el carrito excede la existencia
            if($quantity > $product->existence){
                $quantity = $product->existence;
            }

            $subtotal += $product->discount > 0 ? ($product->sale_price - ($product->sale_price * ($product->discount / 100))) * $quantity : $product->sale_price * $quantity;
        }

            // Obtener las tasas de cambio desde Open Exchange Rates
            $apiKey = 'eb29fc0e41604e53a429414be344459c'; // Reemplaza con tu API Key
            //base Currency =   Moneda Base
            //target currency = Moneda objetivo
            $baseCurrency = 'USD'; // Dólar estadounidense
            $targetCurrency = 'COP'; // Peso colombiano

            // Crear una instancia del cliente Guzzle para hacer la solicitud HTTP

            $client = new Client();
            // Realizar la solicitud GET a la API de Open Exchange Rates
            $response = $client->get("https://openexchangerates.org/api/latest.json?app_id={$apiKey}&base={$baseCurrency}&symbols={$targetCurrency}");

            // Decodificar la respuesta JSON en un array asociativo
            $data = json_decode($response->getBody(), true);

            // Decodificar la respuesta JSON en un array asociativo
            $exchangeRate = $data['rates'][$targetCurrency];

            // Calcular el subtotal en pesos colombianos
            $subtotalInUSD = $subtotal / $exchangeRate;

            // Actualizar el subtotal en la sesión
            session(['subtotal' => $subtotal]);

            $departaments = Department::all();

        return view('modules.sales.cart', compact('products', 'productsCart', 'subtotal','subtotalInUSD','exchangeRate','departaments'));
    }

    public function removeProduct(Request $request, $product)
    {
        $cart = $request->session()->get('carrito', []);

        if (isset($cart[$product])) {
            $price = is_array($cart[$product]) ? $cart[$product]['price'] : 0;
            unset($cart[$product]);
            $request->session()->put('carrito', $cart);

            // Actualizar el subtotal en la sesión
            $subtotal = $request->session()->get('subtotal', 0);
            $subtotal -= $price;
            $request->session()->put('subtotal', $subtotal);

            return response()->json(['message' => 'Orden procesada con éxito']);
        }else{
            return response()->json(['error' => 'Error en el procesado'], 500);
        }

    }


    public function getCities($departamentId)
    {
        $cities = Citie::where('department', $departamentId)->get();
        return response()->json($cities);
    }


    public function redirect(Request $request, $product)
    {
        $cart = $request->session()->get('carrito', []);

        if (isset($cart[$product])) {
            $price = is_array($cart[$product]) ? $cart[$product]['price'] : 0;
            unset($cart[$product]);
            $request->session()->put('carrito', $cart);

            // Actualizar el subtotal en la sesión
            $subtotal = $request->session()->get('subtotal', 0);
            $subtotal -= $price;
            $request->session()->put('subtotal', $subtotal);
        }

        return redirect()->route('cart.index');
    }


    public function procesarOrden(Request $request)
    {
        // validaciones del formulario
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'email' => 'El :attribute debe ser una dirección de correo electrónico válida.',
            'cedula.regex' => 'La :attribute debe ser una cédula válida de 10 dígitos.',
            'numeric' => 'El campo :attribute debe ser numérico.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
            'max' => 'El campo :attribute no debe exceder :max caracteres.',
        ];

        $attributes = [
            'first_name' => 'nombre',
            'last_name' => 'apellido',
            'cedula' => 'cédula',
            'address' => 'dirección',
            'address2' => 'apartamento, local, etc.',
            'city' => 'ciudad',
            'departament' => 'departamento',
            'phone' => 'número de celular',
        ];

        $request->validate([
            'first_name' => 'required|string|max:45',
            'last_name' => 'required|string|max:45',
            'cedula' => 'required|regex:/^\d{10}$/',
            'address' => 'required|string|max:100',
            'address2' => 'nullable|string|max:100',
            'city' => 'required',
            'departament' => 'required',
            'phone' => 'required',
        ], $messages, $attributes);




        //formulario

        $city = citie::select('name')->where('id',$request->input('city'))->get();
        $city = $city[0];
        $cityName = $city->name;

        $departament = Department::select('name')->where('id',$request->input('departament'))->get();
        $departament = $departament[0];
        $departamentName = $departament->name;

        $user = Auth::user();
        $email = $user->email;

        $form = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'cedula' => $request->input('cedula'),
            'address' => $request->input('address'),
            'address2' => $request->input('address2'),
            'city' => $cityName,
            'idCity' => $request->input('city'),
            'departament' => $departamentName,
            'phone' => $request->input('phone'),
            'email' => $email
        ];

        //recopilar informacion del los productos
        $products = $request->input('product');
        $productInfo = new Collection();

        foreach ($products as $productId => $productData){
            $product = Product::find($productId);
            //validaciones
            if ($product->service == 2){
                if (!isset($productData['start_date']) || !isset($productData['end_date'])){
                    $messages = [
                        'required' => 'la :attribute es obligatorio.',
                    ];
                    $attributes = [
                        "product.{$productId}.start_date" => 'fecha de inicio',
                        "product.{$productId}.end_date"  => 'fecha de fin',
                    ];
                    $request->validate([
                        "product.{$productId}.start_date" => 'required',
                        "product.{$productId}.end_date" => 'required',
                    ], $messages, $attributes);
                }
            }

            //guardar info de productos
            $productInfoItem = (object)[
                'product' => $product,
                'productData' => $productData,
            ];

            $productInfo->push($productInfoItem);
        }


        $subtotalGeneral = $request->input('subtotal');
        $subtotalInUSD = $request->input('subtotalInUSD');
        $exchangeRate = $request->input('exchangeRate');

        $informations = Shipping_information::all();


        return view('.modules.sales.sales-summary', compact('form','productInfo', 'subtotalGeneral','exchangeRate','subtotalInUSD','informations'));
    }


    public function procesarCompra(Request $request)
    {

        $ordenDetalles = $request->json()->all();
        $details = $ordenDetalles['details'];
        $status = $details['status'];

        //llenar tabla de sale
        if ($status === 'COMPLETED') {

            $sale = new Sale();
            $sale->code = $details['id'];
            $sale->user = $ordenDetalles['user_id'];
            $sale->payment_method = 1;
            $sale->status = 3;
            $sale->total_sale = $ordenDetalles['subtotal'];
            $sale->state = 1;
            $sale->save();

            
            //llenar tabla de sale_details
            foreach ($ordenDetalles['products'] as $productInfo) {

                $productModel = Product::find($productInfo['product']['id']); // Asegúrate del nombre correcto del campo en tu base de datos
                $saleDetail = new Sales_detail();
                $saleDetail->sale = $sale->id;
                $saleDetail->product = $productModel->id;
                if(isset($productInfo['productData']['start_date']) || isset($productInfo['productData']['end_date'])){
                    $saleDetail->start_date = $productInfo['productData']['start_date'];
                    $saleDetail->finish_date = $productInfo['productData']['end_date'];
                }
                $saleDetail->quantity = $productInfo['productData']['quantity'];
                $totalPrice = $productModel->discount > 0
                    ? ($productModel->sale_price - ($productModel->sale_price * ($productModel->discount / 100))) * $productInfo['productData']['quantity']
                    : $productModel->sale_price * $productInfo['productData']['quantity'];
                $saleDetail->total_price = $totalPrice;

                $saleDetail->save();

                $updateExistencia = $productModel->existence - $productInfo['productData']['quantity'];
                $productModel->existence = $updateExistencia;
                $productModel->save();
            }

            
            //llenar tabla de Shipping_information
            $form = $ordenDetalles['formulario'];

            $shippingInfo = new Shipping_information();
            $shippingInfo->first_name = $form['first_name'];
            $shippingInfo->last_name = $form['last_name'];
            $shippingInfo->email = $form['email'];
            $shippingInfo->identification_card = $form['cedula'];
            $shippingInfo->address = $form['address'];
            $shippingInfo->city = $form['city'];
            $shippingInfo->second_address = $form['address2'];
            $shippingInfo->sales = $sale->id;

            $shippingInfo->phone = $form['phone'];

            $shippingInfo->save();


            // Borrar los productos del carrito después de la compra completada
            session()->forget('carrito');
            session()->forget('subtotal');

            return response()->json(['message' => 'Orden procesada con éxito']);
        } else {
            return response()->json(['error' => 'Error en la transacción de PayPal'], 500);
        }

    }
}
