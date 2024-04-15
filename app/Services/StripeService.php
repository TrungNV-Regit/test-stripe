<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Stripe\Collection;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\PaymentLink;
use Stripe\PaymentMethod;
use Stripe\Price;
use Stripe\Product;
use Stripe\Stripe;
use Stripe\Subscription;

class StripeService
{

    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function createCardForCustomer(string $customerId, string $token)
    {
        return Customer::createSource(
            $customerId,
            ['source' => $token],
        );
    }

    public function createPaymentIntent(User $user): PaymentIntent
    {
        return PaymentIntent::create([
            'amount' => 200,
            'currency' => 'usd',
            'customer' => $user->customer_id,
            'description' => 'Test payment ' . date('Y-m-d H:i:s'),
            'confirm' => true,
            'payment_method' => $user->payment_method_id,
            'return_url' => 'https://www.abc.com',
        ]);
    }

    public function attachPaymentMethod(string $paymentMethodId, string $customerId): PaymentMethod
    {
        $paymentMethod = PaymentMethod::retrieve($paymentMethodId);
        return $paymentMethod->attach(['customer' => $customerId]);
    }

    public function retrieveCustomer(string $customerId): Customer
    {
        return Customer::retrieve($customerId);
    }

    public function getPaymentMethods(string $customerId)
    {
        return PaymentMethod::all([
            'customer' => $customerId,
            'type' => 'card',
        ]);
    }

    public function getPaymentLinks(): Collection
    {
        return PaymentLink::all();
    }

    public function getProducts()
    {
        return Product::all();
    }

    public function getPrices()
    {
        return Price::all();
    }

    public function getSubscriptions()
    {
        return Subscription::all();
    }

    public function createSubscription(Request $request): Subscription
    {
        return Subscription::create([
            'customer' => $request->customerId,
            'items' => [
                [
                    'price' => $request->priceId,
                ],
            ],
        ]);
    }

    public function cancelSubscription(Request $request)
    {
        $subscription = Subscription::retrieve($request->subscriptionId);
        return $subscription->cancel();
    }
}
