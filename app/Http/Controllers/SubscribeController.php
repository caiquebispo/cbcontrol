<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
    public function __invoke()
    {
        $company = Auth::user()->company;

        $company->createOrGetStripeCustomer();

        return $company->newSubscription(
            'default',
            'price_1Oj7HhCWYJrbHOpT0lgwjrOI'
        )
            ->checkout()
            ->redirect();
    }
}
