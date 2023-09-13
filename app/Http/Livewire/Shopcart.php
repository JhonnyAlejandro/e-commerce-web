<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Shopcart extends Component
{
    public $products = [];
    public $totalCantidad = 0; // Variable para almacenar la suma de la cantidad de productos

    protected $listeners = ['addCarrito'];

    public function addCarrito($id)
    {
        if (isset($this->products[$id])) {
            $this->products[$id]=1;
        } else {
            $this->products[$id] = 1;
        }

        $this->updateLocalStorage(); // Actualizar localStorage
        $this->calcularTotalCantidad();
        
    }


    public function removeFromCart($id)
    {
        unset($this->products[$id]);

        $this->updateLocalStorage(); // Actualizar localStorage
        $this->calcularTotalCantidad();
        // Emitir evento personalizado para notificar que se ha eliminado un producto del carrito
        $this->emit('removeFromCart', $id);
    }

    public function render()
    {
        $productsCart = Product::whereIn('id', array_keys($this->products))->get();

        return view('livewire.shopcart', [
            'productsCart' => $productsCart
        ]);
    }

    public function mount()
    {
        $this->products = session('shopcart', []);
        $this->calcularTotalCantidad(); // Calcular la suma de la cantidad de productos al iniciar
    }

    public function calcularTotalCantidad()
    {
       
        $this->totalCantidad = array_sum($this->products);
    }

    public function redirectToCart()
    {
        
        // Guardamos los productos del carrito en la sesión para mantenerlos después de la redirección
        session(['shopcart' => $this->products]);

        // Redirigir a la vista del carrito
        redirect()->route('cart.index', ['productsCart' => $this->products]);
    }

    public function isInCarrito($id)
    {
        return isset($this->products[$id]);
    }

    private function updateLocalStorage()
    {
        session(['carrito' => $this->products]);
        $this->emit('updateCarrito', $this->products); // Emitir evento personalizado con los productos del carrito
    }
}