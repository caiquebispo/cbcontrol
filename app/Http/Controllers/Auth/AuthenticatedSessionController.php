<?php

namespace App\Http\Controllers\Auth;

use App\Events\AuthenticatedUser;
use App\Events\UnaAuthenticated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Stevebauman\Location\Facades\Location;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        AuthenticatedUser::dispatch(Auth::user(), Location::get($request->ip()));

        if (isset(auth()->user()->getMenu()[0]['sub_menu'][0]['url'])) {

            return redirect()->intended(auth()->user()->getMenu()[0]['sub_menu'][0]['url']);
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {

        UnaAuthenticated::dispatch(Auth::user(), Location::get($request->ip()));

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
