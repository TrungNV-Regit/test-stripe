<?php

namespace App\Services;

use Stripe\Balance;
use Stripe\BalanceTransaction;
use Stripe\Stripe;

class BalanceService extends BaseStripeService
{

    public function detail()
    {
        return Balance::retrieve();
    }

    public function getTransactions()
    {
        return BalanceTransaction::all(['limit' => 100]);
    }
}
