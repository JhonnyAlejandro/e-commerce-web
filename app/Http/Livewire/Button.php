<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Button extends Component
{
   public $product;

    public function render()
    {
        return view('livewire.button');
    }

    public function addCarrito($id)
    {
        $product = $id;
        $this->emit('addCarrito', $product);
    }


}
