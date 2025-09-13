<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        if ($request->routeIs('customer.login')) {
            return view('auth.customer-login');
        } else{
            return view('auth.login');
        }
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        } elseif (Auth::user()->role === 'vendor') {
            return redirect()->intended(route('vendor.dashboard', absolute: false));
        } elseif (Auth::user()->role === 'customer') {
            return redirect()->intended(route('customer.dashboard', absolute: false));
        }
        // return redirect()->intended('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $role = $request->user()?->role;

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        if ($role === 'customer') {
            return redirect()->route('customer.login');
        }
        return redirect('/');
    }
}
