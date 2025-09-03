@extends('central.layout')

@section('title', 'Edit Tenant - ' . $tenant->name)

@section('content')
    <div class="mx-auto min-h-screen max-w-4xl px-4 transition-colors duration-200 sm:px-6 lg:px-8">
        <div class="py-6">
            <div class="mb-8">
                <div class="flex items-center">
                    <a href="{{ route('central.tenants.show', $tenant) }}"
                        class="mr-4 text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1
                        class="text-2xl font-bold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        Edit {{ $tenant->name }}</h1>
                </div>
                <p
                    class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    Update tenant organization information and settings.
                </p>
            </div>

            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <form method="POST" action="{{ route('central.tenants.update', $tenant) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

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
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $tenant->name) }}" required
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
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email', $tenant->email) }}" required
                                        class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-gunmetal)] transition-all duration-200 hover:border-[color:var(--color-castleton-green)] focus:border-[color:var(--color-castleton-green)] focus:ring-4 focus:ring-[color:var(--color-castleton-green)] focus:ring-opacity-20 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-light-gunmetal)] dark:hover:border-[color:var(--color-light-castleton-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                                        placeholder="Enter contact email">
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
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Phone
                                    Number</label>
                                <div class="relative">
                                    <input type="text" name="phone" id="phone"
                                        value="{{ old('phone', $tenant->phone) }}"
                                        class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-light-brunswick-green)] transition-all duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-white focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-brunswick-green)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-dark-green)] dark:focus:ring-[color:var(--color-castleton-green)]"
                                        placeholder="Enter phone number">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-phone text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
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
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Alternative
                                    Phone</label>
                                <div class="relative">
                                    <input type="text" name="alt_phone" id="alt_phone"
                                        value="{{ old('alt_phone', $tenant->alt_phone) }}"
                                        class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-light-brunswick-green)] transition-all duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-white focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-brunswick-green)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-dark-green)] dark:focus:ring-[color:var(--color-castleton-green)]"
                                        placeholder="Enter alternative phone">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-phone-alt text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
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
                                class="block text-sm font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Website
                                URL</label>
                            <div class="relative">
                                <input type="url" name="website" id="website"
                                    value="{{ old('website', $tenant->website) }}"
                                    class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-light-brunswick-green)] transition-all duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-white focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-brunswick-green)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-dark-green)] dark:focus:ring-[color:var(--color-castleton-green)]"
                                    placeholder="https://example.com">
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i
                                        class="fas fa-globe text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
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
                                class="block text-sm font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Address</label>
                            <div class="relative">
                                <textarea name="address" id="address" rows="4"
                                    class="shadow-xs block w-full resize-y rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-light-brunswick-green)] transition-all duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-white focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-brunswick-green)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-dark-green)] dark:focus:ring-[color:var(--color-castleton-green)]"
                                    placeholder="Enter complete address">{{ old('address', $tenant->address) }}</textarea>
                                <div class="pointer-events-none absolute right-0 top-3 flex items-start pr-3">
                                    <i
                                        class="fas fa-map-marker-alt text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
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
                        class="border-t border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)]">
                        <h3
                            class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Configuration</h3>
                    </div>

                    <div class="space-y-6 px-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                            <div class="space-y-1">
                                <label for="status"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                    Status
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="status" id="status" required
                                        class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-light-brunswick-green)] transition-all duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-white focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-brunswick-green)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-dark-green)] dark:focus:ring-[color:var(--color-castleton-green)]">
                                        <option value="active"
                                            {{ old('status', $tenant->status) === 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="suspended"
                                            {{ old('status', $tenant->status) === 'suspended' ? 'selected' : '' }}>
                                            Suspended
                                        </option>
                                        <option value="inactive"
                                            {{ old('status', $tenant->status) === 'inactive' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-chevron-down text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
                                    </div>
                                </div>
                                @error('status')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="plan"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                    Subscription Plan
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="plan" id="plan" required
                                        class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-light-brunswick-green)] transition-all duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-white focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-brunswick-green)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-dark-green)] dark:focus:ring-[color:var(--color-castleton-green)]">
                                        <option value="basic"
                                            {{ old('plan', $tenant->plan) === 'basic' ? 'selected' : '' }}>
                                            Basic</option>
                                        <option value="premium"
                                            {{ old('plan', $tenant->plan) === 'premium' ? 'selected' : '' }}>Premium
                                        </option>
                                        <option value="enterprise"
                                            {{ old('plan', $tenant->plan) === 'enterprise' ? 'selected' : '' }}>Enterprise
                                        </option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-chevron-down text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
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
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                    School Type
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="school_type" id="school_type" required
                                        class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-light-brunswick-green)] transition-all duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-white focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-brunswick-green)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-dark-green)] dark:focus:ring-[color:var(--color-castleton-green)]">
                                        <option value="primary"
                                            {{ old('school_type', $tenant->school_type) === 'primary' ? 'selected' : '' }}>
                                            Primary School</option>
                                        <option value="secondary"
                                            {{ old('school_type', $tenant->school_type) === 'secondary' ? 'selected' : '' }}>
                                            Secondary School</option>
                                        <option value="university"
                                            {{ old('school_type', $tenant->school_type) === 'university' ? 'selected' : '' }}>
                                            University</option>
                                        <option value="vocational"
                                            {{ old('school_type', $tenant->school_type) === 'vocational' ? 'selected' : '' }}>
                                            Vocational</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-chevron-down text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
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
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                    Default Language
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="language" id="language" required
                                        class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-light-brunswick-green)] transition-all duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-white focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-brunswick-green)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-dark-green)] dark:focus:ring-[color:var(--color-castleton-green)]">
                                        <option value="en"
                                            {{ old('language', $tenant->language) === 'en' ? 'selected' : '' }}>English
                                        </option>
                                        <option value="es"
                                            {{ old('language', $tenant->language) === 'es' ? 'selected' : '' }}>Spanish
                                        </option>
                                        <option value="fr"
                                            {{ old('language', $tenant->language) === 'fr' ? 'selected' : '' }}>French
                                        </option>
                                        <option value="ar"
                                            {{ old('language', $tenant->language) === 'ar' ? 'selected' : '' }}>Arabic
                                        </option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-chevron-down text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
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
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                    Timezone
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="timezone" id="timezone" required
                                        class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-light-brunswick-green)] transition-all duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-white focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-brunswick-green)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-dark-green)] dark:focus:ring-[color:var(--color-castleton-green)]">
                                        <option value="UTC"
                                            {{ old('timezone', $tenant->timezone) === 'UTC' ? 'selected' : '' }}>UTC
                                        </option>
                                        <option value="America/New_York"
                                            {{ old('timezone', $tenant->timezone) === 'America/New_York' ? 'selected' : '' }}>
                                            Eastern Time</option>
                                        <option value="America/Chicago"
                                            {{ old('timezone', $tenant->timezone) === 'America/Chicago' ? 'selected' : '' }}>
                                            Central Time</option>
                                        <option value="America/Denver"
                                            {{ old('timezone', $tenant->timezone) === 'America/Denver' ? 'selected' : '' }}>
                                            Mountain Time</option>
                                        <option value="America/Los_Angeles"
                                            {{ old('timezone', $tenant->timezone) === 'America/Los_Angeles' ? 'selected' : '' }}>
                                            Pacific Time</option>
                                        <option value="Europe/London"
                                            {{ old('timezone', $tenant->timezone) === 'Europe/London' ? 'selected' : '' }}>
                                            London</option>
                                        <option value="Europe/Paris"
                                            {{ old('timezone', $tenant->timezone) === 'Europe/Paris' ? 'selected' : '' }}>
                                            Paris
                                        </option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-chevron-down text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
                                    </div>
                                </div>
                                @error('timezone')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="space-y-1">
                                <label for="trial_ends_at"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Trial
                                    End
                                    Date</label>
                                <div class="relative">
                                    <input type="date" name="trial_ends_at" id="trial_ends_at"
                                        value="{{ old('trial_ends_at', $tenant->trial_ends_at ? $tenant->trial_ends_at->format('Y-m-d') : '') }}"
                                        class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-light-brunswick-green)] transition-all duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-white focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-brunswick-green)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-dark-green)] dark:focus:ring-[color:var(--color-castleton-green)]">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-calendar-alt text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
                                    </div>
                                </div>
                                @error('trial_ends_at')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="payment_method"
                                    class="block text-sm font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Payment
                                    Method</label>
                                <div class="relative">
                                    <select name="payment_method" id="payment_method"
                                        class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-light-brunswick-green)] transition-all duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-white focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-brunswick-green)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-dark-green)] dark:focus:ring-[color:var(--color-castleton-green)]">
                                        <option value="">Select payment method...</option>
                                        <option value="stripe"
                                            {{ old('payment_method', $tenant->payment_method) === 'stripe' ? 'selected' : '' }}>
                                            Stripe</option>
                                        <option value="paypal"
                                            {{ old('payment_method', $tenant->payment_method) === 'paypal' ? 'selected' : '' }}>
                                            PayPal</option>
                                        <option value="bank_transfer"
                                            {{ old('payment_method', $tenant->payment_method) === 'bank_transfer' ? 'selected' : '' }}>
                                            Bank Transfer</option>
                                        <option value="cash"
                                            {{ old('payment_method', $tenant->payment_method) === 'cash' ? 'selected' : '' }}>
                                            Cash</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i
                                            class="fas fa-chevron-down text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
                                    </div>
                                </div>
                                @error('payment_method')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div
                        class="border-t border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)]">
                        <h3
                            class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Domains</h3>
                    </div>

                    <div class="space-y-6 px-6">
                        @if ($tenant->domains->isNotEmpty())
                            <div
                                class="rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                                <div class="flex">
                                    <div class="shrink-0">
                                        <i
                                            class="fas fa-info-circle text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h3
                                            class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                            Current Domains</h3>
                                        <div class="mt-2">
                                            <ul class="space-y-2">
                                                @foreach ($tenant->domains as $domain)
                                                    <li
                                                        class="flex items-center justify-between gap-4 rounded-sm border border-[color:var(--color-light-brunswick-green)] bg-white px-3 py-2 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-dark-green)]">
                                                        <div class="flex items-center">
                                                            <span
                                                                class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">{{ $domain->domain }}</span>
                                                            <a href="http://{{ $domain->domain }}" target="_blank"
                                                                class="ml-2 text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                                                <i class="fas fa-external-link-alt text-xs"></i>
                                                            </a>
                                                        </div>
                                                        <button type="button"
                                                            onclick="deleteDomain('{{ $domain->id }}', '{{ $domain->domain }}')"
                                                            class="cursor-pointer text-red-600 transition-colors duration-200 hover:text-red-900">
                                                            <i class="fas fa-trash text-sm"></i>
                                                        </button>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div
                                class="rounded-md border border-yellow-200 bg-yellow-50 p-4 transition-colors duration-200 dark:border-yellow-700 dark:bg-yellow-900/20">
                                <div class="flex">
                                    <div class="shrink-0">
                                        <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-300">No Domains
                                            Configured</h3>
                                        <p class="mt-1 text-sm text-yellow-700 dark:text-yellow-400">This tenant has no
                                            domains. Add a domain
                                            below to enable access.</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Add New Domain Section -->
                        <div
                            class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-white p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-dark-green)]">
                            <h4
                                class="mb-4 text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                Add New Domain</h4>

                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Domain
                                        Type</label>
                                    <div class="mt-2 space-y-2">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="domain_type" value="subdomain" checked
                                                class="form-radio text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"
                                                onchange="toggleDomainType()">
                                            <span
                                                class="ml-2 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Subdomain
                                                (yourname.schoolio.test)</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="domain_type" value="custom"
                                                class="form-radio text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"
                                                onchange="toggleDomainType()">
                                            <span
                                                class="ml-2 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Custom
                                                Domain (yourdomain.com)</span>
                                        </label>
                                    </div>
                                </div>

                                <div id="subdomain-section">
                                    <label for="subdomain"
                                        class="block text-sm font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Subdomain</label>
                                    <div class="shadow-xs mt-1 flex rounded-lg">
                                        <input type="text" name="subdomain" id="subdomain"
                                            class="block w-full min-w-0 flex-1 rounded-none rounded-l-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-light-brunswick-green)] transition-all duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-white focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-brunswick-green)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-dark-green)] dark:focus:ring-[color:var(--color-castleton-green)]"
                                            placeholder="yourname">
                                        <span
                                            class="inline-flex items-center rounded-r-lg border border-l-0 border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 text-sm font-medium text-[color:var(--color-dark-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)]">
                                            .schoolio.test
                                        </span>
                                    </div>
                                    <p
                                        class="mt-1 text-xs text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]">
                                        Choose a unique subdomain for this tenant</p>
                                </div>

                                <!-- Custom Domain Input -->
                                <div id="custom-domain-section" style="display: none;" class="space-y-1">
                                    <label for="custom_domain"
                                        class="block text-sm font-semibold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">Custom
                                        Domain</label>
                                    <div class="relative">
                                        <input type="text" name="custom_domain" id="custom_domain"
                                            class="shadow-xs block w-full rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-4 py-3 text-sm text-[color:var(--color-dark-green)] placeholder-[color:var(--color-light-brunswick-green)] transition-all duration-200 hover:border-[color:var(--color-brunswick-green)] focus:border-[color:var(--color-castleton-green)] focus:bg-white focus:ring-4 focus:ring-[color:var(--color-light-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:placeholder-[color:var(--color-brunswick-green)] dark:hover:border-[color:var(--color-light-brunswick-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:bg-[color:var(--color-dark-green)] dark:focus:ring-[color:var(--color-castleton-green)]"
                                            placeholder="yourdomain.com">
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                            <i
                                                class="fas fa-globe text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
                                        </div>
                                    </div>
                                    <p
                                        class="mt-1 text-xs text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]">
                                        Enter your custom domain without http:// or
                                        https://</p>
                                </div>

                                <!-- DNS Instructions for Custom Domain -->
                                <div id="dns-instructions" style="display: none;"
                                    class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                                    <h5
                                        class="mb-2 text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        DNS Configuration Required</h5>
                                    <p
                                        class="mb-3 text-sm text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]">
                                        To use a custom domain, you need to configure
                                        your DNS settings:</p>

                                    <div class="space-y-2 text-sm">
                                        <div
                                            class="rounded-sm border border-[color:var(--color-light-brunswick-green)] bg-white p-3 font-mono transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-dark-green)]">
                                            <strong>CNAME Record:</strong><br>
                                            <span class="text-blue-600">yourdomain.com</span> → <span
                                                class="text-green-600">schoolio.test</span>
                                        </div>
                                        <div class="rounded-sm border bg-white p-3 font-mono">
                                            <strong>A Record (alternative):</strong><br>
                                            <span class="text-blue-600">yourdom.com</span> → <span
                                                class="text-green-600">{{ request()->server('SERVER_ADDR') ?? '127.0.0.1' }}</span>
                                        </div>
                                    </div>

                                    <div class="mt-3 text-sm text-gray-600">
                                        <strong>Steps:</strong>
                                        <ol class="mt-1 list-inside list-decimal space-y-1">
                                            <li>Log in to your domain registrar's control panel</li>
                                            <li>Navigate to DNS settings</li>
                                            <li>Add the CNAME record as shown above</li>
                                            <li>Wait for DNS propagation (up to 24 hours)</li>
                                            <li>Test your domain to ensure it works</li>
                                        </ol>
                                    </div>
                                </div>

                                <button type="button" onclick="addDomain()"
                                    class="bg-linear-to-r focus:outline-hidden inline-flex transform items-center rounded-lg border border-transparent from-green-500 to-green-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-200 hover:scale-105 hover:from-green-600 hover:to-green-700 focus:ring-4 focus:ring-green-200">
                                    <i class="fas fa-plus mr-2"></i>Add Domain
                                </button>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex justify-end space-x-4 rounded-b-lg bg-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                        <a href="{{ route('central.tenants.show', $tenant) }}"
                            class="shadow-xs focus:outline-hidden inline-flex items-center rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] px-6 py-3 text-sm font-semibold text-[color:var(--color-dark-green)] transition-all duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:ring-4 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-brunswick-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            <i class="fas fa-arrow-left mr-2"></i>Cancel
                        </a>
                        <button type="submit"
                            class="focus:outline-hidden inline-flex transform items-center rounded-lg border border-transparent bg-[color:var(--color-castleton-green)] px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-200 hover:scale-105 hover:bg-[color:var(--color-brunswick-green)] focus:ring-4 focus:ring-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            <i class="fas fa-save mr-2"></i>Update Tenant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleDomainType() {
            const domainType = document.querySelector('input[name="domain_type"]:checked').value;
            const subdomainSection = document.getElementById('subdomain-section');
            const customDomainSection = document.getElementById('custom-domain-section');
            const dnsInstructions = document.getElementById('dns-instructions');

            if (domainType === 'subdomain') {
                subdomainSection.style.display = 'block';
                customDomainSection.style.display = 'none';
                dnsInstructions.style.display = 'none';
            } else {
                subdomainSection.style.display = 'none';
                customDomainSection.style.display = 'block';
                dnsInstructions.style.display = 'block';
            }
        }

        async function addDomain() {
            const domainType = document.querySelector('input[name="domain_type"]:checked').value;
            let domain = '';

            if (domainType === 'subdomain') {
                const subdomain = document.getElementById('subdomain').value.trim();
                if (!subdomain) {
                    alert('Please enter a subdomain');
                    return;
                }

                // Validate subdomain format
                if (!/^[a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*$/.test(subdomain)) {
                    alert(
                        'Subdomain can only contain letters, numbers, and hyphens, and cannot start or end with a hyphen'
                    );
                    return;
                }

                domain = subdomain + '.schoolio.test';
            } else {
                domain = document.getElementById('custom_domain').value.trim();
                if (!domain) {
                    alert('Please enter a custom domain');
                    return;
                }

                // Remove protocol if provided
                domain = domain.replace(/^https?:\/\//, '').replace(/\/$/, '');

                // Basic domain validation - allow all TLDs
                if (!/^[a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.[a-zA-Z0-9][a-zA-Z0-9.-]*[a-zA-Z0-9]$/.test(domain)) {
                    alert('Please enter a valid domain name (e.g., example.com)');
                    return;
                }
            }

            // Show loading state
            const button = event.target;
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Adding...';
            button.disabled = true;

            try {
                const response = await fetch(`{{ route('central.tenants.domains.store', $tenant) }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        domain: domain
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    // Clear form fields
                    document.getElementById('subdomain').value = '';
                    document.getElementById('custom_domain').value = '';

                    // Show success message
                    alert('Domain added successfully! Refreshing page...');
                    location.reload();
                } else {
                    alert(result.message || 'Error adding domain');
                }
            } catch (error) {
                alert('Error adding domain: ' + error.message);
            } finally {
                // Restore button state
                button.innerHTML = originalText;
                button.disabled = false;
            }
        }

        async function deleteDomain(domainId, domainName) {
            if (!confirm(
                    `Are you sure you want to delete the domain "${domainName}"?\n\nThis action cannot be undone and may affect tenant access.`
                )) {
                return;
            }

            try {
                const response = await fetch(
                    `{{ route('central.tenants.domains.destroy', [$tenant, '__DOMAIN_ID__']) }}`.replace(
                        '__DOMAIN_ID__', domainId), {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    });

                const result = await response.json();

                if (response.ok) {
                    alert('Domain deleted successfully! Refreshing page...');
                    location.reload();
                } else {
                    alert(result.message || 'Error deleting domain');
                }
            } catch (error) {
                alert('Error deleting domain: ' + error.message);
            }
        }
    </script>
@endsection
