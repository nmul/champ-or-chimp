<?php

namespace App\Livewire;

use App\Jobs\addEntryToDatabase;
use App\Jobs\AddOrderToDatabaseJob;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SuccessPage extends Component
{

    public function paymentMade(){

    }

    public function render()
    {
        session()->reflash();
        $cart = session()->get("cart");
        dispatch(new addEntryToDatabase(Auth::user() -> id, $cart));
        dispatch(new AddOrderToDatabaseJob(Auth::user() -> id, $cart));
        // can also check here to make sure that Order number isn't already in the database
        return view('livewire.success-page')->layout('layouts.app');
    }
}
