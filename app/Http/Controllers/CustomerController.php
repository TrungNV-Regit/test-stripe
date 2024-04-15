<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\CustomerService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stripe\CustomerSession;

class CustomerController extends Controller
{

    private $customerService;

    public function __construct()
    {
        $this->customerService = new CustomerService();
    }

    public function create(): View
    {
        return view('card');
    }

    public function store(Request $request): RedirectResponse
    {
        $customer = $this->customerService->store($request);

        User::create([
            'name' => $customer->name,
            'email' => $customer->email,
            'customer_id' => $customer->id,
            'payment_method_id' => $request->paymentMethodId,
            'password' => bcrypt(Str::random(10)),
        ]);

        return back()->with('success', 'Successful!');
    }

    public function createSession(Request $request): CustomerSession
    {
        return $this->customerService->createSession($request->customer_id);
    }
}
