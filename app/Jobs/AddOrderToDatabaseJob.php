<?php

namespace App\Jobs;

use App\Models\Cart;
use App\Models\Entry;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AddOrderToDatabaseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $cart;
    private $order_number;

    /**
     * Create a new job instance.
     */
    public function __construct($cart, $order_number)
    {
        $this->cart = $cart;
        $this->order_number = $order_number;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $order = new Order();
        $numberOfForms = $this->cart->number_of_forms;
        $order-> user_id = $this->cart -> user_id;
        $current_cost = $this -> cart->current_cost;
        $order -> amount_paid_cents = $current_cost;
        $order->number_of_forms = $numberOfForms;
        $order-> order_number = $this->order_number;
        Order::create($order->toArray());
    }
}
