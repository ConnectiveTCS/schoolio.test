@extends('layouts.guest')

@section('title', 'Account Suspended')

<x-guest-layout>
    <div
        class="flex min-h-screen items-center justify-center bg-[color:var(--color-light-dark-green)] px-4 py-12 transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        <div class="w-full max-w-md">
            <!-- Logo and Header -->
            <div class="mb-8 text-center">
                <div
                    class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/20">
                    <i class="fas fa-ban text-2xl text-red-600 dark:text-red-400"></i>
                </div>
                <h2
                    class="mt-6 text-center text-2xl font-bold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Account Suspended
                </h2>
                <p
                    class="mt-2 text-center text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                    Your account access has been temporarily restricted
                </p>
            </div>

            <!-- Content Card -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                <!-- Suspension Message -->
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-900/40">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <i class="fas fa-exclamation-circle text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800 dark:text-red-200">
                                {{ $message }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Common Reasons -->
                <div
                    class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <h3
                        class="mb-2 flex items-center text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        <i
                            class="fas fa-info-circle mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        Common reasons for suspension:
                    </h3>
                    <ul
                        class="space-y-1 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>
                            Violation of terms of service
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>
                            Suspicious or fraudulent activity
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>
                            Payment or billing issues
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>
                            Administrative review in progress
                        </li>
                    </ul>
                </div>

                <!-- Contact Information -->
                <div
                    class="mb-6 rounded-lg border border-blue-200 bg-blue-50 p-4 dark:border-blue-800 dark:bg-blue-900/40">
                    <h3 class="mb-3 flex items-center text-sm font-medium text-blue-800 dark:text-blue-200">
                        <i class="fas fa-headset mr-2"></i>
                        Contact Support Team
                    </h3>
                    <div class="space-y-2 text-sm text-blue-700 dark:text-blue-300">
                        <div class="flex items-center">
                            <i class="fas fa-envelope mr-3 w-4"></i>
                            <a href="mailto:{{ $contact_email }}" class="font-medium hover:underline">
                                {{ $contact_email }}
                            </a>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-ticket-alt mr-3 w-4"></i>
                            <a href="{{ $support_url }}" class="font-medium hover:underline">
                                Submit a Support Ticket
                            </a>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-3 w-4"></i>
                            <span>Response within 24-48 hours</span>
                        </div>
                    </div>
                </div>

                <!-- What to Include -->
                <div
                    class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <h3
                        class="mb-2 flex items-center text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        <i
                            class="fas fa-clipboard-list mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        When contacting support, please include:
                    </h3>
                    <ul
                        class="space-y-1 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <li class="flex items-center">
                            <i class="fas fa-check mr-2 text-xs text-green-500"></i>
                            Your account email address
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check mr-2 text-xs text-green-500"></i>
                            Account or user ID (if known)
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check mr-2 text-xs text-green-500"></i>
                            Detailed explanation of your situation
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check mr-2 text-xs text-green-500"></i>
                            Any relevant documentation
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col space-y-3 sm:flex-row sm:space-x-3 sm:space-y-0">
                    <a href="mailto:{{ $contact_email }}"
                        class="shadow-xs inline-flex flex-1 items-center justify-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                        <i class="fas fa-envelope h-4 w-4"></i>
                        Email Support
                    </a>
                    <a href="{{ $support_url }}"
                        class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2.5 text-sm font-semibold text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
                        <i class="fas fa-ticket-alt h-4 w-4"></i>
                        Create Ticket
                    </a>
                </div>

                <!-- Important Notice -->
                <div
                    class="mt-6 rounded-lg border border-yellow-200 bg-yellow-50 p-3 dark:border-yellow-800 dark:bg-yellow-900/40">
                    <div class="flex items-start">
                        <div class="shrink-0">
                            <i class="fas fa-exclamation-triangle mt-0.5 text-yellow-400"></i>
                        </div>
                        <div class="ml-3">
                            <h4 class="mb-1 text-xs font-medium text-yellow-800 dark:text-yellow-200">
                                Important Notice
                            </h4>
                            <p class="text-xs text-yellow-700 dark:text-yellow-300">
                                Please do not create multiple tickets for the same issue. Our support team will review
                                your case and respond as quickly as possible.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Account ID (for reference) -->
                @if (auth()->check())
                    <div class="mt-4 text-center">
                        <p
                            class="text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            Account ID: <span class="font-mono">{{ auth()->user()->id }}</span>
                        </p>
                    </div>
                @endif
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

        // Add subtle animation to contact methods
        const contactItems = document.querySelectorAll('.flex.items-center');
        contactItems.forEach((item, index) => {
            if (item.querySelector('.fas.fa-envelope, .fas.fa-ticket-alt, .fas.fa-clock')) {
                item.style.opacity = '0';
                item.style.transform = 'translateX(-10px)';
                item.style.transition = 'all 0.3s ease';

                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'translateX(0)';
                }, 300 + (index * 100));
            }
        });

        // Copy account ID to clipboard functionality
        const accountId = document.querySelector('.font-mono');
        if (accountId) {
            accountId.style.cursor = 'pointer';
            accountId.title = 'Click to copy Account ID';

            accountId.addEventListener('click', function() {
                navigator.clipboard.writeText(this.textContent).then(() => {
                    const originalText = this.textContent;
                    this.textContent = 'Copied!';
                    this.classList.add('text-green-600');

                    setTimeout(() => {
                        this.textContent = originalText;
                        this.classList.remove('text-green-600');
                    }, 1000);
                });
            });
        }
    });
</script>
