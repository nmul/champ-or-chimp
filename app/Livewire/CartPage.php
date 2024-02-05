<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Models\Cart;
use App\Models\Entry;


class CartPage extends Component
{

    public function checkout(Request $request){
        \Stripe\Stripe::setApiKey(config("stripe.sk"));

        $token = $request->session()->get('cart_token');
        $cart = Cart::where('unique_identifier', $token)->first();
        if (is_null($cart)) {
            return redirect()->back()->with('error','Cart is empty');
        }
        $cartData = Cart::getCartItemsAsArrayFromToken($cart);
        $count = $cart -> number_of_forms;
        $plur = (string)$count . " Champ or Chimp 2024 Entry Forms";
        $singular = "1 Champ or Chimp 2024 Entry Form";
        $nameMessage = $count > 1 ? $plur : $singular;
        $cost = $cart -> current_cost;
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
            'success_url' => url('success-page'),
            'cancel_url'  => url('cart'),
            'payment_intent_data' => [
                'metadata' => [
                    'order_id' => $token,
                ],
            ],
        ]);
        return redirect()->away($session->url);
    }

    public function render()
    {
        $token = Session::get('cart_token');
        $cart = Cart::where('unique_identifier', $token)->first();
        if (is_null($cart)) {
            return redirect()->back()->with('error','Cart is empty');
        }
        $cartDataCrypted = Crypt::decrypt($cart->data);
        $cartData = (array)json_decode($cartDataCrypted);
        $cart->data = $cartData;
        return view('livewire.cart-page',[
            'cart'=> $cartData,
        ])->layout('layouts.app');
    }
}
