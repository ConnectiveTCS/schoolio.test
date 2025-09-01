<?php

namespace App\Http\Controllers\Central\Auth;

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
    public function create(): View
    {
        return view('central.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::guard('central_admin')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Build the dashboard URL using the current domain
            $currentHost = $request->getHost();
            $scheme = $request->getScheme();
            $dashboardUrl = "{$scheme}://{$currentHost}/central/dashboard";

            return redirect($dashboardUrl);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('central_admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Build login URL using current domain
        $currentHost = $request->getHost();
        $scheme = $request->getScheme();
        $loginUrl = "{$scheme}://{$currentHost}/central/login";

        return redirect($loginUrl);
    }
}
