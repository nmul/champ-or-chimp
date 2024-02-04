<?php

namespace App\Livewire;

use App\Jobs\addEntryToDatabase;
use App\Jobs\AddOrderToDatabaseJob;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SuccessPage extends Component
{

    public function paymentMade(){

    }

    public function render()
    {
        // can also check here to make sure that Order number isn't already in the database
        return view('livewire.success-page')->layout('layouts.app');
    }
}
