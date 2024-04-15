<?php

namespace App\Services;

use Stripe\Stripe;

class BaseStripeService
{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }
}
