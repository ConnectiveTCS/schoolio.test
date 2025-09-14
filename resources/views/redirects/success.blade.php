@extends('layouts.guest')

@section('title', 'Success')

<x-guest-layout>
    <div
        class="flex min-h-screen items-center justify-center bg-[color:var(--color-light-dark-green)] px-4 py-12 transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        <div class="w-full max-w-md">
            <!-- Logo and Header -->
            <div class="mb-8 text-center">
                <div
                    class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/20">
                    <i class="fas fa-check-circle text-2xl text-green-600 dark:text-green-400"></i>
                </div>
                <h2
                    class="mt-6 text-center text-2xl font-bold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    {{ $title }}
                </h2>
                <p
                    class="mt-2 text-center text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                    Your action has been completed successfully
                </p>
            </div>

            <!-- Content Card -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                <!-- Success Message -->
                <div
                    class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 dark:border-green-800 dark:bg-green-900/40">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <i class="fas fa-check-circle text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800 dark:text-green-200">
                                {{ $message }}
                            </p>
                        </div>
                    </div>
                </div>

                @if ($auto_redirect)
                    <!-- Auto-redirect countdown -->
                    <div
                        class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                        <div class="flex items-center justify-center">
                            <div class="text-center">
                                <i
                                    class="fas fa-clock mb-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                <p
                                    class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    Redirecting in <span id="countdown">{{ $redirect_delay }}</span> seconds...
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex flex-col space-y-3 sm:flex-row sm:space-x-3 sm:space-y-0">
                    <a href="{{ $redirect_url }}"
                        class="shadow-xs inline-flex flex-1 items-center justify-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                        <i class="fas fa-arrow-right h-4 w-4"></i>
                        {{ $redirect_text }}
                    </a>
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2.5 text-sm font-semibold text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
                        <i class="fas fa-home h-4 w-4"></i>
                        Dashboard
                    </a>
                </div>

                <!-- Additional Options -->
                <div class="mt-6 text-center">
                    <p class="text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        Want to do something else?
                        <a href="{{ route('dashboard') }}"
                            class="font-medium text-[color:var(--color-castleton-green)] hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                            Go to Dashboard
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

        @if ($auto_redirect)
            // Auto-redirect countdown
            let countdown = {{ $redirect_delay }};
            const countdownElement = document.getElementById('countdown');
            const redirectUrl = '{{ $redirect_url }}';

            const timer = setInterval(() => {
                countdown--;
                if (countdownElement) {
                    countdownElement.textContent = countdown;
                }

                if (countdown <= 0) {
                    clearInterval(timer);
                    window.location.href = redirectUrl;
                }
            }, 1000);

            // Allow user to cancel auto-redirect by clicking anywhere
            document.addEventListener('click', (e) => {
                if (!e.target.closest('a')) {
                    clearInterval(timer);
                    if (countdownElement && countdownElement.closest('.rounded-lg')) {
                        countdownElement.closest('.rounded-lg').style.display = 'none';
                    }
                }
            });
        @endif
    });
</script>
