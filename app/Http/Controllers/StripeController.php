<?php

namespace App\Http\Controllers;

use App\Jobs\OrderConfirmationEmailJob;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use App\Jobs\addEntryToDatabase;


class StripeController extends BaseController
{

    public function webhook()
    {
        $payload = @file_get_contents('php://input');
        $endpoint_secret = config("stripe.ws");
        $event = null;

        try {
            $event = \Stripe\Event::constructFrom(
              json_decode($payload, true)
            );
        } catch(\UnexpectedValueException $e) {
        // Invalid payload
            echo '⚠️  Webhook error while parsing basic request.';
            http_response_code(400);
            exit();
        }
        if ($endpoint_secret) {
            // Only verify the event if there is an endpoint secret defined
            // Otherwise use the basic decoded event
            $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
            try {
                $event = \Stripe\Webhook::constructEvent(
                    $payload, $sig_header, $endpoint_secret
                );
            } catch(\Stripe\Exception\SignatureVerificationException $e) {
                // Invalid signature
                echo '⚠️  Webhook error while validating signature.';
                http_response_code(400);
                exit();
            }
        }

        if ($event->type == "payment_intent.succeeded") {
            // dont forget to fire up stripe. in live save web hook signing secret to env
            $intent = $event->data->object;
            $token = $intent->metadata['cart_token'];
            Log::info('token is '. $token);
            $order_number = $intent->metadata['order_number'];
            Log::info('order number is '. $order_number);
            $cart = Cart::where('unique_identifier', $token)->first();
            $cartData = Cart::getCartItemsAsArrayFromToken($cart);
            Log::info(json_encode($cartData));
            $order = new Order();
            $numberOfForms = $cart->number_of_forms;
            $order-> user_id = $cart -> user_id;
            $current_cost = $cart->current_cost;
            $order -> amount_paid_cents = $current_cost;
            $order->number_of_forms = $numberOfForms;
            $order-> order_number = $order_number;
            Order::create($order->toArray());
            dispatch(new addEntryToDatabase($cart->user_id, $cartData, $order_number));
            error_log("in order confirmation job");
            Log::info($order->user_id);
            dispatch(new OrderConfirmationEmailJob($order_number));
            $cart -> delete();
            http_response_code(200);
        } elseif ($event->type == "payment_intent.payment_failed") {
            $intent = $event->data->object;
            $error_message = $intent->last_payment_error ? $intent->last_payment_error->message : "";
            printf("Failed: %s, %s", $intent->id, $error_message);
            http_response_code(200);
        }
        http_response_code(200);
    }

    /**
     * Payment is successful, we create an entry form and store it
     * we create predictions and store them.
     */
    function handlePaymentIntentSucceeded($paymentIntent){
        //create an order maybe? Add to DB
        error_log($paymentIntent->id);
    }
}

