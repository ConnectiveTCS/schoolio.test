@extends('layouts.app')

@section('title', 'Redirect Pages Demo')

@section('content')
    <div
        class="min-h-screen bg-[color:var(--color-light-dark-green)] px-4 py-12 transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        <div class="mx-auto max-w-4xl">
            <!-- Header -->
            <div class="mb-12 text-center">
                <h1
                    class="mb-4 text-4xl font-bold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Schoolio Redirect Pages Demo
                </h1>
                <p class="text-lg text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                    Beautiful, branded redirect pages for every scenario
                </p>
            </div>

            <!-- Demo Grid -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <!-- Access Denied -->
                <div
                    class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="mb-4 text-center">
                        <div
                            class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/20">
                            <i class="fas fa-shield-alt text-xl text-red-600 dark:text-red-400"></i>
                        </div>
                        <h3
                            class="text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Access Denied
                        </h3>
                        <p
                            class="mt-2 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            Show when users lack permissions
                        </p>
                    </div>
                    <a href="{{ route('demo.access-denied') }}"
                        class="block w-full rounded-md bg-red-600 px-4 py-2 text-center text-sm font-semibold text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        View Demo
                    </a>
                </div>

                <!-- Success -->
                <div
                    class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="mb-4 text-center">
                        <div
                            class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/20">
                            <i class="fas fa-check-circle text-xl text-green-600 dark:text-green-400"></i>
                        </div>
                        <h3
                            class="text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Success
                        </h3>
                        <p
                            class="mt-2 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            Celebrate successful actions
                        </p>
                    </div>
                    <a href="{{ route('demo.success') }}"
                        class="block w-full rounded-md bg-green-600 px-4 py-2 text-center text-sm font-semibold text-white transition-colors hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        View Demo
                    </a>
                </div>

                <!-- Error -->
                <div
                    class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="mb-4 text-center">
                        <div
                            class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/20">
                            <i class="fas fa-exclamation-circle text-xl text-red-600 dark:text-red-400"></i>
                        </div>
                        <h3
                            class="text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Error
                        </h3>
                        <p
                            class="mt-2 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            Handle errors gracefully
                        </p>
                    </div>
                    <a href="{{ route('demo.error') }}"
                        class="block w-full rounded-md bg-red-600 px-4 py-2 text-center text-sm font-semibold text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        View Demo
                    </a>
                </div>

                <!-- Maintenance -->
                <div
                    class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="mb-4 text-center">
                        <div
                            class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900/20">
                            <i class="fas fa-tools text-xl text-orange-600 dark:text-orange-400"></i>
                        </div>
                        <h3
                            class="text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Maintenance
                        </h3>
                        <p
                            class="mt-2 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            Show during maintenance
                        </p>
                    </div>
                    <a href="{{ route('demo.maintenance') }}"
                        class="block w-full rounded-md bg-orange-600 px-4 py-2 text-center text-sm font-semibold text-white transition-colors hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                        View Demo
                    </a>
                </div>

                <!-- Coming Soon -->
                <div
                    class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="mb-4 text-center">
                        <div
                            class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/20">
                            <i class="fas fa-rocket text-xl text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3
                            class="text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Coming Soon
                        </h3>
                        <p
                            class="mt-2 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            Tease upcoming features
                        </p>
                    </div>
                    <a href="{{ route('demo.coming-soon') }}"
                        class="block w-full rounded-md bg-blue-600 px-4 py-2 text-center text-sm font-semibold text-white transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        View Demo
                    </a>
                </div>

                <!-- Logout Success -->
                <div
                    class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="mb-4 text-center">
                        <div
                            class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/20">
                            <i class="fas fa-sign-out-alt text-xl text-green-600 dark:text-green-400"></i>
                        </div>
                        <h3
                            class="text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Logout Success
                        </h3>
                        <p
                            class="mt-2 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            Confirm successful logout
                        </p>
                    </div>
                    <a href="{{ route('demo.logout-success') }}"
                        class="block w-full rounded-md bg-green-600 px-4 py-2 text-center text-sm font-semibold text-white transition-colors hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        View Demo
                    </a>
                </div>

                <!-- Session Expired -->
                <div
                    class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="mb-4 text-center">
                        <div
                            class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900/20">
                            <i class="fas fa-clock text-xl text-yellow-600 dark:text-yellow-400"></i>
                        </div>
                        <h3
                            class="text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Session Expired
                        </h3>
                        <p
                            class="mt-2 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            Handle expired sessions
                        </p>
                    </div>
                    <a href="{{ route('demo.session-expired') }}"
                        class="block w-full rounded-md bg-yellow-600 px-4 py-2 text-center text-sm font-semibold text-white transition-colors hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                        View Demo
                    </a>
                </div>

                <!-- Account Suspended -->
                <div
                    class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <div class="mb-4 text-center">
                        <div
                            class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/20">
                            <i class="fas fa-ban text-xl text-red-600 dark:text-red-400"></i>
                        </div>
                        <h3
                            class="text-lg font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Account Suspended
                        </h3>
                        <p
                            class="mt-2 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            Handle suspended accounts
                        </p>
                    </div>
                    <a href="{{ route('demo.account-suspended') }}"
                        class="block w-full rounded-md bg-red-600 px-4 py-2 text-center text-sm font-semibold text-white transition-colors hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        View Demo
                    </a>
                </div>
            </div>

            <!-- Features Section -->
            <div
                class="mt-16 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-8 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                <h2
                    class="mb-6 text-2xl font-bold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Key Features
                </h2>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <div class="text-center">
                        <i
                            class="fas fa-palette mb-3 text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        <h3
                            class="mb-2 font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Brand Consistent
                        </h3>
                        <p class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            Follows Schoolio design system with CSS variables
                        </p>
                    </div>
                    <div class="text-center">
                        <i
                            class="fas fa-mobile-alt mb-3 text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        <h3
                            class="mb-2 font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Responsive Design
                        </h3>
                        <p class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            Works perfectly on all devices and screen sizes
                        </p>
                    </div>
                    <div class="text-center">
                        <i
                            class="fas fa-universal-access mb-3 text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        <h3
                            class="mb-2 font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Accessible
                        </h3>
                        <p class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            ARIA labels, semantic HTML, keyboard navigation
                        </p>
                    </div>
                    <div class="text-center">
                        <i
                            class="fas fa-cogs mb-3 text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        <h3
                            class="mb-2 font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Customizable
                        </h3>
                        <p class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            Easy to customize messages, URLs, and behavior
                        </p>
                    </div>
                    <div class="text-center">
                        <i
                            class="fas fa-magic mb-3 text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        <h3
                            class="mb-2 font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Interactive
                        </h3>
                        <p class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            Smooth animations, auto-redirects, progress bars
                        </p>
                    </div>
                    <div class="text-center">
                        <i
                            class="fas fa-code mb-3 text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        <h3
                            class="mb-2 font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Easy to Use
                        </h3>
                        <p class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            Simple helper functions and clear documentation
                        </p>
                    </div>
                </div>
            </div>

            <!-- Usage Example -->
            <div
                class="mt-12 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-8 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                <h2
                    class="mb-4 text-2xl font-bold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Quick Usage Example
                </h2>
                <pre class="overflow-x-auto rounded-lg bg-gray-800 p-4 text-sm text-green-400">
<code>// In your controller
public function destroy(User $user) {
    if (!auth()->user()->can('delete', $user)) {
        return access_denied_redirect(
            'You cannot delete this user.',
            route('users.index')
        );
    }
    
    $user->delete();
    return success_redirect(
        'User Deleted Successfully',
        'The user has been removed from the system.',
        route('users.index'),
        'Back to Users'
    );
}</code>
            </pre>
            </div>

            <!-- Documentation Link -->
            <div class="mt-12 text-center">
                <a href="{{ asset('REDIRECT_PAGES.md') }}" target="_blank"
                    class="inline-flex items-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-6 py-3 font-semibold text-white transition-colors hover:bg-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                    <i class="fas fa-book"></i>
                    View Full Documentation
                </a>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add staggered animation to demo cards
        const cards = document.querySelectorAll('.grid > div');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.5s ease';

            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
