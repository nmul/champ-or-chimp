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

class AddOrderToDatabaseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $userId;
    private $cart;

    /**
     * Create a new job instance.
     */
    public function __construct($userId, Cart $cart)
    {
        $this->userId = $userId;
        $this->cart = $cart;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $numberOfForms = $this->cart->number_of_forms;
        error_log((string)$numberOfForms . " : number of forms");
        $order = new Order();
        $order-> user_id = $this->userId;
        error_log((string) $this->userId . " : user id");

        $current_cost = $this -> cart->current_cost;
        error_log((string)$current_cost . " : current cost");
        $order -> amount_paid_cents = $current_cost;
        $order->number_of_forms = $numberOfForms;
        Order::create($order->toArray());
    }
}
