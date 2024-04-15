<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Stripe\Product;
use Stripe\Stripe;

class CreateStripeProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stripe:create-product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new product';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $product = Product::create([
            'name' => 'Product ' . date('His'),
            'default_price_data' => [
                'currency' => 'usd',
                'unit_amount' => 50,
                'recurring' => [
                    'interval' => 'month',
                    'interval_count' => 1,
                ],
            ]
        ]);
    }
}
