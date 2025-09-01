@extends('central.layout')

@section('title', 'Edit Tenant - ' . $tenant->name)

@section('content')
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="py-6">
            <div class="mb-8">
                <div class="flex items-center">
                    <a href="{{ route('central.tenants.show', $tenant) }}" class="mr-4 text-blue-600 hover:text-blue-900">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900">Edit {{ $tenant->name }}</h1>
                </div>
                <p class="mt-1 text-sm text-gray-600">
                    Update tenant organization information and settings.
                </p>
            </div>

            <div class="rounded-lg bg-white shadow">
                <form method="POST" action="{{ route('central.tenants.update', $tenant) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="border-b border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>
                    </div>

                    <div class="space-y-6 px-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Organization
                                    Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $tenant->name) }}"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Contact Email</label>
                                <input type="email" name="email" id="email"
                                    value="{{ old('email', $tenant->email) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="text" name="phone" id="phone"
                                    value="{{ old('phone', $tenant->phone) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="alt_phone" class="block text-sm font-medium text-gray-700">Alternative
                                    Phone</label>
                                <input type="text" name="alt_phone" id="alt_phone"
                                    value="{{ old('alt_phone', $tenant->alt_phone) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @error('alt_phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="website" class="block text-sm font-medium text-gray-700">Website URL</label>
                            <input type="url" name="website" id="website"
                                value="{{ old('website', $tenant->website) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                placeholder="https://example.com">
                            @error('website')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <textarea name="address" id="address" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('address', $tenant->address) }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="border-t border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-medium text-gray-900">Configuration</h3>
                    </div>

                    <div class="space-y-6 px-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="status" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    <option value="active"
                                        {{ old('status', $tenant->status) === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="suspended"
                                        {{ old('status', $tenant->status) === 'suspended' ? 'selected' : '' }}>Suspended
                                    </option>
                                    <option value="inactive"
                                        {{ old('status', $tenant->status) === 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="plan" class="block text-sm font-medium text-gray-700">Subscription
                                    Plan</label>
                                <select name="plan" id="plan" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    <option value="basic" {{ old('plan', $tenant->plan) === 'basic' ? 'selected' : '' }}>
                                        Basic</option>
                                    <option value="premium"
                                        {{ old('plan', $tenant->plan) === 'premium' ? 'selected' : '' }}>Premium</option>
                                    <option value="enterprise"
                                        {{ old('plan', $tenant->plan) === 'enterprise' ? 'selected' : '' }}>Enterprise
                                    </option>
                                </select>
                                @error('plan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="school_type" class="block text-sm font-medium text-gray-700">School Type</label>
                                <select name="school_type" id="school_type" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
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
                                    <option value="en"
                                        {{ old('language', $tenant->language) === 'en' ? 'selected' : '' }}>English
                                    </option>
                                    <option value="es"
                                        {{ old('language', $tenant->language) === 'es' ? 'selected' : '' }}>Spanish
                                    </option>
                                    <option value="fr"
                                        {{ old('language', $tenant->language) === 'fr' ? 'selected' : '' }}>French</option>
                                    <option value="ar"
                                        {{ old('language', $tenant->language) === 'ar' ? 'selected' : '' }}>Arabic</option>
                                </select>
                                @error('language')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="timezone" class="block text-sm font-medium text-gray-700">Timezone</label>
                                <select name="timezone" id="timezone" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    <option value="UTC"
                                        {{ old('timezone', $tenant->timezone) === 'UTC' ? 'selected' : '' }}>UTC</option>
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
                                        {{ old('timezone', $tenant->timezone) === 'Europe/Paris' ? 'selected' : '' }}>Paris
                                    </option>
                                </select>
                                @error('timezone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="trial_ends_at" class="block text-sm font-medium text-gray-700">Trial End
                                    Date</label>
                                <input type="date" name="trial_ends_at" id="trial_ends_at"
                                    value="{{ old('trial_ends_at', $tenant->trial_ends_at ? $tenant->trial_ends_at->format('Y-m-d') : '') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @error('trial_ends_at')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment
                                    Method</label>
                                <select name="payment_method" id="payment_method"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
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
                                @error('payment_method')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-medium text-gray-900">Domains</h3>
                    </div>

                    <div class="space-y-6 px-6">
                        @if ($tenant->domains->isNotEmpty())
                            <div class="rounded-md bg-blue-50 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-info-circle text-blue-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-blue-800">Current Domains</h3>
                                        <div class="mt-2">
                                            <ul class="list-disc pl-5 text-sm text-blue-700">
                                                @foreach ($tenant->domains as $domain)
                                                    <li>{{ $domain->domain }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-end space-x-3 bg-gray-50 px-6 py-4">
                        <a href="{{ route('central.tenants.show', $tenant) }}"
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700">
                            <i class="fas fa-save mr-2"></i>Update Tenant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
