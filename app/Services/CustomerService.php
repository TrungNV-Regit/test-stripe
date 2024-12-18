<?php

namespace App\Services;

use Illuminate\Http\Request;
use Stripe\Customer;
use Stripe\CustomerSession;

class CustomerService extends BaseStripeService
{
    public function store(Request $request): Customer
    {
        return Customer::create([
            'email' => 'customer' . date('dmy-his') . '@gmail.com',
            'name' => 'customer' . date('dmy-his'),
            'payment_method' => $request->paymentMethodId
        ]);
    }

    public function createSession(string $customer_id): CustomerSession
    {
        return CustomerSession::create([
            'customer' => $customer_id,
            'components' => [
                // 'pricing_table' => ['enabled' => true],
                'buy_button' => ['enabled' => true],
            ],
        ]);
    }
}

/// feature 1
