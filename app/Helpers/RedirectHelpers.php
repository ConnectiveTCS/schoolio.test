<?php

if (!function_exists('redirect_to_page')) {
    /**
     * Redirect to a custom redirect page with parameters.
     * 
     * @param string $type The type of redirect (access-denied, success, error, maintenance, coming-soon, logout-success, session-expired, account-suspended)
     * @param array $params Parameters to pass to the redirect page
     * @return \Illuminate\Http\RedirectResponse
     */
    function redirect_to_page(string $type, array $params = [])
    {
        $route = "redirect.{$type}";

        // Check if we're in tenant context
        if (tenant()) {
            return redirect()->route($route, $params);
        }

        // For central domain
        return redirect()->route($route, $params);
    }
}

if (!function_exists('access_denied_redirect')) {
    /**
     * Redirect to access denied page.
     * 
     * @param string $message Custom message
     * @param string|null $redirect_url Where to redirect after
     * @param string $redirect_text Text for redirect button
     * @return \Illuminate\Http\RedirectResponse
     */
    function access_denied_redirect(
        string $message = 'You do not have permission to access this resource.',
        ?string $redirect_url = null,
        string $redirect_text = 'Return to Dashboard'
    ) {
        return redirect_to_page('access-denied', [
            'message' => $message,
            'redirect_url' => $redirect_url ?? route('dashboard'),
            'redirect_text' => $redirect_text
        ]);
    }
}

if (!function_exists('success_redirect')) {
    /**
     * Redirect to success page.
     * 
     * @param string $title Success title
     * @param string $message Success message
     * @param string|null $redirect_url Where to redirect after
     * @param string $redirect_text Text for redirect button
     * @param bool $auto_redirect Whether to auto-redirect
     * @param int $redirect_delay Delay in seconds for auto-redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    function success_redirect(
        string $title = 'Action Completed Successfully',
        string $message = 'Your action has been completed successfully.',
        ?string $redirect_url = null,
        string $redirect_text = 'Continue',
        bool $auto_redirect = false,
        int $redirect_delay = 3
    ) {
        return redirect_to_page('success', [
            'title' => $title,
            'message' => $message,
            'redirect_url' => $redirect_url ?? route('dashboard'),
            'redirect_text' => $redirect_text,
            'auto_redirect' => $auto_redirect,
            'redirect_delay' => $redirect_delay
        ]);
    }
}

if (!function_exists('error_redirect')) {
    /**
     * Redirect to error page.
     * 
     * @param string $title Error title
     * @param string $message Error message
     * @param string|null $redirect_url Where to redirect after
     * @param string $redirect_text Text for redirect button
     * @param string|null $support_link Support link
     * @param string|int $error_code Error code
     * @return \Illuminate\Http\RedirectResponse
     */
    function error_redirect(
        string $title = 'An Error Occurred',
        string $message = 'We encountered an error while processing your request.',
        ?string $redirect_url = null,
        string $redirect_text = 'Try Again',
        ?string $support_link = null,
        $error_code = '500'
    ) {
        return redirect_to_page('error', [
            'title' => $title,
            'message' => $message,
            'redirect_url' => $redirect_url ?? route('dashboard'),
            'redirect_text' => $redirect_text,
            'support_link' => $support_link ?? route('tenant.support.index'),
            'error_code' => $error_code
        ]);
    }
}

if (!function_exists('maintenance_redirect')) {
    /**
     * Redirect to maintenance page.
     * 
     * @param string $message Maintenance message
     * @param string $estimated_time Estimated completion time
     * @param string|null $redirect_url Where to redirect after
     * @param string $redirect_text Text for redirect button
     * @return \Illuminate\Http\RedirectResponse
     */
    function maintenance_redirect(
        string $message = 'This feature is currently under maintenance.',
        string $estimated_time = 'a few minutes',
        ?string $redirect_url = null,
        string $redirect_text = 'Return to Dashboard'
    ) {
        return redirect_to_page('maintenance', [
            'message' => $message,
            'estimated_time' => $estimated_time,
            'redirect_url' => $redirect_url ?? route('dashboard'),
            'redirect_text' => $redirect_text
        ]);
    }
}

if (!function_exists('coming_soon_redirect')) {
    /**
     * Redirect to coming soon page.
     * 
     * @param string $feature_name Name of the feature
     * @param string $message Coming soon message
     * @param string|null $redirect_url Where to redirect after
     * @param string $redirect_text Text for redirect button
     * @param string|null $notify_url URL for notification signup
     * @return \Illuminate\Http\RedirectResponse
     */
    function coming_soon_redirect(
        string $feature_name = 'This Feature',
        string $message = 'This feature is coming soon! We\'re working hard to bring you new functionality.',
        ?string $redirect_url = null,
        string $redirect_text = 'Return to Dashboard',
        ?string $notify_url = null
    ) {
        return redirect_to_page('coming-soon', [
            'feature_name' => $feature_name,
            'message' => $message,
            'redirect_url' => $redirect_url ?? route('dashboard'),
            'redirect_text' => $redirect_text,
            'notify_url' => $notify_url
        ]);
    }
}

if (!function_exists('session_expired_redirect')) {
    /**
     * Redirect to session expired page.
     * 
     * @param string $message Session expired message
     * @param string|null $login_url Login URL
     * @param int $redirect_delay Delay in seconds for auto-redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    function session_expired_redirect(
        string $message = 'Your session has expired for security reasons.',
        ?string $login_url = null,
        int $redirect_delay = 10
    ) {
        return redirect_to_page('session-expired', [
            'message' => $message,
            'login_url' => $login_url ?? route('login'),
            'redirect_delay' => $redirect_delay
        ]);
    }
}

if (!function_exists('account_suspended_redirect')) {
    /**
     * Redirect to account suspended page.
     * 
     * @param string $message Suspension message
     * @param string $contact_email Support email
     * @param string|null $support_url Support URL
     * @return \Illuminate\Http\RedirectResponse
     */
    function account_suspended_redirect(
        string $message = 'Your account has been temporarily suspended.',
        string $contact_email = 'support@schoolio.test',
        ?string $support_url = null
    ) {
        return redirect_to_page('account-suspended', [
            'message' => $message,
            'contact_email' => $contact_email,
            'support_url' => $support_url ?? route('central.support.index')
        ]);
    }
}
