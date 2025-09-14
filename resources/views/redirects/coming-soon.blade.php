@extends('layouts.guest')

@section('title', 'Coming Soon')

<x-guest-layout>
    <div
        class="flex min-h-screen items-center justify-center bg-[color:var(--color-light-dark-green)] px-4 py-12 transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        <div class="w-full max-w-md">
            <!-- Logo and Header -->
            <div class="mb-8 text-center">
                <div
                    class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/20">
                    <i class="fas fa-rocket text-2xl text-blue-600 dark:text-blue-400"></i>
                </div>
                <h2
                    class="mt-6 text-center text-2xl font-bold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    {{ $feature_name }} Coming Soon!
                </h2>
                <p
                    class="mt-2 text-center text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                    We're working hard to bring you something amazing
                </p>
            </div>

            <!-- Content Card -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                <!-- Feature Message -->
                <div
                    class="mb-6 rounded-lg border border-blue-200 bg-blue-50 p-4 dark:border-blue-800 dark:bg-blue-900/40">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <i class="fas fa-info-circle text-blue-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-blue-800 dark:text-blue-200">
                                {{ $message }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- What to Expect -->
                <div
                    class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <h3
                        class="mb-3 flex items-center text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        <i
                            class="fas fa-star mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        What to expect:
                    </h3>
                    <div
                        class="grid grid-cols-2 gap-3 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <div class="flex items-center">
                            <i class="fas fa-check mr-2 text-xs text-green-500"></i>
                            Enhanced Features
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check mr-2 text-xs text-green-500"></i>
                            Better Performance
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check mr-2 text-xs text-green-500"></i>
                            Intuitive Design
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check mr-2 text-xs text-green-500"></i>
                            Mobile Friendly
                        </div>
                    </div>
                </div>

                @if ($notify_url)
                    <!-- Notification Signup -->
                    <div
                        class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                        <h3
                            class="mb-2 flex items-center text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            <i
                                class="fas fa-bell mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Get Notified
                        </h3>
                        <p
                            class="mb-3 text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            Be the first to know when {{ $feature_name }} is ready!
                        </p>
                        <form action="{{ $notify_url }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="email" name="email" placeholder="Enter your email"
                                class="flex-1 rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-xs text-[color:var(--color-dark-green)] focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            <button type="submit"
                                class="rounded-md bg-[color:var(--color-castleton-green)] px-3 py-1 text-xs text-white transition-colors hover:bg-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                                Notify Me
                            </button>
                        </form>
                    </div>
                @endif

                <!-- Timeline -->
                <div
                    class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <h3
                        class="mb-3 flex items-center text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        <i
                            class="fas fa-calendar-alt mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        Development Timeline
                    </h3>
                    <div
                        class="space-y-2 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <div class="flex items-center">
                            <div class="mr-3 h-2 w-2 rounded-full bg-green-500"></div>
                            <span class="line-through opacity-75">Planning & Design</span>
                        </div>
                        <div class="flex items-center">
                            <div class="mr-3 h-2 w-2 rounded-full bg-yellow-500"></div>
                            <span class="font-medium">Development in Progress</span>
                        </div>
                        <div class="flex items-center">
                            <div class="mr-3 h-2 w-2 rounded-full bg-gray-300"></div>
                            <span class="opacity-75">Testing & Quality Assurance</span>
                        </div>
                        <div class="flex items-center">
                            <div class="mr-3 h-2 w-2 rounded-full bg-gray-300"></div>
                            <span class="opacity-75">Launch & Deployment</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col space-y-3 sm:flex-row sm:space-x-3 sm:space-y-0">
                    <a href="{{ $redirect_url }}"
                        class="shadow-xs inline-flex flex-1 items-center justify-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                        <i class="fas fa-arrow-left h-4 w-4"></i>
                        {{ $redirect_text }}
                    </a>
                    <a href="{{ route('tenant.support.index') }}"
                        class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2.5 text-sm font-semibold text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
                        <i class="fas fa-comments h-4 w-4"></i>
                        Share Feedback
                    </a>
                </div>

                <!-- Follow Progress -->
                <div class="mt-6 text-center">
                    <p class="text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        Want to follow our progress?
                        <a href="{{ route('dashboard') }}"
                            class="font-medium text-[color:var(--color-castleton-green)] hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                            Check Updates
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

        // Animate timeline items
        const timelineItems = document.querySelectorAll('.space-y-2 > div');
        timelineItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateX(-20px)';
            item.style.transition = 'all 0.3s ease';

            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            }, 200 + (index * 100));
        });

        // Handle notification form submission
        const notifyForm = document.querySelector('form[action*="notify"]');
        if (notifyForm) {
            notifyForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const button = this.querySelector('button[type="submit"]');
                const originalText = button.textContent;

                button.textContent = 'Added!';
                button.classList.add('bg-green-500', 'hover:bg-green-600');
                button.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    button.textContent = originalText;
                    button.classList.remove('bg-green-500', 'hover:bg-green-600');
                    button.disabled = false;
                }, 2000);
            });
        }
    });
</script>
