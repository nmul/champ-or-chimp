<?php

namespace App\Services;

use Session; 

class Cart {

  public $grandTotalWeight;
  public $cart = [];

    public static function getContent(){
        return Session::get('cart');
    }
  
    public static function add($entryForm) {
        $cart = session('cart', []);
        $cartId = rand(000000,999999);
        $cart[$cartId] = $entryForm;
        session()->put('cart', $cart);
    }

  public function GrandTotalWeight()
  {
    $cartItems = self::getContent();
  
    if($cartItems !== NULL &&  count($cartItems) > 0){
  
        foreach ($cartItems as $key => $value) {
            
            //the $value['price'] & $value['quantity'] should be passed 
            //in cart array or it wont be able to calculate the total
            $this->grandTotalWeight += $value['price'] * $value['quantity'];
        }
    }
    
    return $this->grandTotalWeight;
  }

  public static function destroyCartItem($cartId)
  {
      $cartItems = Cart::getContent();
  
      //find the cart item and remove it by using unset method
      unset($cartItems[$cartId]); 
      
      Session::put('cart', $cartItems); //update the array
  
      return;
  }

  public static function EmptyCheck()
  {
      $cartItems = self::getContent();
  
      if($cartItems !== NULL && count($cartItems) > 0 ){
          return true;
      }
  
      return false;
    
  }
}