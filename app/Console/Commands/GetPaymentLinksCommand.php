<?php

namespace App\Console\Commands;

use App\Services\StripeService;
use Illuminate\Console\Command;

class GetPaymentLinksCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stripe:get-payment-links';

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
        $paymentLinks = $stripeService->getPaymentLinks();
        dd($paymentLinks);
    }
}
