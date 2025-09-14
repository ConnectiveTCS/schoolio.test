@extends('layouts.guest')

@section('title', 'Error')

<x-guest-layout>
    <div
        class="flex min-h-screen items-center justify-center bg-[color:var(--color-light-dark-green)] px-4 py-12 transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        <div class="w-full max-w-md">
            <!-- Logo and Header -->
            <div class="mb-8 text-center">
                <div
                    class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/20">
                    <i class="fas fa-exclamation-circle text-2xl text-red-600 dark:text-red-400"></i>
                </div>
                <h2
                    class="mt-6 text-center text-2xl font-bold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    {{ $title }}
                </h2>
                <p
                    class="mt-2 text-center text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                    Something went wrong while processing your request
                </p>
            </div>

            <!-- Content Card -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                <!-- Error Message -->
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-900/40">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <i class="fas fa-times-circle text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800 dark:text-red-200">
                                {{ $message }}
                            </p>
                            @if ($error_code)
                                <p class="mt-1 text-xs text-red-600 dark:text-red-300">
                                    Error Code: {{ $error_code }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Troubleshooting Steps -->
                <div
                    class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <h3
                        class="mb-2 flex items-center text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        <i
                            class="fas fa-tools mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        What you can try:
                    </h3>
                    <ul
                        class="space-y-1 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>
                            Refresh the page and try again
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>
                            Check your internet connection
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>
                            Clear your browser cache
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>
                            Contact support if the problem persists
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col space-y-3 sm:flex-row sm:space-x-3 sm:space-y-0">
                    <a href="{{ $redirect_url }}"
                        class="shadow-xs inline-flex flex-1 items-center justify-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                        <i class="fas fa-redo h-4 w-4"></i>
                        {{ $redirect_text }}
                    </a>
                    <a href="{{ $support_link }}"
                        class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2.5 text-sm font-semibold text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
                        <i class="fas fa-life-ring h-4 w-4"></i>
                        Get Help
                    </a>
                </div>

                <!-- Technical Details (Collapsible) -->
                <div class="mt-6">
                    <button type="button" onclick="toggleTechnicalDetails()"
                        class="text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-castleton-green)]">
                        <i class="fas fa-chevron-down mr-1" id="tech-icon"></i>
                        Show Technical Details
                    </button>
                    <div id="technical-details"
                        class="mt-3 hidden rounded border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-3 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                        <pre class="overflow-x-auto text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
Error Code: {{ $error_code }}
Time: {{ now()->toDateTimeString() }}
Request ID: {{ request()->getRequest()->getRequestId() ?? 'N/A' }}
User Agent: {{ request()->userAgent() }}
                        </pre>
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
    });

    function toggleTechnicalDetails() {
        const details = document.getElementById('technical-details');
        const icon = document.getElementById('tech-icon');
        const button = event.target.closest('button');

        if (details.classList.contains('hidden')) {
            details.classList.remove('hidden');
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
            button.innerHTML = '<i class="fas fa-chevron-up mr-1" id="tech-icon"></i>Hide Technical Details';
        } else {
            details.classList.add('hidden');
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
            button.innerHTML = '<i class="fas fa-chevron-down mr-1" id="tech-icon"></i>Show Technical Details';
        }
    }
</script>
