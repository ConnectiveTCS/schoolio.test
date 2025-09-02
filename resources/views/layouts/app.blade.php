<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches) }"
    x-bind:class="{ 'dark': darkMode }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Schoolio - Modern School Management Platform</title>
        <meta name="description"
            content="Transform your educational institution with Schoolio's comprehensive multi-tenant school management platform. Streamline operations, enhance communication, and empower your academic community.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                        },
                        colors: {
                            primary: {
                                50: '#eff6ff',
                                500: '#3b82f6',
                                600: '#2563eb',
                                700: '#1d4ed8',
                            }
                        }
                    }
                }
            }
        </script>

        <!-- Alpine.js for interactions -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>

    <body
        class="bg-white font-sans text-gray-900 antialiased transition-colors duration-300 dark:bg-gray-900 dark:text-gray-100">
        <!-- Navigation -->
        <nav class="fixed top-0 z-50 w-full border-b border-gray-200 bg-white/95 backdrop-blur-sm transition-colors duration-300 dark:border-gray-700 dark:bg-gray-900/95"
            x-data="{ mobileMenuOpen: false }">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <div class="flex flex-shrink-0 items-center">
                            <div class="bg-primary-600 flex h-8 w-8 items-center justify-center rounded-lg">
                                <span class="text-lg font-bold text-white">S</span>
                            </div>
                            <span class="ml-2 text-xl font-bold text-gray-900 dark:text-white">Schoolio</span>
                        </div>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden items-center space-x-8 md:flex">
                        <a href="#features"
                            class="text-gray-600 transition-colors hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">Features</a>
                        <a href="#how-it-works"
                            class="text-gray-600 transition-colors hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">How
                            it
                            Works</a>
                        <a href="#pricing"
                            class="text-gray-600 transition-colors hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">Pricing</a>
                        <a href="{{ route('central.login') }}"
                            class="text-gray-600 transition-colors hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">Login</a>

                        <!-- Theme Toggle Button -->
                        <button @click="darkMode = !darkMode"
                            class="rounded-lg p-2 text-gray-600 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white">
                            <svg x-show="!darkMode" class="h-5 w-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                                </path>
                            </svg>
                            <svg x-show="darkMode" class="h-5 w-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </button>

                        <a href="#subscribe"
                            class="bg-primary-600 hover:bg-primary-700 rounded-lg px-4 py-2 font-medium text-white transition-colors">
                            Start Free Trial
                        </a>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="flex items-center space-x-2 md:hidden">
                        <!-- Mobile Theme Toggle -->
                        <button @click="darkMode = !darkMode"
                            class="rounded-lg p-2 text-gray-600 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white">
                            <svg x-show="!darkMode" class="h-5 w-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                                </path>
                            </svg>
                            <svg x-show="darkMode" class="h-5 w-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </button>

                        <button @click="mobileMenuOpen = !mobileMenuOpen"
                            class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div x-show="mobileMenuOpen" x-transition
                class="border-t border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-900 md:hidden">
                <div class="space-y-2 px-4 py-2">
                    <a href="#features"
                        class="block py-2 text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">Features</a>
                    <a href="#how-it-works"
                        class="block py-2 text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">How
                        it Works</a>
                    <a href="#pricing"
                        class="block py-2 text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">Pricing</a>
                    <a href="{{ route('central.login') }}"
                        class="block py-2 text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">Login</a>
                    <a href="#subscribe"
                        class="bg-primary-600 hover:bg-primary-700 mt-2 block w-full rounded-lg px-4 py-2 text-center font-medium text-white">
                        Start Free Trial
                    </a>
                </div>
            </div>
        </nav>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <main
            class="from-primary-50 bg-gradient-to-br to-white pb-12 pt-20 transition-colors duration-300 dark:from-gray-800 dark:to-gray-900 lg:pb-20 lg:pt-32">
            {{ $slot }}
        </main>
        <!-- Footer -->
        <footer class="bg-gray-900 py-12 text-white transition-colors duration-300 dark:bg-black">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-8 md:grid-cols-4">
                    <div class="md:col-span-2">
                        <div class="mb-4 flex items-center">
                            <div class="bg-primary-600 flex h-8 w-8 items-center justify-center rounded-lg">
                                <span class="text-lg font-bold text-white">S</span>
                            </div>
                            <span class="ml-2 text-xl font-bold">Schoolio</span>
                        </div>
                        <p class="mb-4 max-w-md text-gray-400 dark:text-gray-500">
                            Empowering educational institutions with modern, secure, and intuitive school management
                            solutions.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#"
                                class="text-gray-400 transition-colors hover:text-white dark:text-gray-500">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="text-gray-400 transition-colors hover:text-white dark:text-gray-500">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div>
                        <h4 class="mb-4 font-semibold text-white">Product</h4>
                        <ul class="space-y-2 text-gray-400 dark:text-gray-500">
                            <li><a href="#features" class="transition-colors hover:text-white">Features</a></li>
                            <li><a href="#pricing" class="transition-colors hover:text-white">Pricing</a></li>
                            <li><a href="#" class="transition-colors hover:text-white">Security</a></li>
                            <li><a href="#" class="transition-colors hover:text-white">Integrations</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="mb-4 font-semibold text-white">Support</h4>
                        <ul class="space-y-2 text-gray-400 dark:text-gray-500">
                            <li><a href="#" class="transition-colors hover:text-white">Documentation</a></li>
                            <li><a href="#" class="transition-colors hover:text-white">Help Center</a></li>
                            <li><a href="#" class="transition-colors hover:text-white">Contact Us</a></li>
                            <li><a href="{{ route('central.login') }}"
                                    class="transition-colors hover:text-white">Admin Login</a></li>
                        </ul>
                    </div>
                </div>

                <div
                    class="mt-12 flex flex-col items-center justify-between border-t border-gray-800 pt-8 dark:border-gray-700 md:flex-row">
                    <p class="text-gray-400 dark:text-gray-500">&copy; {{ date('Y') }} Schoolio. All rights
                        reserved.</p>
                    <div class="mt-4 flex space-x-6 md:mt-0">
                        <a href="#"
                            class="text-gray-400 transition-colors hover:text-white dark:text-gray-500">Privacy
                            Policy</a>
                        <a href="#"
                            class="text-gray-400 transition-colors hover:text-white dark:text-gray-500">Terms of
                            Service</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Smooth scrolling script -->
        <script>
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        </script>
    </body>

</html>
