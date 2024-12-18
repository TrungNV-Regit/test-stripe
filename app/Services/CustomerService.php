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

///hotfix
/// feature 1
/// feature 2
/// feature 3.1
/// feature 3.2
/// feature 3.3
///hotfix
/// hotfix2
/// feature 4.1
/// feature 4.2
/// feature 5.1
/// feature 5.2
/// feature 6.2
/// feature 6.2
/// feature 6.2
