<?php

namespace App\Jobs;

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
    public function __construct($userId, $cart)
    {
        $this->user = $userId;
        $this->cart = $cart;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         // create order entry
        $user = Auth::user();
        $numberOfForms = count((array) $this->cart);
        error_log($numberOfForms);
        $order = new Order();
        $order->user_id = $user -> id;
        $amount_paid_cents = Entry::calculate_price($numberOfForms);
        error_log($amount_paid_cents);
        $order -> amount_paid_cents = $amount_paid_cents;
        $order->number_of_forms = $numberOfForms;
        Order::create($order->toArray());
    }
}
