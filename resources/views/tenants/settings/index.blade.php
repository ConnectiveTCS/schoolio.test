<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div
                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
                    <i
                        class="fas fa-cog text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                </div>
                <h2
                    class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                    {{ __('Settings') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div
        class="min-h-screen bg-[color:var(--color-light-dark-green)] p-6 transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div
            class="mx-auto max-w-4xl rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-xl transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
            <div
                class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                <div class="flex items-center space-x-3">
                    <div
                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                        <i
                            class="fas fa-school text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                    </div>
                    <div>
                        <h3
                            class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            School Settings</h3>
                        <p
                            class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            Manage your school's basic information and
                            preferences.
                        </p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data"
                class="bg-[color:var(--color-light-castleton-green)] p-6 transition-colors duration-200 dark:bg-[color:var(--color-castleton-green)]">
                @csrf
                @method('PUT')

                <!-- Logo Section -->
                <div
                    class="mb-8 rounded-lg border border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-dark-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <div class="mb-4 flex items-center space-x-3">
                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
                            <i
                                class="fas fa-image text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                        </div>
                        <h4
                            class="text-base font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            School Logo</h4>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="shrink-0">
                            <label for="logo" class="group cursor-pointer">
                                <div class="relative">
                                    @if ($tenant->logo)
                                        <img src="{{ route('tenant.file', $tenant->logo) }}"
                                            alt="{{ $tenant->name }} Logo"
                                            class="h-24 w-24 rounded-lg border-2 border-gray-300 dark:border-gray-600 object-cover shadow-lg transition-all duration-200 group-hover:scale-105 group-hover:shadow-xl"
                                            id="logoPreview"
                                            onerror="this.src='{{ asset('alsahwa.svg') }}'; this.onerror=null;">
                                    @else
                                        <img src="{{ asset('alsahwa.svg') }}" alt="{{ $tenant->name }} Logo"
                                            class="h-24 w-24 rounded-lg border-2 border-gray-300 dark:border-gray-600 object-cover shadow-lg transition-all duration-200 group-hover:scale-105 group-hover:shadow-xl"
                                            id="logoPreview">
                                    @endif
                                    <div
                                        class="absolute inset-0 flex items-center justify-center rounded-lg bg-black bg-opacity-0 transition-all duration-200 group-hover:bg-opacity-30">
                                        <i
                                            class="fas fa-camera text-white opacity-0 transition-opacity duration-200 group-hover:opacity-100"></i>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="flex-1">
                            <input type="file" name="logo" id="logo" class="hidden"
                                onchange="document.getElementById('logoPreview').src = window.URL.createObjectURL(this.files[0])">
                            <label for="logo"
                                class="inline-flex transform cursor-pointer items-center space-x-2 rounded-md border border-transparent bg-[color:var(--color-dark-green)] px-4 py-2 text-xs font-semibold uppercase tracking-widest text-[color:var(--color-light-dark-green)] transition-all duration-200 hover:scale-105 hover:bg-[color:var(--color-brunswick-green)] hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-[color:var(--color-gunmetal)] focus:ring-offset-2 dark:bg-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                                <i class="fas fa-upload"></i>
                                <span>Choose New Logo</span>
                            </label>
                            <p
                                class="mt-2 flex items-center space-x-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i class="fas fa-info-circle"></i>
                                <span>PNG, JPG up to 2MB. Recommended: 200x200px</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Basic Information Section -->
                <div
                    class="mb-8 rounded-lg border border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-dark-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <div class="mb-4 flex items-center space-x-3">
                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
                            <i
                                class="fas fa-info-circle text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                        </div>
                        <h4
                            class="text-base font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            Basic Information</h4>
                    </div>
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <div class="lg:col-span-2">
                            <label for="name"
                                class="block flex items-center space-x-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                <i class="fas fa-school text-xs"></i>
                                <span>School Name</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $tenant->name) }}"
                                class="mt-1 block w-full rounded-md border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] shadow-sm transition-all duration-200 hover:shadow-md focus:border-[color:var(--color-brunswick-green)] focus:ring-[color:var(--color-brunswick-green)] sm:text-sm dark:border-[color:var(--color-dark-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]">
                            @error('name')
                                <p class="mt-1 flex items-center space-x-1 text-sm text-red-600">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>

                        <div class="lg:col-span-2">
                            <label for="address"
                                class="block flex items-center space-x-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                <i class="fas fa-map-marker-alt text-xs"></i>
                                <span>Address</span>
                            </label>
                            <input type="text" name="address" id="address"
                                value="{{ old('address', $tenant->address) }}"
                                class="mt-1 block w-full rounded-md border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] shadow-sm transition-all duration-200 hover:shadow-md focus:border-[color:var(--color-brunswick-green)] focus:ring-[color:var(--color-brunswick-green)] sm:text-sm dark:border-[color:var(--color-dark-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]">
                            @error('address')
                                <p class="mt-1 flex items-center space-x-1 text-sm text-red-600">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="website"
                                class="block flex items-center space-x-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                <i class="fas fa-globe text-xs"></i>
                                <span>Website</span>
                            </label>
                            <input type="url" name="website" id="website"
                                value="{{ old('website', $tenant->website) }}"
                                class="mt-1 block w-full rounded-md border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] shadow-sm transition-all duration-200 hover:shadow-md focus:border-[color:var(--color-brunswick-green)] focus:ring-[color:var(--color-brunswick-green)] sm:text-sm dark:border-[color:var(--color-dark-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]">
                            @error('website')
                                <p class="mt-1 flex items-center space-x-1 text-sm text-red-600">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div
                    class="mb-8 rounded-lg border border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-dark-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <div class="mb-4 flex items-center space-x-3">
                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
                            <i
                                class="fas fa-phone text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                        </div>
                        <h4
                            class="text-base font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            Contact Information</h4>
                    </div>
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <div>
                            <label for="email"
                                class="block flex items-center space-x-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                <i class="fas fa-envelope text-xs"></i>
                                <span>Email</span>
                            </label>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', $tenant->email) }}"
                                class="mt-1 block w-full rounded-md border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] shadow-sm transition-all duration-200 hover:shadow-md focus:border-[color:var(--color-brunswick-green)] focus:ring-[color:var(--color-brunswick-green)] sm:text-sm dark:border-[color:var(--color-dark-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]">
                            @error('email')
                                <p class="mt-1 flex items-center space-x-1 text-sm text-red-600">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone"
                                class="block flex items-center space-x-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                <i class="fas fa-phone text-xs"></i>
                                <span>Phone</span>
                            </label>
                            <input type="text" name="phone" id="phone"
                                value="{{ old('phone', $tenant->phone) }}"
                                class="mt-1 block w-full rounded-md border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] shadow-sm transition-all duration-200 hover:shadow-md focus:border-[color:var(--color-brunswick-green)] focus:ring-[color:var(--color-brunswick-green)] sm:text-sm dark:border-[color:var(--color-dark-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]">
                            @error('phone')
                                <p class="mt-1 flex items-center space-x-1 text-sm text-red-600">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="alt_phone"
                                class="block flex items-center space-x-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                <i class="fas fa-phone-alt text-xs"></i>
                                <span>Alternate Phone</span>
                            </label>
                            <input type="text" name="alt_phone" id="alt_phone"
                                value="{{ old('alt_phone', $tenant->alt_phone) }}"
                                class="mt-1 block w-full rounded-md border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] shadow-sm transition-all duration-200 hover:shadow-md focus:border-[color:var(--color-brunswick-green)] focus:ring-[color:var(--color-brunswick-green)] sm:text-sm dark:border-[color:var(--color-dark-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]">
                            @error('alt_phone')
                                <p class="mt-1 flex items-center space-x-1 text-sm text-red-600">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Preferences Section -->
                <div
                    class="mb-8 rounded-lg border border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-brunswick-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-dark-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <div class="mb-4 flex items-center space-x-3">
                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
                            <i
                                class="fas fa-cogs text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                        </div>
                        <h4
                            class="text-base font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            Preferences</h4>
                    </div>
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <div>
                            <label for="language"
                                class="block flex items-center space-x-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                <i class="fas fa-language text-xs"></i>
                                <span>Language</span>
                            </label>
                            <select name="language" id="language"
                                class="mt-1 block w-full rounded-md border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] shadow-sm transition-all duration-200 hover:shadow-md focus:border-[color:var(--color-brunswick-green)] focus:ring-[color:var(--color-brunswick-green)] sm:text-sm dark:border-[color:var(--color-dark-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]">
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
                                <p class="mt-1 flex items-center space-x-1 text-sm text-red-600">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="timezone"
                                class="block flex items-center space-x-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                <i class="fas fa-clock text-xs"></i>
                                <span>Timezone</span>
                            </label>
                            <select name="timezone" id="timezone"
                                class="mt-1 block w-full rounded-md border-[color:var(--color-light-dark-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] shadow-sm transition-all duration-200 hover:shadow-md focus:border-[color:var(--color-brunswick-green)] focus:ring-[color:var(--color-brunswick-green)] sm:text-sm dark:border-[color:var(--color-dark-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]">
                                <option value="">Select Timezone</option>
                                @foreach (timezone_identifiers_list() as $tz)
                                    <option value="{{ $tz }}"
                                        {{ old('timezone', $tenant->timezone) == $tz ? 'selected' : '' }}>
                                        {{ $tz }}
                                    </option>
                                @endforeach
                            </select>
                            @error('timezone')
                                <p class="mt-1 flex items-center space-x-1 text-sm text-red-600">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>{{ $message }}</span>
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div
                    class="flex justify-end border-t border-[color:var(--color-light-brunswick-green)] pt-6 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                    <button type="submit"
                        class="inline-flex transform items-center space-x-2 rounded-md border border-transparent bg-[color:var(--color-dark-green)] px-6 py-3 text-sm font-semibold text-[color:var(--color-light-dark-green)] shadow-lg transition-all duration-200 hover:scale-105 hover:bg-[color:var(--color-brunswick-green)] hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-[color:var(--color-gunmetal)] focus:ring-offset-2 dark:bg-[color:var(--color-light-dark-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                        <i class="fas fa-save"></i>
                        <span>Save Changes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-tenant-dash-component>
