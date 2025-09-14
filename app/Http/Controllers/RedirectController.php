<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    /**
     * Show the access denied page.
     */
    public function accessDenied(Request $request)
    {
        return view('redirects.access-denied', [
            'message' => $request->query('message', 'You do not have permission to access this resource.'),
            'redirect_url' => $request->query('redirect_url', route('dashboard')),
            'redirect_text' => $request->query('redirect_text', 'Return to Dashboard')
        ]);
    }

    /**
     * Show the success redirect page.
     */
    public function success(Request $request)
    {
        return view('redirects.success', [
            'title' => $request->query('title', 'Action Completed Successfully'),
            'message' => $request->query('message', 'Your action has been completed successfully.'),
            'redirect_url' => $request->query('redirect_url', route('dashboard')),
            'redirect_text' => $request->query('redirect_text', 'Continue'),
            'auto_redirect' => $request->query('auto_redirect', false),
            'redirect_delay' => $request->query('redirect_delay', 3)
        ]);
    }

    /**
     * Show the error redirect page.
     */
    public function error(Request $request)
    {
        return view('redirects.error', [
            'title' => $request->query('title', 'An Error Occurred'),
            'message' => $request->query('message', 'We encountered an error while processing your request.'),
            'redirect_url' => $request->query('redirect_url', route('dashboard')),
            'redirect_text' => $request->query('redirect_text', 'Try Again'),
            'support_link' => $request->query('support_link', route('tenant.support.index')),
            'error_code' => $request->query('error_code', '500')
        ]);
    }

    /**
     * Show the maintenance redirect page.
     */
    public function maintenance(Request $request)
    {
        return view('redirects.maintenance', [
            'message' => $request->query('message', 'This feature is currently under maintenance.'),
            'estimated_time' => $request->query('estimated_time', 'a few minutes'),
            'redirect_url' => $request->query('redirect_url', route('dashboard')),
            'redirect_text' => $request->query('redirect_text', 'Return to Dashboard')
        ]);
    }

    /**
     * Show the coming soon redirect page.
     */
    public function comingSoon(Request $request)
    {
        return view('redirects.coming-soon', [
            'feature_name' => $request->query('feature_name', 'This Feature'),
            'message' => $request->query('message', 'This feature is coming soon! We\'re working hard to bring you new functionality.'),
            'redirect_url' => $request->query('redirect_url', route('dashboard')),
            'redirect_text' => $request->query('redirect_text', 'Return to Dashboard'),
            'notify_url' => $request->query('notify_url', null)
        ]);
    }

    /**
     * Show the logout success page.
     */
    public function logoutSuccess(Request $request)
    {
        return view('redirects.logout-success', [
            'message' => $request->query('message', 'You have been successfully logged out.'),
            'login_url' => $request->query('login_url', route('login')),
            'home_url' => $request->query('home_url', '/')
        ]);
    }

    /**
     * Show the session expired page.
     */
    public function sessionExpired(Request $request)
    {
        return view('redirects.session-expired', [
            'message' => $request->query('message', 'Your session has expired for security reasons.'),
            'login_url' => $request->query('login_url', route('login')),
            'redirect_delay' => $request->query('redirect_delay', 10)
        ]);
    }

    /**
     * Show the account suspended page.
     */
    public function accountSuspended(Request $request)
    {
        return view('redirects.account-suspended', [
            'message' => $request->query('message', 'Your account has been temporarily suspended.'),
            'contact_email' => $request->query('contact_email', 'support@schoolio.test'),
            'support_url' => $request->query('support_url', route('central.support.index'))
        ]);
    }
}
