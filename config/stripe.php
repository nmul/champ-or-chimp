<?php

return [
    'pk' => env('STRIPE_KEY'),
    'sk' => env('STRIPE_SECRET'),
    'ws' => env('STRIPE_WEBHOOK_SECRET'),
];