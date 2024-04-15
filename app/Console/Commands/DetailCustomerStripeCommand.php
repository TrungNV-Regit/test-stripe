<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\StripeService;
use Illuminate\Console\Command;
use Stripe\Customer;

class DetailCustomerStripeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stripe:detail-customer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $stripeService = new StripeService();
        $users = User::whereNotNull(['customer_id', 'payment_method_id'])->orderBy('created_at', 'desc')->get();
        foreach ($users as $user) {
            $detailCustomer = $stripeService->retrieveCustomer($user->customer_id);
            $paymentMethods = $stripeService->getPaymentMethods($user->customer_id);
            dd($paymentMethods);
            echo "Customer ID: " . $user->customer_id . "\n";
            echo "----------------------\n";
            foreach ($paymentMethods as $paymentMethod) {
                echo "Payment Method ID: " . $paymentMethod->id . "\n";
                echo "Card Brand: " . $paymentMethod->card->brand . "\n";
                echo "Card Last 4 Digits: " . $paymentMethod->card->last4 . "\n";
                echo "Expiry Month: " . $paymentMethod->card->exp_month . "\n";
                echo "Expiry Year: " . $paymentMethod->card->exp_year . "\n";
                echo "----------------------\n";
            }
        }
    }
}
