<!DOCTYPE html>
<html lang="en" class="h-full">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $tenant->name }} - Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .gradient-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }

            .dark-gradient-bg {
                background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            }

            /* Smooth transition for theme changes */
            * {
                transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
            }
        </style>
        <script>
            // Check for saved theme preference or default to 'light'
            const theme = localStorage.getItem('theme') || 'light';

            // Apply theme immediately to prevent flash
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }

            // Theme toggle function
            function toggleTheme() {
                const html = document.documentElement;
                const isDark = html.classList.contains('dark');

                if (isDark) {
                    html.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    html.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
            }

            // Set initial theme after DOM loads
            document.addEventListener('DOMContentLoaded', function() {
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                }
            });
        </script>
    </head>

    <body class=" bg-gray-50 dark:bg-gray-900">
        <!-- Header -->
        <header class="border-b border-gray-200 bg-white shadow-lg dark:border-gray-700 dark:bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between py-4">
                    <!-- Logo and Brand -->
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <img src="{{ asset($tenant->logo) }}"
                            alt="{{ $tenant->name ?? 'School' }}" class="h-12 w-12 rounded-full object-cover">
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $tenant->name }}</h1>
                            <p class="text-sm text-gray-600 dark:text-gray-300">School Management System</p>
                        </div>
                    </div>

                    <!-- Navigation Links and Theme Toggle -->
                    <div class="flex items-center space-x-6">
                        <nav class="hidden items-center space-x-8 md:flex">
                            <a href="#features"
                                class="font-medium text-gray-700 transition-colors duration-200 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Features
                            </a>
                            <a href="#pricing"
                                class="font-medium text-gray-700 transition-colors duration-200 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Pricing
                            </a>
                            <a href="#support"
                                class="font-medium text-gray-700 transition-colors duration-200 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Support
                            </a>
                            <a href="#contact"
                                class="font-medium text-gray-700 transition-colors duration-200 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Contact
                            </a>
                        </nav>

                        <!-- Theme Toggle Button -->
                        <button onclick="toggleTheme()"
                            class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200 dark:focus:ring-offset-gray-800"
                            title="Toggle theme">
                            <!-- Sun icon (visible in dark mode) -->
                            <svg class="hidden h-6 w-6 dark:block" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <!-- Moon icon (visible in light mode) -->
                            <svg class="block h-6 w-6 dark:hidden" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </button>

                        <!-- Mobile menu button -->
                        <div class="md:hidden">
                            <button type="button"
                                class="text-gray-700 transition-colors duration-200 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content -->
        <main class=" bg-gray-50 dark:bg-gray-900">
            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">

                    <!-- Welcome Section -->
                    <div class="space-y-8">
                        <div class="space-y-6">
                            <h2 class="text-4xl font-bold leading-tight text-gray-900 dark:text-white">
                                Welcome to <span class="text-indigo-600 dark:text-indigo-400">Schoolio</span>
                            </h2>
                            <p class="text-xl leading-relaxed text-gray-600 dark:text-gray-300">
                                A comprehensive multi-communications SaaS platform designed specifically for educational
                                institutions.
                            </p>
                        </div>

                        <!-- Features List -->
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-green-500 dark:text-green-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="font-medium text-gray-700 dark:text-gray-300">Student & Teacher Management</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-green-500 dark:text-green-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="font-medium text-gray-700 dark:text-gray-300">Real-time Communication Tools
                                </p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-green-500 dark:text-green-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="font-medium text-gray-700 dark:text-gray-300">Grade & Assignment Tracking</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-green-500 dark:text-green-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="font-medium text-gray-700 dark:text-gray-300">Attendance & Analytics</p>
                            </div>
                        </div>

                        <!-- Call to Action -->
                        <div class="pt-4">
                            <p class="text-lg text-gray-600 dark:text-gray-400">
                                Ready to transform your school's communication? Log in to get started.
                            </p>
                        </div>
                    </div>

                    <!-- Login Form Section -->
                    <div class="mx-auto w-full max-w-md">
                        <div
                            class="rounded-2xl border border-gray-100 bg-white p-8 shadow-xl dark:border-gray-700 dark:bg-gray-800">
                            <div class="mb-8 text-center">
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Sign In</h3>
                                <p class="mt-2 text-gray-600 dark:text-gray-400">Access your {{ $tenant->name }}
                                    account</p>
                            </div>

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                                @csrf

                                <!-- Email Address -->
                                <div>
                                    <x-input-label for="email" :value="__('Email')"
                                        class="font-medium text-gray-700 dark:text-gray-300" />
                                    <x-text-input id="email"
                                        class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 transition-colors duration-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-indigo-400 dark:focus:ring-indigo-400"
                                        type="email" name="email" :value="old('email')" required autofocus
                                        autocomplete="username" placeholder="Enter your email address" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Password -->
                                <div>
                                    <x-input-label for="password" :value="__('Password')"
                                        class="font-medium text-gray-700 dark:text-gray-300" />
                                    <x-text-input id="password"
                                        class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 transition-colors duration-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-indigo-400 dark:focus:ring-indigo-400"
                                        type="password" name="password" required autocomplete="current-password"
                                        placeholder="Enter your password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Remember Me -->
                                <div class="flex items-center justify-between">
                                    <label for="remember_me" class="flex items-center">
                                        <input id="remember_me" type="checkbox"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm transition-colors duration-200 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-indigo-400 dark:focus:ring-indigo-400 dark:focus:ring-offset-gray-800"
                                            name="remember">
                                        <span
                                            class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                    </label>

                                    @if (Route::has('password.request'))
                                        <a class="text-sm font-medium text-indigo-600 transition-colors duration-200 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300"
                                            href="{{ route('password.request') }}">
                                            {{ __('Forgot password?') }}
                                        </a>
                                    @endif
                                </div>

                                <!-- Submit Button -->
                                <div class="pt-2">
                                    <x-primary-button
                                        class="w-full rounded-lg bg-indigo-600 px-4 py-3 font-semibold text-white transition-colors duration-200 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:bg-indigo-500 dark:hover:bg-indigo-600 dark:focus:ring-indigo-400 dark:focus:ring-offset-gray-800">
                                        {{ __('Sign In') }}
                                    </x-primary-button>
                                </div>
                            </form>

                            <!-- Additional Links -->
                            <div class="mt-6 text-center">
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Need help?
                                    <a href="#support"
                                        class="font-medium text-indigo-600 transition-colors duration-200 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                                        Contact Support
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>

</html>
