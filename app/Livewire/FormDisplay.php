<?php

namespace App\Livewire;

use App\Livewire\Entryform;
use App\Models\Cart;
use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Livewire\Component;

class FormDisplay extends Component
{

    public $details;
    public $loopIteration;
    public $total;

    public function mount($details, $loopIteration, $total){
        $this->details = $details;
        $this->loopIteration = $loopIteration;
        $this->total = $total;
    }

    public function editEntryForm(String $entryFormId)
    {
        $this->redirectRoute('entryform', ["id" => $entryFormId]);
    }

    public function deleteEntryForm(String $entryFormId, Request $request)
    {
        $token = $request->session()->get('cart_token');
        $cart = Cart::where('unique_identifier', $token)->first();
        $cartItems = Cart::getCartItemsAsArrayFromToken($cart);
        unset($cartItems[$entryFormId]);
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

    public function render()
    {
        return view('livewire.form-display');
    }
}
