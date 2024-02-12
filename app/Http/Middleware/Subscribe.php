<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Subscribe
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $company = Auth::user()->company;

        if (!$company?->subscribed()) {
            // Redirect user to billing page and ask them to subscribe...

            $company->createOrGetStripeCustomer();

            return $company->newSubscription(
                'default',
                'price_1Oj7HhCWYJrbHOpT0lgwjrOI'
            )
                ->checkout()
                ->redirect();
        }

        return $next($request);
    }
}
