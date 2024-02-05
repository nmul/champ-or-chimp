<?php

namespace App\Http\Controllers;

use App\Events\PaymentReceived;
use App\Jobs\AddOrderToDatabaseJob;
use App\Models\Cart;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\Entry;
use App\Models\MissingField;
use App\Models\Prediction;
use App\Jobs\addEntryToDatabase;

class StripeController extends BaseController
{

    public function webhook()
    {
        $payload = @file_get_contents('php://input');
        $endpoint_secret = "whsec_b8a5d4c3ca960ec1c57a1172602a049ae07a741be3e864fac8052ebc6243b544";
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
            $intent = $event->data->object;
            $token = $intent->metadata['cart_token'];
            $cart = Cart::where('unique_identifier', $token)->first();
            dispatch(new AddOrderToDatabaseJob($cart));
            $cartData = Cart::getCartItemsAsArrayFromToken($cart);
            dispatch(new addEntryToDatabase($cart->user_id, $cartData));
            error_log("run job ");
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

