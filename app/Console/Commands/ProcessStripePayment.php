<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\StripeService;
use Illuminate\Console\Command;

class ProcessStripePayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stripe:process-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process payment for a customer in Stripe';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $stripeService = new StripeService();
        $users = User::whereNotNull(['customer_id', 'payment_method_id'])->get();

        foreach ($users as $user) {
            $paymentIntent = $stripeService->createPaymentIntent($user);
            $this->info('Status: ' . $paymentIntent->status);
        }
    }
}
