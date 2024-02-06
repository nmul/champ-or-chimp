<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'unique_identifier', 'data', 'created_at', 'updated_at', 'number_of_forms', 'current_cost', 'order_number'];

    /**
     * This function gets the cart token and checks if there is a cart in session for current user.
     * if there are items in the cart it loops over the cart items and converts them to associative array
     * it returns the cartItems as an array
     */
    public static function getCartItemsAsArrayFromToken($cart) 
    {
        $cartItems = [];
        $cart_is_present = true;
        if (is_null($cart)) {
            $cart = new Cart();
            $cart_is_present = false;
        }        
        if ($cart_is_present){
            $decrypt = Crypt::decrypt($cart->data, true);
            $allEncodedData = json_decode($decrypt);
            $cartItemsData = (array)$allEncodedData;
            foreach ($cartItemsData as $cartItem){
                $cartItems[$cartItem -> id] = (array)$cartItem;
            }
        }
        return $cartItems;
    }

    public static function recodeCartItemsAndSave(Cart $cart, $cartItems, $token)
    {
        // recode the items
        $cart_as_json = json_encode($cart->data);
        $encrypted_cart = Crypt::encrypt($cart_as_json);
        $number_of_forms = count($cartItems);
        $current_cost = Entry::calculate_price($number_of_forms);
        $order_number = $cart->order_number;
        $cart = Cart::updateOrCreate(
            ['unique_identifier' => $token],
            [
                'data' => $encrypted_cart,
                'user_id' => Auth::id(),
                'number_of_forms' => $number_of_forms,
                'current_cost' => $current_cost,
                'order_number' => $order_number,
            ]
        );
    }
}
