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
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Organization
                                    Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Contact Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="alt_phone" class="block text-sm font-medium text-gray-700">Alternative
                                    Phone</label>
                                <input type="text" name="alt_phone" id="alt_phone" value="{{ old('alt_phone') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @error('alt_phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="website" class="block text-sm font-medium text-gray-700">Website URL</label>
                            <input type="url" name="website" id="website" value="{{ old('website') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                placeholder="https://example.com">
                            @error('website')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <textarea name="address" id="address" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="border-t border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-medium text-gray-900">Configuration</h3>
                    </div>

                    <div class="space-y-6 px-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="plan" class="block text-sm font-medium text-gray-700">Subscription
                                    Plan</label>
                                <select name="plan" id="plan" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    <option value="">Select a plan...</option>
                                    <option value="basic" {{ old('plan') === 'basic' ? 'selected' : '' }}>Basic</option>
                                    <option value="premium" {{ old('plan') === 'premium' ? 'selected' : '' }}>Premium
                                    </option>
                                    <option value="enterprise" {{ old('plan') === 'enterprise' ? 'selected' : '' }}>
                                        Enterprise</option>
                                </select>
                                @error('plan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="school_type" class="block text-sm font-medium text-gray-700">School Type</label>
                                <select name="school_type" id="school_type" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    <option value="">Select school type...</option>
                                    <option value="primary" {{ old('school_type') === 'primary' ? 'selected' : '' }}>
                                        Primary School</option>
                                    <option value="secondary" {{ old('school_type') === 'secondary' ? 'selected' : '' }}>
                                        Secondary School</option>
                                    <option value="university" {{ old('school_type') === 'university' ? 'selected' : '' }}>
                                        University</option>
                                    <option value="vocational" {{ old('school_type') === 'vocational' ? 'selected' : '' }}>
                                        Vocational</option>
                                </select>
                                @error('school_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="language" class="block text-sm font-medium text-gray-700">Default
                                    Language</label>
                                <select name="language" id="language" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
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
                                @error('language')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="timezone" class="block text-sm font-medium text-gray-700">Timezone</label>
                                <select name="timezone" id="timezone" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    <option value="">Select timezone...</option>
                                    <option value="UTC" {{ old('timezone') === 'UTC' ? 'selected' : '' }}>UTC</option>
                                    <option value="America/New_York"
                                        {{ old('timezone') === 'America/New_York' ? 'selected' : '' }}>Eastern Time
                                    </option>
                                    <option value="America/Chicago"
                                        {{ old('timezone') === 'America/Chicago' ? 'selected' : '' }}>Central Time</option>
                                    <option value="America/Denver"
                                        {{ old('timezone') === 'America/Denver' ? 'selected' : '' }}>Mountain Time</option>
                                    <option value="America/Los_Angeles"
                                        {{ old('timezone') === 'America/Los_Angeles' ? 'selected' : '' }}>Pacific Time
                                    </option>
                                    <option value="Europe/London"
                                        {{ old('timezone') === 'Europe/London' ? 'selected' : '' }}>London</option>
                                    <option value="Europe/Paris"
                                        {{ old('timezone') === 'Europe/Paris' ? 'selected' : '' }}>Paris</option>
                                </select>
                                @error('timezone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="domain" class="block text-sm font-medium text-gray-700">Domain</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="text" name="domain" id="domain" value="{{ old('domain') }}"
                                    required
                                    class="block w-full flex-1 rounded-l-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    placeholder="tenant-name">
                                <span
                                    class="inline-flex items-center rounded-r-md border border-l-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">
                                    .schoolio.test
                                </span>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">This will be the subdomain for accessing the tenant.</p>
                            @error('domain')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 bg-gray-50 px-6 py-4">
                        <a href="{{ route('central.tenants.index') }}"
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700">
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
