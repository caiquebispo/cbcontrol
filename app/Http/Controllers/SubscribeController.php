<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
    public function subscribe()
    {
        $company = Auth::user()->company;
        if (!$company->settings->is_test_mode) {

            $company->createOrGetStripeCustomer();

            return $company->newSubscription(
                'default',
                'price_1Ole4NCWYJrbHOpTxmTobmWf',
                //'price_1OjJ4WCWYJrbHOpT32TSwDt1'
            )
                ->checkout()
                ->redirect();
        } else {
            return redirect('/');
        }
    }
    public function handleWebhook()
    {
        return response()->json('success', 200);
    }
}
