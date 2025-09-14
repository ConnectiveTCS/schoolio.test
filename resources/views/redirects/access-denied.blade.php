@extends('layouts.guest')

@section('title', 'Access Denied')

<x-guest-layout>
    <div
        class="flex min-h-screen items-center justify-center bg-[color:var(--color-light-dark-green)] px-4 py-12 transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        <div class="w-full max-w-md">
            <!-- Logo and Header -->
            <div class="mb-8 text-center">
                <div
                    class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/20">
                    <i class="fas fa-shield-alt text-2xl text-red-600 dark:text-red-400"></i>
                </div>
                <h2
                    class="mt-6 text-center text-2xl font-bold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Access Denied
                </h2>
                <p
                    class="mt-2 text-center text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                    You don't have permission to access this resource
                </p>
            </div>

            <!-- Content Card -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                <!-- Error Message -->
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-900/40">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800 dark:text-red-200">
                                {{ $message }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Information Box -->
                <div
                    class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <h3
                        class="mb-2 flex items-center text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        <i
                            class="fas fa-info-circle mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        What can you do?
                    </h3>
                    <ul
                        class="space-y-1 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>
                            Contact your administrator to request access
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>
                            Check if you're logged into the correct account
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>
                            Return to the dashboard and try again
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col space-y-3 sm:flex-row sm:space-x-3 sm:space-y-0">
                    <a href="{{ $redirect_url }}"
                        class="shadow-xs inline-flex flex-1 items-center justify-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                        <i class="fas fa-home h-4 w-4"></i>
                        {{ $redirect_text }}
                    </a>
                    <a href="{{ route('tenant.support.index') }}"
                        class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2.5 text-sm font-semibold text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
                        <i class="fas fa-headset h-4 w-4"></i>
                        Get Support
                    </a>
                </div>

                <!-- Additional Help -->
                <div class="mt-6 text-center">
                    <p class="text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        Need immediate assistance?
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
    });
</script>
