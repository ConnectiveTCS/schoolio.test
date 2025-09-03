@extends('central.layout')

@section('title', 'Create New Tenant')

@section('content')
    <div class="mx-auto min-h-screen max-w-4xl px-4 transition-colors duration-200 sm:px-6 lg:px-8">
        <div class="py-6">
            <div class="mb-8">
                <div class="flex items-center">
                    <a href="{{ route('central.tenants.index') }}"
                        class="mr-4 text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1
                        class="text-2xl font-bold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        Create New Tenant</h1>
                </div>
                <p
                    class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    Create a new tenant organization with its own database and domain.
                </p>
            </div>

            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <form method="POST" action="{{ route('central.tenants.store') }}" class="space-y-6">
                    @csrf

                    <div
                        class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                        <h3
                            class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            Basic Information</h3>
                    </div>

                    <div class="space-y-6 px-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="space-y-1">
                                <label for="name"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Organization Name
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                        class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-gunmetal)] transition-all duration-200 hover:border-[color:var(--color-castleton-green)] focus:border-[color:var(--color-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-castleton-green)] focus:ring-opacity-20 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-light-castleton-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                        placeholder="Enter organization name">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-building text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                                    </div>
                                </div>
                                @error('name')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="email"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Contact Email
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                        class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-gunmetal)] transition-all duration-200 hover:border-[color:var(--color-castleton-green)] focus:border-[color:var(--color-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-castleton-green)] focus:ring-opacity-20 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-light-castleton-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                        placeholder="contact@organization.com">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-envelope text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                                    </div>
                                </div>
                                @error('email')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="space-y-1">
                                <label for="phone"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Phone
                                    Number</label>
                                <div class="relative">
                                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                        class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-gunmetal)] transition-all duration-200 hover:border-[color:var(--color-castleton-green)] focus:border-[color:var(--color-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-castleton-green)] focus:ring-opacity-20 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-light-castleton-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                        placeholder="+1 (555) 123-4567">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-phone text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                                    </div>
                                </div>
                                @error('phone')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="alt_phone"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Alternative
                                    Phone</label>
                                <div class="relative">
                                    <input type="text" name="alt_phone" id="alt_phone" value="{{ old('alt_phone') }}"
                                        class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-gunmetal)] transition-all duration-200 hover:border-[color:var(--color-castleton-green)] focus:border-[color:var(--color-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-castleton-green)] focus:ring-opacity-20 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-light-castleton-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                        placeholder="+1 (555) 987-6543">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-phone text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                                    </div>
                                </div>
                                @error('alt_phone')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label for="website"
                                class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Website
                                URL</label>
                            <div class="relative">
                                <input type="url" name="website" id="website" value="{{ old('website') }}"
                                    class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-gunmetal)] transition-all duration-200 hover:border-[color:var(--color-castleton-green)] focus:border-[color:var(--color-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-castleton-green)] focus:ring-opacity-20 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-light-castleton-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                    placeholder="https://example.com">
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i
                                        class="fas fa-globe text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                                </div>
                            </div>
                            @error('website')
                                <p class="mt-1 flex items-center text-xs text-red-600">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="address"
                                class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Address</label>
                            <div class="relative">
                                <textarea name="address" id="address" rows="4"
                                    class="shadow-xs block w-full resize-y rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-gunmetal)] transition-all duration-200 hover:border-[color:var(--color-castleton-green)] focus:border-[color:var(--color-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-castleton-green)] focus:ring-opacity-20 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-light-castleton-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                    placeholder="Enter complete address">{{ old('address') }}</textarea>
                                <div class="pointer-events-none absolute right-0 top-3 flex items-start pr-3">
                                    <i
                                        class="fas fa-map-marker-alt text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                                </div>
                            </div>
                            @error('address')
                                <p class="mt-1 flex items-center text-xs text-red-600">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div
                        class="border-t border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                        <h3
                            class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            Configuration</h3>
                    </div>

                    <div class="space-y-6 px-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="space-y-1">
                                <label for="plan"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Subscription Plan
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="plan" id="plan" required
                                        class="shadow-xs block w-full cursor-pointer appearance-none rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] transition-all duration-200 hover:border-[color:var(--color-castleton-green)] focus:border-[color:var(--color-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-castleton-green)] focus:ring-opacity-20 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:border-[color:var(--color-light-castleton-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                                        <option value="">Select a plan...</option>
                                        <option value="basic" {{ old('plan') === 'basic' ? 'selected' : '' }}>Basic
                                        </option>
                                        <option value="premium" {{ old('plan') === 'premium' ? 'selected' : '' }}>Premium
                                        </option>
                                        <option value="enterprise" {{ old('plan') === 'enterprise' ? 'selected' : '' }}>
                                            Enterprise</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-chevron-down text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                                    </div>
                                </div>
                                @error('plan')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="school_type"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    School Type
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="school_type" id="school_type" required
                                        class="shadow-xs block w-full cursor-pointer appearance-none rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] transition-all duration-200 hover:border-[color:var(--color-castleton-green)] focus:border-[color:var(--color-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-castleton-green)] focus:ring-opacity-20 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:border-[color:var(--color-light-castleton-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                                        <option value="">Select school type...</option>
                                        <option value="primary" {{ old('school_type') === 'primary' ? 'selected' : '' }}>
                                            Primary School</option>
                                        <option value="secondary"
                                            {{ old('school_type') === 'secondary' ? 'selected' : '' }}>Secondary School
                                        </option>
                                        <option value="university"
                                            {{ old('school_type') === 'university' ? 'selected' : '' }}>University</option>
                                        <option value="vocational"
                                            {{ old('school_type') === 'vocational' ? 'selected' : '' }}>Vocational</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-chevron-down text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                                    </div>
                                </div>
                                @error('school_type')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="space-y-1">
                                <label for="language"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Default Language
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="language" id="language" required
                                        class="shadow-xs block w-full cursor-pointer appearance-none rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] transition-all duration-200 hover:border-[color:var(--color-castleton-green)] focus:border-[color:var(--color-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-castleton-green)] focus:ring-opacity-20 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:border-[color:var(--color-light-castleton-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                                        <option value="">Select language...</option>
                                        <option value="en" {{ old('language') === 'en' ? 'selected' : '' }}>English
                                        </option>
                                        <option value="es" {{ old('language') === 'es' ? 'selected' : '' }}>Spanish
                                        </option>
                                        <option value="fr" {{ old('language') === 'fr' ? 'selected' : '' }}>French
                                        </option>
                                        <option value="ar" {{ old('language') === 'ar' ? 'selected' : '' }}>Arabic
                                        </option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-chevron-down text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                                    </div>
                                </div>
                                @error('language')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="timezone"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                    Timezone
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="timezone" id="timezone" required
                                        class="shadow-xs block w-full cursor-pointer appearance-none rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] transition-all duration-200 hover:border-[color:var(--color-castleton-green)] focus:border-[color:var(--color-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-castleton-green)] focus:ring-opacity-20 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:border-[color:var(--color-light-castleton-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                                        <option value="">Select timezone...</option>
                                        <option value="UTC" {{ old('timezone') === 'UTC' ? 'selected' : '' }}>UTC
                                        </option>
                                        <option value="America/New_York"
                                            {{ old('timezone') === 'America/New_York' ? 'selected' : '' }}>Eastern Time
                                        </option>
                                        <option value="America/Chicago"
                                            {{ old('timezone') === 'America/Chicago' ? 'selected' : '' }}>Central Time
                                        </option>
                                        <option value="America/Denver"
                                            {{ old('timezone') === 'America/Denver' ? 'selected' : '' }}>Mountain Time
                                        </option>
                                        <option value="America/Los_Angeles"
                                            {{ old('timezone') === 'America/Los_Angeles' ? 'selected' : '' }}>Pacific Time
                                        </option>
                                        <option value="Europe/London"
                                            {{ old('timezone') === 'Europe/London' ? 'selected' : '' }}>London</option>
                                        <option value="Europe/Paris"
                                            {{ old('timezone') === 'Europe/Paris' ? 'selected' : '' }}>Paris</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-chevron-down text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                                    </div>
                                </div>
                                @error('timezone')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label for="domain" class="block text-sm font-semibold text-gray-800">
                                Domain
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="shadow-xs mt-1 flex rounded-lg">
                                <input type="text" name="domain" id="domain" value="{{ old('domain') }}"
                                    required
                                    class="block w-full min-w-0 flex-1 rounded-none rounded-l-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-gunmetal)] transition-all duration-200 hover:border-[color:var(--color-castleton-green)] focus:border-[color:var(--color-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-castleton-green)] focus:ring-opacity-20 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-light-castleton-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                    placeholder="tenant-name">
                                <span
                                    class="inline-flex items-center rounded-r-lg border border-l-0 border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)]">
                                    .schoolio.test
                                </span>
                            </div>
                            <p
                                class="mt-1 text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                This will be the subdomain for accessing the tenant.</p>
                            @error('domain')
                                <p class="mt-1 flex items-center text-xs text-red-600">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div
                        class="flex justify-end space-x-3 rounded-b-lg bg-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                        <a href="{{ route('central.tenants.index') }}"
                            class="shadow-xs focus:outline-hidden inline-flex items-center rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-6 py-3 text-sm font-semibold text-[color:var(--color-dark-green)] transition-all duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:ring-4 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-brunswick-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                        <button type="submit"
                            class="focus:outline-hidden inline-flex transform items-center rounded-lg border border-transparent bg-[color:var(--color-castleton-green)] px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-200 hover:scale-105 hover:bg-[color:var(--color-brunswick-green)] focus:ring-4 focus:ring-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            <i class="fas fa-plus mr-2"></i>Create Tenant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Auto-generate domain from organization name
        document.getElementById('name').addEventListener('input', function() {
            const name = this.value;
            const domainInput = document.getElementById('domain');

            if (domainInput.value === '' || domainInput.dataset.autogenerated === 'true') {
                const domain = name.toLowerCase()
                    .replace(/[^a-z0-9\s]/g, '')
                    .replace(/\s+/g, '-')
                    .substring(0, 30);

                domainInput.value = domain;
                domainInput.dataset.autogenerated = 'true';
            }
        });

        // Clear auto-generated flag when user manually edits domain
        document.getElementById('domain').addEventListener('input', function() {
            this.dataset.autogenerated = 'false';
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const domain = document.getElementById('domain').value;

            if (domain.length < 3) {
                e.preventDefault();
                alert('Domain must be at least 3 characters long.');
                return false;
            }

            if (!/^[a-z0-9-]+$/.test(domain)) {
                e.preventDefault();
                alert('Domain can only contain lowercase letters, numbers, and hyphens.');
                return false;
            }
        });

        // Dynamic plan description
        document.getElementById('plan').addEventListener('change', function() {
            const plan = this.value;
            let description = '';

            switch (plan) {
                case 'basic':
                    description = 'Up to 100 students, 10 teachers, basic features';
                    break;
                case 'premium':
                    description = 'Up to 500 students, 50 teachers, advanced features';
                    break;
                case 'enterprise':
                    description = 'Unlimited users, all features, priority support';
                    break;
            }

            // Show description if we have one
            if (description) {
                let helpText = document.getElementById('plan-help');
                if (!helpText) {
                    helpText = document.createElement('p');
                    helpText.id = 'plan-help';
                    helpText.className = 'mt-1 text-xs text-gray-500';
                    this.parentNode.appendChild(helpText);
                }
                helpText.textContent = description;
            }
        });
    </script>
@endsection
