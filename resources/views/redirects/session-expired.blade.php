@extends('layouts.guest')

@section('title', 'Session Expired')

<x-guest-layout>
    <div
        class="flex min-h-screen items-center justify-center bg-[color:var(--color-light-dark-green)] px-4 py-12 transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        <div class="w-full max-w-md">
            <!-- Logo and Header -->
            <div class="mb-8 text-center">
                <div
                    class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900/20">
                    <i class="fas fa-clock text-2xl text-yellow-600 dark:text-yellow-400"></i>
                </div>
                <h2
                    class="mt-6 text-center text-2xl font-bold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Session Expired
                </h2>
                <p
                    class="mt-2 text-center text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                    Your session has timed out for security
                </p>
            </div>

            <!-- Content Card -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                <!-- Expiration Message -->
                <div
                    class="mb-6 rounded-lg border border-yellow-200 bg-yellow-50 p-4 dark:border-yellow-800 dark:bg-yellow-900/40">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-yellow-800 dark:text-yellow-200">
                                {{ $message }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Auto-redirect Notice -->
                <div
                    class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <div class="text-center">
                        <i
                            class="fas fa-sync-alt mb-3 animate-spin text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        <h3
                            class="mb-2 text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Redirecting to Login
                        </h3>
                        <p
                            class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            You will be redirected in <span id="countdown">{{ $redirect_delay }}</span> seconds
                        </p>
                        <button onclick="cancelRedirect()"
                            class="mt-2 text-xs text-[color:var(--color-castleton-green)] underline hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                            Cancel Auto-Redirect
                        </button>
                    </div>
                </div>

                <!-- Security Information -->
                <div
                    class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <h3
                        class="mb-2 flex items-center text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        <i
                            class="fas fa-shield-alt mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        Why did this happen?
                    </h3>
                    <ul
                        class="space-y-1 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>
                            You were inactive for too long
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>
                            Sessions expire automatically for security
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>
                            This protects your account from unauthorized access
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col space-y-3 sm:flex-row sm:space-x-3 sm:space-y-0">
                    <a href="{{ $login_url }}"
                        class="shadow-xs inline-flex flex-1 items-center justify-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                        <i class="fas fa-sign-in-alt h-4 w-4"></i>
                        Sign In Again
                    </a>
                    <a href="{{ route('password.request') }}"
                        class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2.5 text-sm font-semibold text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
                        <i class="fas fa-key h-4 w-4"></i>
                        Reset Password
                    </a>
                </div>

                <!-- Security Tips -->
                <div
                    class="mt-6 rounded-lg border border-blue-200 bg-blue-50 p-3 dark:border-blue-800 dark:bg-blue-900/40">
                    <h4 class="mb-2 flex items-center text-xs font-medium text-blue-800 dark:text-blue-200">
                        <i class="fas fa-lightbulb mr-1"></i>
                        Security Tips
                    </h4>
                    <ul class="space-y-1 text-xs text-blue-700 dark:text-blue-300">
                        <li class="flex items-start">
                            <i class="fas fa-check mr-2 mt-0.5 text-xs text-green-500"></i>
                            <span>Always log out when using shared computers</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check mr-2 mt-0.5 text-xs text-green-500"></i>
                            <span>Use strong, unique passwords for your account</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check mr-2 mt-0.5 text-xs text-green-500"></i>
                            <span>Enable two-factor authentication if available</span>
                        </li>
                    </ul>
                </div>

                <!-- Contact Support -->
                <div class="mt-6 text-center">
                    <p class="text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        Having trouble signing in?
                        <a href="mailto:support@schoolio.test"
                            class="font-medium text-[color:var(--color-castleton-green)] hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                            Contact Support
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth fade-in animation
        const card = document.querySelector('.rounded-lg.border');
        if (card) {
            card.style.opacity = '0';
            card.style.transform = 'translateY(10px)';
            card.style.transition = 'all 0.3s ease';

            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        }

        // Auto-redirect countdown
        let countdown = {{ $redirect_delay }};
        const countdownElement = document.getElementById('countdown');
        const loginUrl = '{{ $login_url }}';
        let redirectTimer;

        function startCountdown() {
            redirectTimer = setInterval(() => {
                countdown--;
                if (countdownElement) {
                    countdownElement.textContent = countdown;
                }

                if (countdown <= 0) {
                    clearInterval(redirectTimer);
                    window.location.href = loginUrl;
                }
            }, 1000);
        }

        // Start the countdown
        startCountdown();

        // Cancel redirect function
        window.cancelRedirect = function() {
            clearInterval(redirectTimer);
            const redirectNotice = countdownElement.closest('.rounded-lg');
            if (redirectNotice) {
                redirectNotice.innerHTML = `
                <div class="text-center">
                    <i class="fas fa-pause text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)] mb-3"></i>
                    <h3 class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] mb-2">
                        Auto-redirect Cancelled
                    </h3>
                    <p class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        Click "Sign In Again" when you're ready
                    </p>
                </div>
            `;
            }
        };
    });
</script>
