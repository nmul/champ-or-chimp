<?php

namespace App\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartPage extends Component
{

    public function checkout(){
        \Stripe\Stripe::setApiKey(config("stripe.sk"));

        $cart = session()->get('cart');
        if ($cart == null){
            return redirect()->back()->with('error','Cart is empty');
        }

        $count = count((array) session('cart'));
        $plur = (string)$count . " Champ or Chimp 2024 Entry Forms";
        $singular = "1 Champ or Chimp 2024 Entry Form";
        $nameMessage = $count > 1 ? $plur : $singular;
        $cost = $count * 1000;
        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'eur',
                        'product_data' => [
                            'name' => $nameMessage,
                        ],
                        'unit_amount'  => $cost,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => url('cart'),
            'cancel_url'  => url('cart'),
        ]);
        return redirect()->away($session->url);
    }

    public function render()
    {
        return view('livewire.cart-page',[
            'cart'=> session('cart'),
        ])->layout('layouts.app');
    }
}
