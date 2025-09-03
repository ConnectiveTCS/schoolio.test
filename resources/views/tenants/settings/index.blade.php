<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Settings') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="mx-auto max-w-4xl rounded-lg bg-white shadow-xs dark:bg-gray-800">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">School Settings</h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manage your school's basic information and
                    preferences.
                </p>
            </div>

            <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')

                <!-- Logo Section -->
                <div class="mb-8">
                    <h4 class="mb-4 text-base font-medium text-gray-900 dark:text-gray-100">School Logo</h4>
                    <div class="flex items-center space-x-6">
                        <div class="shrink-0">
                            <label for="logo" class="cursor-pointer">
                                @if ($tenant->logo)
                                    <img src="{{ route('tenant.file', $tenant->logo) }}" alt="{{ $tenant->name }} Logo"
                                        class="h-24 w-24 rounded-lg object-cover shadow-xs" id="logoPreview">
                                @else
                                    <img src="{{ asset('alsahwa.svg') }}" alt="{{ $tenant->name }} Logo"
                                        class="h-24 w-24 rounded-lg object-cover shadow-xs" id="logoPreview">
                                @endif
                            </label>
                        </div>
                        <div class="flex-1">
                            <input type="file" name="logo" id="logo" class="hidden"
                                onchange="document.getElementById('logoPreview').src = window.URL.createObjectURL(this.files[0])">
                            <label for="logo"
                                class="inline-flex cursor-pointer items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">
                                Choose New Logo
                            </label>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">PNG, JPG up to 2MB. Recommended:
                                200x200px</p>
                        </div>
                    </div>
                </div>

                <!-- Basic Information Section -->
                <div class="mb-8">
                    <h4 class="mb-4 text-base font-medium text-gray-900 dark:text-gray-100">Basic Information</h4>
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <div class="lg:col-span-2">
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">School
                                Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $tenant->name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 sm:text-sm">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="lg:col-span-2">
                            <label for="address"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                            <input type="text" name="address" id="address"
                                value="{{ old('address', $tenant->address) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 sm:text-sm">
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="website"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Website</label>
                            <input type="url" name="website" id="website"
                                value="{{ old('website', $tenant->website) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 sm:text-sm">
                            @error('website')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="mb-8">
                    <h4 class="mb-4 text-base font-medium text-gray-900 dark:text-gray-100">Contact Information</h4>
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <div>
                            <label for="email"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', $tenant->email) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 sm:text-sm">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                            <input type="text" name="phone" id="phone"
                                value="{{ old('phone', $tenant->phone) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 sm:text-sm">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="alt_phone"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alternate
                                Phone</label>
                            <input type="text" name="alt_phone" id="alt_phone"
                                value="{{ old('alt_phone', $tenant->alt_phone) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 sm:text-sm">
                            @error('alt_phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Preferences Section -->
                <div class="mb-8">
                    <h4 class="mb-4 text-base font-medium text-gray-900 dark:text-gray-100">Preferences</h4>
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <div>
                            <label for="language"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Language</label>
                            <select name="language" id="language"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 sm:text-sm">
                                <option value="">Select Language</option>
                                <option value="en"
                                    {{ old('language', $tenant->language) == 'en' ? 'selected' : '' }}>
                                    English</option>
                                <option value="es"
                                    {{ old('language', $tenant->language) == 'es' ? 'selected' : '' }}>
                                    Spanish</option>
                                <option value="fr"
                                    {{ old('language', $tenant->language) == 'fr' ? 'selected' : '' }}>
                                    French</option>
                                <option value="de"
                                    {{ old('language', $tenant->language) == 'de' ? 'selected' : '' }}>
                                    German</option>
                                <option value="it"
                                    {{ old('language', $tenant->language) == 'it' ? 'selected' : '' }}>
                                    Italian</option>
                                <option value="pt"
                                    {{ old('language', $tenant->language) == 'pt' ? 'selected' : '' }}>
                                    Portuguese</option>
                                <option value="zh"
                                    {{ old('language', $tenant->language) == 'zh' ? 'selected' : '' }}>
                                    Chinese</option>
                                <option value="ja"
                                    {{ old('language', $tenant->language) == 'ja' ? 'selected' : '' }}>
                                    Japanese</option>
                                <option value="ar"
                                    {{ old('language', $tenant->language) == 'ar' ? 'selected' : '' }}>
                                    Arabic</option>
                                <option value="ru"
                                    {{ old('language', $tenant->language) == 'ru' ? 'selected' : '' }}>
                                    Russian</option>
                                <option value="hi"
                                    {{ old('language', $tenant->language) == 'hi' ? 'selected' : '' }}>
                                    Hindi
                                </option>
                                <option value="bn"
                                    {{ old('language', $tenant->language) == 'bn' ? 'selected' : '' }}>
                                    Bengali</option>
                                <option value="pa"
                                    {{ old('language', $tenant->language) == 'pa' ? 'selected' : '' }}>
                                    Punjabi</option>
                                <option value="jv"
                                    {{ old('language', $tenant->language) == 'jv' ? 'selected' : '' }}>
                                    Javanese</option>
                                <option value="ko"
                                    {{ old('language', $tenant->language) == 'ko' ? 'selected' : '' }}>
                                    Korean</option>
                                <option value="vi"
                                    {{ old('language', $tenant->language) == 'vi' ? 'selected' : '' }}>
                                    Vietnamese</option>
                                <option value="tr"
                                    {{ old('language', $tenant->language) == 'tr' ? 'selected' : '' }}>
                                    Turkish</option>
                                <option value="fa"
                                    {{ old('language', $tenant->language) == 'fa' ? 'selected' : '' }}>
                                    Persian</option>
                                <option value="ur"
                                    {{ old('language', $tenant->language) == 'ur' ? 'selected' : '' }}>Urdu
                                </option>
                            </select>
                            @error('language')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="timezone"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Timezone</label>
                            <select name="timezone" id="timezone"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 sm:text-sm">
                                <option value="">Select Timezone</option>
                                @foreach (timezone_identifiers_list() as $tz)
                                    <option value="{{ $tz }}"
                                        {{ old('timezone', $tenant->timezone) == $tz ? 'selected' : '' }}>
                                        {{ $tz }}
                                    </option>
                                @endforeach
                            </select>
                            @error('timezone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end border-t border-gray-200 pt-6 dark:border-gray-700">
                    <x-primary-button>Save Changes</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-tenant-dash-component>
