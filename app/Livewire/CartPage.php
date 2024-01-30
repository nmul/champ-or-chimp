<?php

namespace App\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartPage extends Component
{


    public function render()
    {
        return view('livewire.cart-page',[
            'cart'=> session('cart'),
        ])->layout('layouts.app');
    }
}
