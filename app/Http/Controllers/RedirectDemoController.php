<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectDemoController extends Controller
{
    /**
     * Show the redirect demo page.
     */
    public function index()
    {
        return view('demo.redirects');
    }

    /**
     * Demo access denied redirect.
     */
    public function demoAccessDenied()
    {
        return access_denied_redirect(
            'This is a demo of the access denied page. You would see this when you don\'t have permission to access a resource.',
            route('demo.redirects'),
            'Back to Demo'
        );
    }

    /**
     * Demo success redirect.
     */
    public function demoSuccess()
    {
        return success_redirect(
            'Demo Action Successful',
            'This is a demo of the success page. Your demo action has been completed successfully!',
            route('demo.redirects'),
            'Back to Demo',
            true,
            5
        );
    }

    /**
     * Demo error redirect.
     */
    public function demoError()
    {
        return error_redirect(
            'Demo Error Page',
            'This is a demo of the error page. An example error occurred during processing.',
            route('demo.redirects'),
            'Back to Demo',
            route('tenant.support.index'),
            'DEMO001'
        );
    }

    /**
     * Demo maintenance redirect.
     */
    public function demoMaintenance()
    {
        return maintenance_redirect(
            'This demo feature is currently under maintenance for improvements.',
            '15 minutes',
            route('demo.redirects'),
            'Back to Demo'
        );
    }

    /**
     * Demo coming soon redirect.
     */
    public function demoComingSoon()
    {
        return coming_soon_redirect(
            'Demo Advanced Features',
            'This demo shows the coming soon page. Advanced demo features are being developed!',
            route('demo.redirects'),
            'Back to Demo'
        );
    }

    /**
     * Demo logout success redirect.
     */
    public function demoLogoutSuccess()
    {
        return redirect()->route('redirect.logout-success', [
            'message' => 'This is a demo of the logout success page.',
            'login_url' => route('demo.redirects'),
            'home_url' => route('demo.redirects')
        ]);
    }

    /**
     * Demo session expired redirect.
     */
    public function demoSessionExpired()
    {
        return session_expired_redirect(
            'This is a demo of the session expired page. Your demo session would have expired.',
            route('demo.redirects'),
            5
        );
    }

    /**
     * Demo account suspended redirect.
     */
    public function demoAccountSuspended()
    {
        return account_suspended_redirect(
            'This is a demo of the account suspended page. This would show when an account is suspended.',
            'demo-support@schoolio.test',
            route('tenant.support.index')
        );
    }
}
