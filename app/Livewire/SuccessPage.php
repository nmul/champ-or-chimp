<?php

namespace App\Livewire;

use App\Jobs\addEntryToDatabase;
use App\Jobs\AddOrderToDatabaseJob;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SuccessPage extends Component
{

    public function render()
    {
        $orders = DB::table("orders")
                      ->where("user_id", Auth::user()->id);
        $latestOrder = $orders->first();
        // can also check here to make sure that Order number isn't already in the database
        return view('livewire.success-page', 
                    ["orders" => $orders, 
                    "latestOrder" => $latestOrder, 
                    "firstName" => Auth::user()->first_name])
                    ->layout('layouts.app');
    }
}
