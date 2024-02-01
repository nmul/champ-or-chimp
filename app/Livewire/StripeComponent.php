<?php

namespace App\Livewire;

use Livewire\Component;

class StripeComponent extends Component
{

    public function checkout(){
        \Stripe\Stripe::setApiKey(config('pk'));

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Entry Form',
                    ],
                    'unit_amount' => 1000,
                ],
                'quantity' => 1,
            ],
            'mode' => 'payment',
            'success_url' => route('/'),
            'cancel_url' => route('/')
        ]);

        return redirect()->away($session->url);
    }

    public function render()
    {
        return view('livewire.stripe-component');
    }
}
