<?php

namespace App\Console\Commands;

use App\Services\StripeService;
use Illuminate\Console\Command;

class CreateCardForCustomerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stripe:create-card-for-customer {token} {customerId}';

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
        $token =  $this->argument('token');
        $customerId = $this->argument('customerId');
        $card = $stripeService->createCardForCustomer($customerId, $token);
        dd($card);
    }
}
