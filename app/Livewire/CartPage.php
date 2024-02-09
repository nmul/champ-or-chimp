<?php

namespace App\Livewire;

use App\Livewire\Actions\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Cart;
use App\Models\Entry;


class CartPage extends Component
{
    public $selectedEntryId = null;

    protected $listeners = [
        'entrySelectedForDeletion' => 'setSelectedEntryId',
    ];

    public function checkout(Request $request){
        \Stripe\Stripe::setApiKey(config("stripe.sk"));

        $token = $request->session()->get('cart_token');
        $cart = Cart::where('unique_identifier', $token)->first();
        if (is_null($cart)) {
            return redirect()->back()->with('error','Cart is empty');
        }
        $count = $cart -> number_of_forms;
        $plur = (string)$count . " Champ or Chimp 2024 Entry Forms";
        $singular = "1 Champ or Chimp 2024 Entry Form";
        $nameMessage = $count > 1 ? $plur : $singular;
        $cost = $cart -> current_cost;
        $order_number = Str::uuid()->toString();
        error_log("order number " . $order_number);
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
                    'cart_token' => $token,
                    'order_number' => $order_number,
                ],
            ],
        ]);
        return redirect()->away($session->url);
    }

    #[On('deleteEntry')]
    public function setDeleteId($entryFormId){
        $this->selectedEntryId = $entryFormId;
    }

    public function deleteEntryForm()
    {
        if ($this->selectedEntryId == null){
            return redirect()->back()->with('error','Selected entry is null');
        }
        $token = Session()->get('cart_token');
        $cart = Cart::where('unique_identifier', $token)->first();
        $cartItems = Cart::getCartItemsAsArrayFromToken($cart);
        unset($cartItems[$this->selectedEntryId]);
        $cart->data = $cartItems;
        $cart_as_json = json_encode($cart->data);
        $encrypted_cart = Crypt::encrypt($cart_as_json);
        $number_of_forms = count($cartItems);
        $current_cost = Entry::calculate_price($number_of_forms);
        $cart = Cart::updateOrCreate(
            ['unique_identifier' => $token],
            [
                'data' => $encrypted_cart,
                'user_id' => Auth::id(),
                'number_of_forms' => $number_of_forms,
                'current_cost' => $current_cost,
            ]
        );
        $this->redirect('cart');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/register', navigate: true);
    }

    public function render()
    {
        $token = Session::get('cart_token');
        $cart = Cart::where('unique_identifier', $token)->first();
        $cartData = null;
        if ($cart != null) {
            $cartDataCrypted = Crypt::decrypt($cart->data);
            $cartData = (array)json_decode($cartDataCrypted);
            $cart->data = $cartData;
        }
        return view('livewire.cart-page',[
            'cart'=> $cartData,
            'cartWrapper' => $cart,
        ])->layout('layouts.app');
    }
}
