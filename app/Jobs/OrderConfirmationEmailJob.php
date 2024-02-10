<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mail;
class OrderConfirmationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $order;

    /**
     * Create a new job instance.
     */
    public function __construct($order_id)
    {
        $this->order = DB::table("orders")->where("order_number", $order_id)->first();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        error_log("in order confirmation job");
        Log::info($this->order->user_id);
        $user_id = $this->order->user_id;
        error_log("user Id in order confirmation job : " . $user_id);
        $user = DB::table("users")->where("id", $user_id )->first();
        $userEmail = $user->email;
        error_log("user email is " . $userEmail);
        $subject = "Champ or Chimp Order Confirmation Number";
        $body = "Hi, " . $user->first_name . "\nThanks for your order!\n\nYour order confirmation number is: " . $this->order->order_number. ".\nBest of luck in the competition!\nKind regards,\nChamp Or Chimp Team";
        Mail::to($userEmail)->send(new OrderConfirmationMail($subject, $body, $this->order, $user));
    }
}
