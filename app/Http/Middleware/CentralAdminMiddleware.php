<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CentralAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('central_admin')->check()) {
            // Build login URL using current domain to prevent domain switching
            $currentHost = $request->getHost();
            $scheme = $request->getScheme();
            $loginUrl = "{$scheme}://{$currentHost}/central/login";

            return redirect($loginUrl);
        }

        $user = Auth::guard('central_admin')->user();

        if (!$user->is_active) {
            Auth::guard('central_admin')->logout();

            // Build login URL using current domain
            $currentHost = $request->getHost();
            $scheme = $request->getScheme();
            $loginUrl = "{$scheme}://{$currentHost}/central/login";

            return redirect($loginUrl)->with('error', 'Your account has been deactivated.');
        }

        return $next($request);
    }
}
