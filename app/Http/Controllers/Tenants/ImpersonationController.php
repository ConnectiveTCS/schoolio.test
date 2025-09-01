<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\ImpersonationToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonationController extends Controller
{
    /**
     * Handle impersonation from central admin
     */
    public function handleImpersonation(Request $request)
    {
        $token = $request->get('impersonation_token');

        if (!$token) {
            return redirect()->route('login')->with('error', 'Invalid impersonation token.');
        }

        // Find and validate the token
        $impersonationToken = ImpersonationToken::where('token', $token)->first();

        if (!$impersonationToken || !$impersonationToken->isValid()) {
            return redirect()->route('login')->with('error', 'Invalid or expired impersonation token.');
        }

        // Mark token as used
        $impersonationToken->markAsUsed();

        // Get the first admin user in the tenant (or create one if needed)
        $adminUser = $this->getOrCreateAdminUser();

        if (!$adminUser) {
            return redirect()->route('login')->with('error', 'Unable to create admin user for impersonation.');
        }

        // Log in as the admin user
        Auth::login($adminUser);

        // Store impersonation info in session
        session([
            'central_admin_impersonating' => true,
            'central_admin_id' => $impersonationToken->central_admin_id,
            'impersonation_started_at' => now(),
        ]);

        // Clean up expired tokens
        ImpersonationToken::cleanExpired();

        return redirect()->route('dashboard')->with('success', 'Successfully impersonating tenant as central admin.');
    }

    /**
     * End impersonation and return to central admin
     */
    public function endImpersonation()
    {
        if (!session('central_admin_impersonating')) {
            return redirect()->route('login');
        }

        // Clear impersonation session
        session()->forget(['central_admin_impersonating', 'central_admin_id', 'impersonation_started_at']);

        // Log out the current user
        Auth::logout();

        // Redirect to central admin dashboard
        // return redirect()->away(config('app.central_domain') . '/central/dashboard')
        //     ->with('success', 'Impersonation ended. Welcome back to central admin.');
                return redirect()->away(route('central.dashboard'))
            ->with('success', 'Impersonation ended. Welcome back to central admin.');
    }

    /**
     * Get or create an admin user for the tenant
     */
    private function getOrCreateAdminUser()
    {
        // First, try to find an existing admin user
        $adminUser = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->first();

        if ($adminUser) {
            return $adminUser;
        }

        // If no admin exists, try to find any user with admin-like permissions
        $adminUser = User::where('email', 'like', '%admin%')
            ->orWhere('name', 'like', '%admin%')
            ->first();

        if ($adminUser) {
            return $adminUser;
        }

        // As a last resort, get the first user in the system
        return User::first();
    }
}
