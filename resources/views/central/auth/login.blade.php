@extends('central.layout')

@section('title', 'Central Admin Login')

@section('content')
    <div
        class="min-h-screen min-w-full bg-[color:var(--color-light-dark-green)] px-4 py-8 transition-colors duration-200 sm:px-6 lg:px-8 dark:bg-[color:var(--color-dark-green)]">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div
                class="mb-6 rounded-lg border border-[color:var(--color-castleton-green)] bg-[color:var(--color-light-castleton-green)] p-4 text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]">
                <div class="flex items-center">
                    <i
                        class="fas fa-check-circle mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="mx-auto flex min-h-screen max-w-md items-center justify-center">
            <div
                class="w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-8 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">

                <!-- Login Header -->
                <div class="mb-8 text-center">
                    <h2
                        class="flex items-center justify-center text-2xl font-bold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        <i
                            class="fas fa-crown mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        {{ __('Central Admin Login') }}
                    </h2>
                    <p
                        class="mt-2 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        Sign in to your central admin account
                    </p>
                </div>

                <!-- Login Form -->
                <form method="POST" action="/central/login" aria-label="Central Admin Login Form">
                    @csrf

                    <!-- Email Field -->
                    <div class="mb-6">
                        <label for="email"
                            class="mb-2 flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-envelope mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Email Address') }}
                        </label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-3 text-[color:var(--color-dark-green)] placeholder-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                            placeholder="Enter your email address" value="{{ old('email') }}">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="mb-6">
                        <label for="password"
                            class="mb-2 flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-lock mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Password') }}
                        </label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-3 text-[color:var(--color-dark-green)] placeholder-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                            placeholder="Enter your password">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-6">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox"
                                class="mr-3 h-4 w-4 rounded-sm border-[color:var(--color-light-brunswick-green)] text-[color:var(--color-castleton-green)] transition-colors duration-200 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            <label for="remember"
                                class="flex cursor-pointer items-center text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-check-circle mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Remember me') }}
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="shadow-xs inline-flex w-full items-center justify-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-6 py-3 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                            <i class="fas fa-sign-in-alt h-4 w-4"></i>
                            {{ __('Sign In') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
