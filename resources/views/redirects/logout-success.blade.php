@extends('layouts.guest')

@section('title', 'Logged Out Successfully')

<x-guest-layout>
    <div
        class="flex min-h-screen items-center justify-center bg-[color:var(--color-light-dark-green)] px-4 py-12 transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        <div class="w-full max-w-md">
            <!-- Logo and Header -->
            <div class="mb-8 text-center">
                <div
                    class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/20">
                    <i class="fas fa-sign-out-alt text-2xl text-green-600 dark:text-green-400"></i>
                </div>
                <h2
                    class="mt-6 text-center text-2xl font-bold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Successfully Logged Out
                </h2>
                <p
                    class="mt-2 text-center text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                    Thank you for using Schoolio
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

                <!-- Security Information -->
                <div
                    class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <h3
                        class="mb-2 flex items-center text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        <i
                            class="fas fa-shield-alt mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        Your session has been secured
                    </h3>
                    <ul
                        class="space-y-1 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <li class="flex items-center">
                            <i class="fas fa-check mr-2 text-xs text-green-500"></i>
                            All session data has been cleared
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check mr-2 text-xs text-green-500"></i>
                            Authentication tokens invalidated
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check mr-2 text-xs text-green-500"></i>
                            Your data remains secure
                        </li>
                    </ul>
                </div>

                <!-- Quick Stats (if any) -->
                <div
                    class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <h3
                        class="mb-3 flex items-center text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        <i
                            class="fas fa-chart-line mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        Session Summary
                    </h3>
                    <div class="grid grid-cols-2 gap-4 text-center text-sm">
                        <div>
                            <div
                                class="text-lg font-semibold text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]">
                                {{ date('H:i') }}
                            </div>
                            <div
                                class="text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                Session Length
                            </div>
                        </div>
                        <div>
                            <div
                                class="text-lg font-semibold text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]">
                                {{ date('M d') }}
                            </div>
                            <div
                                class="text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                Last Login
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col space-y-3 sm:flex-row sm:space-x-3 sm:space-y-0">
                    <a href="{{ $login_url }}"
                        class="shadow-xs inline-flex flex-1 items-center justify-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                        <i class="fas fa-sign-in-alt h-4 w-4"></i>
                        Sign In Again
                    </a>
                    <a href="{{ $home_url }}"
                        class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2.5 text-sm font-semibold text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
                        <i class="fas fa-home h-4 w-4"></i>
                        Go Home
                    </a>
                </div>

                <!-- Footer Links -->
                <div
                    class="mt-6 flex items-center justify-center space-x-4 text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                    <a href="#"
                        class="transition-colors hover:text-[color:var(--color-castleton-green)] dark:hover:text-[color:var(--color-light-castleton-green)]">
                        Privacy Policy
                    </a>
                    <span>•</span>
                    <a href="#"
                        class="transition-colors hover:text-[color:var(--color-castleton-green)] dark:hover:text-[color:var(--color-light-castleton-green)]">
                        Terms of Service
                    </a>
                    <span>•</span>
                    <a href="mailto:support@schoolio.test"
                        class="transition-colors hover:text-[color:var(--color-castleton-green)] dark:hover:text-[color:var(--color-light-castleton-green)]">
                        Support
                    </a>
                </div>

                <!-- Thank You Message -->
                <div class="mt-6 text-center">
                    <div
                        class="inline-flex items-center rounded-full bg-[color:var(--color-light-brunswick-green)] px-3 py-1 text-xs text-[color:var(--color-dark-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)]">
                        <i class="fas fa-heart mr-1 text-red-500"></i>
                        Thank you for choosing Schoolio
                    </div>
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

        // Add floating animation to the heart icon
        const heartIcon = document.querySelector('.fa-heart');
        if (heartIcon) {
            setInterval(() => {
                heartIcon.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    heartIcon.style.transform = 'scale(1)';
                }, 200);
            }, 3000);
        }

        // Add subtle pulse to security checkmarks
        const checkIcons = document.querySelectorAll('.fa-check');
        checkIcons.forEach((icon, index) => {
            setTimeout(() => {
                icon.style.animation = 'pulse 0.5s ease-in-out';
            }, index * 200);
        });
    });

    // CSS animation for pulse effect
    const style = document.createElement('style');
    style.textContent = `
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.7; }
        100% { opacity: 1; }
    }
`;
    document.head.appendChild(style);
</script>
