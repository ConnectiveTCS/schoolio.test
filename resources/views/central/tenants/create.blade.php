@extends('central.layout')

@section('title', 'Create New Tenant')

@section('content')
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="py-6">
            <div class="mb-8">
                <div class="flex items-center">
                    <a href="{{ route('central.tenants.index') }}" class="mr-4 text-blue-600 hover:text-blue-900">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900">Create New Tenant</h1>
                </div>
                <p class="mt-1 text-sm text-gray-600">
                    Create a new tenant organization with its own database and domain.
                </p>
            </div>

            <div class="rounded-lg bg-white shadow">
                <form method="POST" action="{{ route('central.tenants.store') }}" class="space-y-6">
                    @csrf

                    <div class="border-b border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>
                    </div>

                    <div class="space-y-6 px-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="space-y-1">
                                <label for="name" class="block text-sm font-semibold text-gray-800">
                                    Organization Name
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm placeholder-gray-400 shadow-sm transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                        placeholder="Enter organization name">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i class="fas fa-building text-gray-400"></i>
                                    </div>
                                </div>
                                @error('name')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="email" class="block text-sm font-semibold text-gray-800">
                                    Contact Email
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm placeholder-gray-400 shadow-sm transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                        placeholder="contact@organization.com">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i class="fas fa-envelope text-gray-400"></i>
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
                                <label for="phone" class="block text-sm font-semibold text-gray-800">Phone Number</label>
                                <div class="relative">
                                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm placeholder-gray-400 shadow-sm transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                        placeholder="+1 (555) 123-4567">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i class="fas fa-phone text-gray-400"></i>
                                    </div>
                                </div>
                                @error('phone')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="alt_phone" class="block text-sm font-semibold text-gray-800">Alternative
                                    Phone</label>
                                <div class="relative">
                                    <input type="text" name="alt_phone" id="alt_phone" value="{{ old('alt_phone') }}"
                                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm placeholder-gray-400 shadow-sm transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                        placeholder="+1 (555) 987-6543">
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i class="fas fa-phone text-gray-400"></i>
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
                            <label for="website" class="block text-sm font-semibold text-gray-800">Website URL</label>
                            <div class="relative">
                                <input type="url" name="website" id="website" value="{{ old('website') }}"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm placeholder-gray-400 shadow-sm transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                    placeholder="https://example.com">
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i class="fas fa-globe text-gray-400"></i>
                                </div>
                            </div>
                            @error('website')
                                <p class="mt-1 flex items-center text-xs text-red-600">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="address" class="block text-sm font-semibold text-gray-800">Address</label>
                            <div class="relative">
                                <textarea name="address" id="address" rows="4"
                                    class="block w-full resize-y rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm placeholder-gray-400 shadow-sm transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                    placeholder="Enter complete address">{{ old('address') }}</textarea>
                                <div class="pointer-events-none absolute right-0 top-3 flex items-start pr-3">
                                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                                </div>
                            </div>
                            @error('address')
                                <p class="mt-1 flex items-center text-xs text-red-600">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="border-t border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-medium text-gray-900">Configuration</h3>
                    </div>

                    <div class="space-y-6 px-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="space-y-1">
                                <label for="plan" class="block text-sm font-semibold text-gray-800">
                                    Subscription Plan
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="plan" id="plan" required
                                        class="block w-full cursor-pointer appearance-none rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm shadow-sm transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">
                                        <option value="">Select a plan...</option>
                                        <option value="basic" {{ old('plan') === 'basic' ? 'selected' : '' }}>Basic
                                        </option>
                                        <option value="premium" {{ old('plan') === 'premium' ? 'selected' : '' }}>Premium
                                        </option>
                                        <option value="enterprise" {{ old('plan') === 'enterprise' ? 'selected' : '' }}>
                                            Enterprise</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                                @error('plan')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="school_type" class="block text-sm font-semibold text-gray-800">
                                    School Type
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="school_type" id="school_type" required
                                        class="block w-full cursor-pointer appearance-none rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm shadow-sm transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">
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
                                        <i class="fas fa-chevron-down text-gray-400"></i>
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
                                <label for="language" class="block text-sm font-semibold text-gray-800">
                                    Default Language
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="language" id="language" required
                                        class="block w-full cursor-pointer appearance-none rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm shadow-sm transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">
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
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                                @error('language')
                                    <p class="mt-1 flex items-center text-xs text-red-600">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="timezone" class="block text-sm font-semibold text-gray-800">
                                    Timezone
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="timezone" id="timezone" required
                                        class="block w-full cursor-pointer appearance-none rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm shadow-sm transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100">
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
                                        <i class="fas fa-chevron-down text-gray-400"></i>
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
                            <div class="mt-1 flex rounded-lg shadow-sm">
                                <input type="text" name="domain" id="domain" value="{{ old('domain') }}"
                                    required
                                    class="block w-full min-w-0 flex-1 rounded-none rounded-l-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm placeholder-gray-400 transition-all duration-200 hover:border-gray-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                    placeholder="tenant-name">
                                <span
                                    class="inline-flex items-center rounded-r-lg border border-l-0 border-gray-300 bg-gray-100 px-4 text-sm font-medium text-gray-600">
                                    .schoolio.test
                                </span>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">This will be the subdomain for accessing the tenant.</p>
                            @error('domain')
                                <p class="mt-1 flex items-center text-xs text-red-600">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 rounded-b-lg bg-gray-50 px-6 py-4">
                        <a href="{{ route('central.tenants.index') }}"
                            class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-6 py-3 text-sm font-semibold text-gray-700 shadow-sm transition-all duration-200 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex transform items-center rounded-lg border border-transparent bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all duration-200 hover:scale-105 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200">
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
