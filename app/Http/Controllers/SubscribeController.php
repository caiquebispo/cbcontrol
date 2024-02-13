<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
    public function __invoke()
    {
        $company = Auth::user()->company;
        if (!$company->settings->is_test_mode) {

            $company->createOrGetStripeCustomer();

            return $company->newSubscription(
                'default',
                'price_1OjIz4CWYJrbHOpTpHPRgi7w'
            )
                ->checkout()
                ->redirect();
        } else {
            return redirect('/');
        }
    }
}
