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

            /* Enhanced transitions for interactive elements */
            input,
            button,
            a {
                transition: all 0.2s ease;
            }

            /* Focus states for better accessibility */
            input:focus,
            button:focus {
                outline: none;
                box-shadow: 0 0 0 3px rgba(36, 91, 71, 0.1);
            }

            .dark input:focus,
            .dark button:focus {
                box-shadow: 0 0 0 3px rgba(206, 232, 223, 0.1);
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

    <body
        class="bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        <!-- Header -->
        <header
            class="border-b border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between py-4">
                    <!-- Logo and Brand -->
                    <div class="flex items-center space-x-4">
                        <div class="shrink-0">
                            <img src="{{ asset($tenant->logo) }}" alt="{{ $tenant->name ?? 'School' }}"
                                class="h-12 w-12 object-cover ring-[color:var(--color-brunswick-green)] dark:ring-[color:var(--color-light-brunswick-green)]">
                        </div>
                        <div>
                            <h1
                                class="text-2xl font-bold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                {{ $tenant->name }}</h1>
                            <p
                                class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                School Management System</p>
                        </div>
                    </div>

                    <!-- Navigation Links and Theme Toggle -->
                    <div class="flex items-center space-x-6">
                        <nav class="hidden items-center space-x-8 md:flex">
                            <a href="#features"
                                class="font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                Features
                            </a>
                            <a href="#pricing"
                                class="font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                Pricing
                            </a>
                            <a href="#support"
                                class="font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                Support
                            </a>
                            <a href="#contact"
                                class="font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                Contact
                            </a>
                        </nav>

                        <!-- Theme Toggle Button -->
                        <button onclick="toggleTheme()"
                            class="focus:outline-hidden rounded-lg p-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] hover:text-[color:var(--color-dark-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-castleton-green)] dark:hover:text-[color:var(--color-light-dark-green)] dark:focus:ring-[color:var(--color-light-castleton-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]"
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
                                class="text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]">
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
        <main
            class="bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">

                    <!-- Welcome Section -->
                    <div class="space-y-8">
                        <div class="space-y-6">
                            <h2
                                class="text-4xl font-bold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                Welcome to <span
                                    class="text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]">Schoolio</span>
                            </h2>
                            <p
                                class="text-xl leading-relaxed text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                A comprehensive multi-communications SaaS platform designed specifically for educational
                                institutions.
                            </p>
                        </div>

                        <!-- Features List -->
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="shrink-0">
                                    <svg class="h-6 w-6 text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:text-[color:var(--color-light-castleton-green)]"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p
                                    class="font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Student & Teacher Management</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="shrink-0">
                                    <svg class="h-6 w-6 text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:text-[color:var(--color-light-castleton-green)]"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p
                                    class="font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Real-time Communication Tools
                                </p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="shrink-0">
                                    <svg class="h-6 w-6 text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:text-[color:var(--color-light-castleton-green)]"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p
                                    class="font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Grade & Assignment Tracking</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="shrink-0">
                                    <svg class="h-6 w-6 text-[color:var(--color-castleton-green)] transition-colors duration-200 dark:text-[color:var(--color-light-castleton-green)]"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p
                                    class="font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Attendance & Analytics</p>
                            </div>
                        </div>

                        <!-- Call to Action -->
                        <div class="pt-4">
                            <p
                                class="text-lg text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                Ready to transform your school's communication? Log in to get started.
                            </p>
                        </div>
                    </div>

                    <!-- Login Form Section -->
                    <div class="mx-auto w-full max-w-md">
                        <div
                            class="rounded-2xl border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-8 shadow-xl transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                            <div class="mb-8 text-center">
                                <h3
                                    class="text-2xl font-bold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Sign In</h3>
                                <p
                                    class="mt-2 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Access your {{ $tenant->name }}
                                    account</p>
                            </div>

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                                @csrf

                                <!-- Email Address -->
                                <div>
                                    <x-input-label for="email" :value="__('Email')"
                                        class="font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]" />
                                    <x-text-input id="email"
                                        class="mt-2 block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-3 text-[color:var(--color-dark-green)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                        type="email" name="email" :value="old('email')" required autofocus
                                        autocomplete="username" placeholder="Enter your email address" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Password -->
                                <div>
                                    <x-input-label for="password" :value="__('Password')"
                                        class="font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]" />
                                    <x-text-input id="password"
                                        class="mt-2 block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-3 text-[color:var(--color-dark-green)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                        type="password" name="password" required autocomplete="current-password"
                                        placeholder="Enter your password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Remember Me -->
                                <div class="flex items-center justify-between">
                                    <label for="remember_me" class="flex items-center">
                                        <input id="remember_me" type="checkbox"
                                            class="shadow-xs rounded-sm border-[color:var(--color-light-brunswick-green)] text-[color:var(--color-castleton-green)] transition-colors duration-200 focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)] dark:focus:ring-offset-[color:var(--color-brunswick-green)]"
                                            name="remember">
                                        <span
                                            class="ml-2 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">{{ __('Remember me') }}</span>
                                    </label>

                                    @if (Route::has('password.request'))
                                        <a class="text-sm font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]"
                                            href="{{ route('password.request') }}">
                                            {{ __('Forgot password?') }}
                                        </a>
                                    @endif
                                </div>

                                <!-- Submit Button -->
                                <div class="pt-2">
                                    <x-primary-button
                                        class="w-full rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-3 font-semibold text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-light-castleton-green)] dark:focus:ring-offset-[color:var(--color-brunswick-green)]">
                                        {{ __('Sign In') }}
                                    </x-primary-button>
                                </div>
                            </form>

                            <!-- Additional Links -->
                            <div class="mt-6 text-center">
                                <p
                                    class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    Need help?
                                    <a href="#support"
                                        class="font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
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
