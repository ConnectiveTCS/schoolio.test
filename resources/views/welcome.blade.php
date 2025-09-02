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

        <!-- Hero Section -->
        <section
            class="from-primary-50 bg-gradient-to-br to-white pb-12 pt-20 transition-colors duration-300 dark:from-gray-800 dark:to-gray-900 lg:pb-20 lg:pt-32">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="items-center lg:grid lg:grid-cols-2 lg:gap-8">
                    <div class="mb-12 lg:mb-0">
                        <h1 class="mb-6 text-4xl font-bold leading-tight text-gray-900 dark:text-white lg:text-6xl">
                            Transform Your School with
                            <span class="text-primary-600 dark:text-primary-400">Modern Management</span>
                        </h1>
                        <p class="mb-8 text-xl leading-relaxed text-gray-600 dark:text-gray-300">
                            Streamline operations, enhance communication, and empower your academic community with
                            Schoolio's comprehensive multi-tenant school management platform.
                        </p>
                        <div class="flex flex-col gap-4 sm:flex-row">
                            <a href="#subscribe"
                                class="bg-primary-600 hover:bg-primary-700 transform rounded-lg px-8 py-4 text-center text-lg font-semibold text-white shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                                Start 30-Day Free Trial
                            </a>
                            <a href="#features"
                                class="rounded-lg border-2 border-gray-300 px-8 py-4 text-center text-lg font-semibold text-gray-700 transition-colors hover:border-gray-400 dark:border-gray-600 dark:text-gray-300 dark:hover:border-gray-500">
                                Learn More
                            </a>
                        </div>
                        <div class="mt-8 flex items-center space-x-6 text-sm text-gray-500 dark:text-gray-400">
                            <div class="flex items-center">
                                <svg class="mr-2 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                No setup fees
                            </div>
                            <div class="flex items-center">
                                <svg class="mr-2 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Cancel anytime
                            </div>
                            <div class="flex items-center">
                                <svg class="mr-2 h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                24/7 Support
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <div
                            class="rotate-3 transform rounded-2xl border bg-white p-8 shadow-2xl transition-transform duration-300 hover:rotate-0 dark:border-gray-700 dark:bg-gray-800">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div class="h-3 w-3 rounded-full bg-red-400"></div>
                                    <div class="h-3 w-3 rounded-full bg-yellow-400"></div>
                                    <div class="h-3 w-3 rounded-full bg-green-400"></div>
                                </div>
                                <div class="bg-primary-50 dark:bg-primary-900/30 rounded-lg p-4">
                                    <div class="bg-primary-200 dark:bg-primary-400/50 mb-2 h-4 w-3/4 rounded"></div>
                                    <div class="bg-primary-100 dark:bg-primary-500/30 h-3 w-1/2 rounded"></div>
                                </div>
                                <div class="grid grid-cols-3 gap-3">
                                    <div class="rounded bg-gray-100 p-3 text-center dark:bg-gray-700">
                                        <div class="text-primary-600 dark:text-primary-400 text-2xl font-bold">245
                                        </div>
                                        <div class="text-xs text-gray-600 dark:text-gray-400">Students</div>
                                    </div>
                                    <div class="rounded bg-gray-100 p-3 text-center dark:bg-gray-700">
                                        <div class="text-primary-600 dark:text-primary-400 text-2xl font-bold">18</div>
                                        <div class="text-xs text-gray-600 dark:text-gray-400">Teachers</div>
                                    </div>
                                    <div class="rounded bg-gray-100 p-3 text-center dark:bg-gray-700">
                                        <div class="text-primary-600 dark:text-primary-400 text-2xl font-bold">12</div>
                                        <div class="text-xs text-gray-600 dark:text-gray-400">Classes</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="bg-white py-20 transition-colors duration-300 dark:bg-gray-900">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-16 text-center">
                    <h2 class="mb-4 text-3xl font-bold text-gray-900 dark:text-white lg:text-4xl">
                        Everything You Need to Manage Your School
                    </h2>
                    <p class="mx-auto max-w-3xl text-xl text-gray-600 dark:text-gray-300">
                        From student enrollment to parent communication, Schoolio provides all the tools your
                        educational institution needs to thrive in the digital age.
                    </p>
                </div>

                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Feature 1 -->
                    <div
                        class="rounded-xl border border-gray-200 bg-white p-8 transition-shadow hover:shadow-lg dark:border-gray-700 dark:bg-gray-800">
                        <div
                            class="bg-primary-100 dark:bg-primary-900/30 mb-6 flex h-12 w-12 items-center justify-center rounded-lg">
                            <svg class="text-primary-600 dark:text-primary-400 h-6 w-6" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900 dark:text-white">Multi-Tenant Architecture
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">Secure, isolated environments for each school with
                            complete data
                            separation and customizable branding.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div
                        class="rounded-xl border border-gray-200 bg-white p-8 transition-shadow hover:shadow-lg dark:border-gray-700 dark:bg-gray-800">
                        <div
                            class="bg-primary-100 dark:bg-primary-900/30 mb-6 flex h-12 w-12 items-center justify-center rounded-lg">
                            <svg class="text-primary-600 dark:text-primary-400 h-6 w-6" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900 dark:text-white">Smart Class Management
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">Organize classes, assign teachers, enroll students,
                            and track academic
                            progress with intuitive tools.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div
                        class="rounded-xl border border-gray-200 bg-white p-8 transition-shadow hover:shadow-lg dark:border-gray-700 dark:bg-gray-800">
                        <div
                            class="bg-primary-100 dark:bg-primary-900/30 mb-6 flex h-12 w-12 items-center justify-center rounded-lg">
                            <svg class="text-primary-600 dark:text-primary-400 h-6 w-6" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900 dark:text-white">Role-Based Announcements
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">Send targeted communications to teachers, students,
                            parents, or
                            administrators with file attachments.</p>
                    </div>

                    <!-- Feature 4 -->
                    <div
                        class="rounded-xl border border-gray-200 bg-white p-8 transition-shadow hover:shadow-lg dark:border-gray-700 dark:bg-gray-800">
                        <div
                            class="bg-primary-100 dark:bg-primary-900/30 mb-6 flex h-12 w-12 items-center justify-center rounded-lg">
                            <svg class="text-primary-600 dark:text-primary-400 h-6 w-6" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900 dark:text-white">Integrated Support System
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">Built-in ticketing system connecting schools with
                            central support team
                            for quick issue resolution.</p>
                    </div>

                    <!-- Feature 5 -->
                    <div
                        class="rounded-xl border border-gray-200 bg-white p-8 transition-shadow hover:shadow-lg dark:border-gray-700 dark:bg-gray-800">
                        <div
                            class="bg-primary-100 dark:bg-primary-900/30 mb-6 flex h-12 w-12 items-center justify-center rounded-lg">
                            <svg class="text-primary-600 dark:text-primary-400 h-6 w-6" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900 dark:text-white">Secure & Compliant</h3>
                        <p class="text-gray-600 dark:text-gray-300">Enterprise-grade security with data isolation,
                            role-based permissions,
                            and audit trails.</p>
                    </div>

                    <!-- Feature 6 -->
                    <div
                        class="rounded-xl border border-gray-200 bg-white p-8 transition-shadow hover:shadow-lg dark:border-gray-700 dark:bg-gray-800">
                        <div
                            class="bg-primary-100 dark:bg-primary-900/30 mb-6 flex h-12 w-12 items-center justify-center rounded-lg">
                            <svg class="text-primary-600 dark:text-primary-400 h-6 w-6" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900 dark:text-white">Lightning Fast Setup</h3>
                        <p class="text-gray-600 dark:text-gray-300">Get your school up and running in minutes with
                            automated onboarding
                            and intuitive configuration.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How it Works Section -->
        <section id="how-it-works" class="bg-gray-50 py-20 transition-colors duration-300 dark:bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-16 text-center">
                    <h2 class="mb-4 text-3xl font-bold text-gray-900 dark:text-white lg:text-4xl">
                        Get Started in 3 Simple Steps
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300">
                        From signup to full operation in less than 30 minutes
                    </p>
                </div>

                <div class="grid gap-8 md:grid-cols-3">
                    <div class="text-center">
                        <div
                            class="bg-primary-600 mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full">
                            <span class="text-xl font-bold text-white">1</span>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900 dark:text-white">Sign Up & Configure</h3>
                        <p class="text-gray-600 dark:text-gray-300">Create your school account, customize your
                            branding, and set up your
                            institution details in minutes.</p>
                    </div>

                    <div class="text-center">
                        <div
                            class="bg-primary-600 mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full">
                            <span class="text-xl font-bold text-white">2</span>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900 dark:text-white">Add Your Team</h3>
                        <p class="text-gray-600 dark:text-gray-300">Invite teachers, add students and parents. Everyone
                            gets automatic
                            credentials and welcome emails.</p>
                    </div>

                    <div class="text-center">
                        <div
                            class="bg-primary-600 mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full">
                            <span class="text-xl font-bold text-white">3</span>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-900 dark:text-white">Start Managing</h3>
                        <p class="text-gray-600 dark:text-gray-300">Create classes, send announcements, and begin
                            transforming your
                            school's operations immediately.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section id="subscribe" class="bg-white dark:bg-gray-900 py-20 bg-">
            <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
                <h2 class="mb-6 text-3xl font-bold text-black dark:text-white lg:text-4xl">
                    Ready to Transform Your School?
                </h2>
                <p class="text-primary-100 mx-auto mb-8 max-w-2xl text-xl">
                    Join hundreds of educational institutions already using Schoolio to streamline their operations and
                    enhance their academic community.
                </p>

                <div class="mx-auto max-w-md rounded-2xl bg-white/10 p-8 backdrop-blur-sm">
                    <div class="mb-6">
                        <div class="mb-2 text-4xl font-bold text-black dark:text-white">30 Days</div>
                        <div class="text-primary-100">Free Trial</div>
                        <div class="text-primary-200 mt-2 text-sm">No credit card required</div>
                    </div>

                    <form class="space-y-4" action="#" method="POST">
                        <div>
                            <input type="text" name="school_name" placeholder="School Name" required
                                class="placeholder-primary-200 w-full rounded-lg border border-white/30 bg-white/20 px-4 py-3 text-black dark:text-white focus:outline-none focus:ring-2 focus:ring-white/50">
                        </div>
                        <div>
                            <input type="email" name="email" placeholder="Administrator Email" required
                                class="placeholder-primary-200 w-full rounded-lg border border-white/30 bg-white/20 px-4 py-3 text-black dark:text-white focus:outline-none focus:ring-2 focus:ring-white/50">
                        </div>
                        <div>
                            <select name="school_type" required
                                class="w-full rounded-lg border border-white/30 bg-white/20 px-4 py-3 text-black dark:text-white focus:outline-none focus:ring-2 focus:ring-white/50">
                                <option value="">Select School Type</option>
                                <option value="primary">Primary School</option>
                                <option value="secondary">Secondary School</option>
                                <option value="university">University</option>
                                <option value="vocational">Vocational School</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="text-primary-600 w-full transform rounded-lg bg-white px-8 py-4 font-semibold transition-colors hover:scale-105 hover:bg-gray-100">
                            Start My Free Trial
                        </button>
                    </form>

                    <div class="text-primary-200 mt-6 text-sm">
                        By signing up, you agree to our Terms of Service and Privacy Policy
                    </div>
                </div>
            </div>
        </section>

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
