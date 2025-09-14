# Schoolio Redirect Pages

This package provides beautiful, branded redirect pages for the Schoolio application. These pages maintain consistency with the application's design system and provide clear navigation options for users.

## Available Redirect Pages

### 1. Access Denied (`access-denied`)
Used when users don't have permission to access a resource.

**Features:**
- Clear error message
- Helpful suggestions
- Link to support
- Return to dashboard option

### 2. Success (`success`)
Used to show successful completion of actions.

**Features:**
- Customizable title and message
- Auto-redirect with countdown (optional)
- Action buttons
- Success visual indicators

### 3. Error (`error`)
Used for general error handling.

**Features:**
- Error message display
- Error code support
- Troubleshooting steps
- Technical details (collapsible)
- Support links

### 4. Maintenance (`maintenance`)
Used when features are under maintenance.

**Features:**
- Maintenance message
- Estimated completion time
- Progress indicator animation
- What's being done section
- Auto-refresh functionality

### 5. Coming Soon (`coming-soon`)
Used for features that are in development.

**Features:**
- Feature timeline
- Email notification signup
- Development progress indicator
- What to expect section
- Feedback collection link

### 6. Logout Success (`logout-success`)
Used after successful logout.

**Features:**
- Session security confirmation
- Session summary stats
- Clear action buttons
- Security tips

### 7. Session Expired (`session-expired`)
Used when user sessions timeout.

**Features:**
- Auto-redirect to login with countdown
- Cancellable redirect
- Security information
- Why this happened explanation

### 8. Account Suspended (`account-suspended`)
Used when accounts are suspended.

**Features:**
- Suspension reasons
- Contact information
- Support ticket creation
- Account ID display (with copy function)

## Usage

### Method 1: Using Helper Functions

```php
// Access denied
return access_denied_redirect(
    'You need admin privileges to access this area.',
    route('dashboard'),
    'Go to Dashboard'
);

// Success page with auto-redirect
return success_redirect(
    'User Created Successfully',
    'The new user has been created and email sent.',
    route('users.index'),
    'View Users',
    true, // auto-redirect
    5 // 5 seconds delay
);

// Error page
return error_redirect(
    'Database Error',
    'Could not connect to the database.',
    route('dashboard'),
    'Try Again',
    route('support.index'),
    'DB001'
);

// Maintenance page
return maintenance_redirect(
    'User management is currently under maintenance.',
    '2 hours',
    route('dashboard'),
    'Return Home'
);

// Coming soon
return coming_soon_redirect(
    'Advanced Reports',
    'Advanced reporting features are coming soon with charts and exports!',
    route('reports.index'),
    'View Basic Reports',
    route('notifications.signup')
);

// Session expired
return session_expired_redirect(
    'Your session has expired due to inactivity.',
    route('login'),
    15 // redirect after 15 seconds
);

// Account suspended
return account_suspended_redirect(
    'Your account has been suspended due to policy violation.',
    'support@schoolio.test',
    route('support.create')
);
```

### Method 2: Using Direct Routes

```php
// Direct route with parameters
return redirect()->route('redirect.access-denied', [
    'message' => 'Custom access denied message',
    'redirect_url' => route('home'),
    'redirect_text' => 'Go Home'
]);

// Success with query parameters
return redirect()->route('redirect.success', [
    'title' => 'Email Sent',
    'message' => 'Your email has been sent successfully.',
    'auto_redirect' => true,
    'redirect_delay' => 3
]);
```

### Method 3: Using the Generic Helper

```php
// Generic redirect function
return redirect_to_page('maintenance', [
    'message' => 'System under maintenance',
    'estimated_time' => '30 minutes'
]);
```

## URL Structure

All redirect pages are available under the `/redirect/` prefix:

- `/redirect/access-denied`
- `/redirect/success`
- `/redirect/error`
- `/redirect/maintenance`
- `/redirect/coming-soon`
- `/redirect/logout-success`
- `/redirect/session-expired`
- `/redirect/account-suspended`

## Integration Examples

### In Controllers

```php
class UserController extends Controller
{
    public function destroy(User $user)
    {
        if (!auth()->user()->can('delete', $user)) {
            return access_denied_redirect(
                'You cannot delete this user.',
                route('users.index'),
                'Back to Users'
            );
        }

        try {
            $user->delete();
            return success_redirect(
                'User Deleted',
                'The user has been successfully deleted.',
                route('users.index'),
                'Back to Users'
            );
        } catch (\Exception $e) {
            return error_redirect(
                'Deletion Failed',
                'Could not delete the user. Please try again.',
                route('users.show', $user),
                'Back to User'
            );
        }
    }
}
```

### In Middleware

```php
class CheckAccountStatus
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->is_suspended) {
            return account_suspended_redirect();
        }

        if (auth()->user()->session_expired) {
            return session_expired_redirect();
        }

        return $next($request);
    }
}
```

### In Exception Handler

```php
class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthorizationException) {
            return access_denied_redirect($exception->getMessage());
        }

        if ($exception instanceof MaintenanceException) {
            return maintenance_redirect(
                $exception->getMessage(),
                $exception->getEstimatedTime()
            );
        }

        return parent::render($request, $exception);
    }
}
```

## Customization

### Custom Messages

All redirect pages accept custom messages and parameters. You can customize:

- Titles and messages
- Redirect URLs and button text
- Auto-redirect settings
- Contact information
- Error codes and technical details

### Styling

The pages follow the Schoolio design system with:
- Consistent color schemes (light/dark mode support)
- Responsive design
- Smooth animations
- Accessibility features

### JavaScript Features

Each page includes interactive features:
- Smooth fade-in animations
- Auto-redirect countdowns
- Collapsible sections
- Copy-to-clipboard functionality
- Progress indicators

## Best Practices

1. **Use appropriate redirect types** - Choose the right page for each scenario
2. **Provide clear messages** - Always include helpful, user-friendly messages
3. **Include action buttons** - Give users clear next steps
4. **Set reasonable delays** - For auto-redirects, use 3-10 second delays
5. **Maintain consistency** - Use the helper functions for consistent behavior
6. **Test all scenarios** - Ensure redirects work in both tenant and central contexts

## Examples by Use Case

### Permission Errors
```php
// In a policy or authorization check
if (!$user->can('manage_tenants')) {
    return access_denied_redirect(
        'Only administrators can manage tenants.',
        route('dashboard'),
        'Return to Dashboard'
    );
}
```

### Form Submissions
```php
// After successful form submission
public function store(Request $request)
{
    $user = User::create($request->validated());
    
    return success_redirect(
        'User Created Successfully',
        "User {$user->name} has been created and invited via email.",
        route('users.index'),
        'View All Users'
    );
}
```

### Feature Flags
```php
// For features not yet available
if (!Feature::enabled('advanced_reports')) {
    return coming_soon_redirect(
        'Advanced Reports',
        'Advanced reporting with charts and exports is coming soon!',
        route('reports.basic'),
        'View Basic Reports'
    );
}
```

### Maintenance Mode
```php
// During scheduled maintenance
if (app()->isDownForMaintenance() || $this->isFeatureUnderMaintenance()) {
    return maintenance_redirect(
        'This feature is temporarily unavailable for scheduled maintenance.',
        '2 hours'
    );
}
```

## Design System Integration

These redirect pages are fully integrated with the Schoolio design system:

- **Color Variables**: Uses CSS custom properties for consistent theming
- **Typography**: Follows the established font hierarchy
- **Spacing**: Consistent padding, margins, and grid systems
- **Components**: Reuses button styles, card layouts, and form elements
- **Dark Mode**: Full support for light/dark theme switching
- **Responsive**: Mobile-first responsive design
- **Accessibility**: ARIA labels, semantic HTML, keyboard navigation

## Installation

The redirect system is automatically available after installation. To regenerate the autoload files:

```bash
composer dump-autoload
```

## Support

For issues or questions regarding the redirect pages:

1. Check the examples in this documentation
2. Review the controller and view files
3. Contact the development team
4. Submit a support ticket through the application

---

*These redirect pages provide a professional, consistent user experience across all error and success scenarios in the Schoolio application.*
