<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\StripeService;
use Illuminate\Console\Command;

class AttachPaymentMethodToCustomerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stripe:attach-payment-method-to-customer  
                            {customerId : The ID of the customer}       
                            {paymentMethodId : The ID of the payment method}';

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
        $paymentMethodId = $this->argument('paymentMethodId');
        $customerId = $this->argument('customerId');
        $paymentMethod = $stripeService->attachPaymentMethod($paymentMethodId, $customerId);
        dd($paymentMethod);
    }
}
