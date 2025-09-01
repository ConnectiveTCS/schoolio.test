<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Students') }}
            </h2>
        </div>
    </x-slot>

    <div class="min-w-full p-6">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="mx-auto max-w-3xl rounded-lg bg-white p-6 shadow-sm dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-gray-100">Add New Student</h3>
            <form method="POST" action="{{ route('tenant.students.store') }}">
                @csrf

                <!-- Personal Information -->
                <div class="mb-6">
                    <h4 class="text-md mb-3 font-medium text-gray-800 dark:text-gray-200">Personal Information</h4>

                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="mt-1 block w-full" type="text" name="name"
                            :value="old('name')" required autofocus maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="mt-1 block w-full" type="email" name="email"
                            :value="old('email')" required maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="phone" :value="__('Phone')" />
                        <x-text-input id="phone" class="mt-1 block w-full" type="tel" name="phone"
                            :value="old('phone')" maxlength="20" />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="address" class="mt-1 block w-full" type="text" name="address"
                            :value="old('address')" maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                        <x-text-input id="date_of_birth" class="mt-1 block w-full" type="date" name="date_of_birth"
                            :value="old('date_of_birth')" />
                        <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="gender" :value="__('Gender')" />
                        <select id="gender" name="gender"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                    </div>
                </div>

                <!-- Academic Information -->
                <div class="mb-6">
                    <h4 class="text-md mb-3 font-medium text-gray-800 dark:text-gray-200">Academic Information</h4>

                    <div class="mb-4">
                        <x-input-label for="enrollment_date" :value="__('Enrollment Date')" />
                        <x-text-input id="enrollment_date" class="mt-1 block w-full" type="date"
                            name="enrollment_date" :value="old('enrollment_date')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('enrollment_date')" />
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center">
                            <input id="is_active" type="checkbox" name="is_active" value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="mr-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <x-input-label for="is_active" :value="__('Active Student')" class="cursor-pointer" />
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('is_active')" />
                    </div>
                </div>

                <!-- Guardian Information -->
                <div class="mb-6">
                    <h4 class="text-md mb-3 font-medium text-gray-800 dark:text-gray-200">Parent/Guardian Information
                    </h4>

                    <!-- Parent 1 -->
                    <div class="mb-6 rounded-lg border border-gray-200 p-4 dark:border-gray-600">
                        <h5 class="mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">Parent/Guardian 1</h5>

                        <div class="mb-4">
                            <x-input-label for="parent1_name" :value="__('Name')" />
                            <x-text-input id="parent1_name" class="mt-1 block w-full" type="text" name="parent1_name"
                                :value="old('parent1_name')" maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('parent1_name')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="parent1_email" :value="__('Email')" />
                            <x-text-input id="parent1_email" class="mt-1 block w-full" type="email"
                                name="parent1_email" :value="old('parent1_email')" maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('parent1_email')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="parent1_phone" :value="__('Phone')" />
                            <x-text-input id="parent1_phone" class="mt-1 block w-full" type="tel"
                                name="parent1_phone" :value="old('parent1_phone')" maxlength="20" />
                            <x-input-error class="mt-2" :messages="$errors->get('parent1_phone')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="parent1_address" :value="__('Address')" />
                            <x-text-input id="parent1_address" class="mt-1 block w-full" type="text"
                                name="parent1_address" :value="old('parent1_address')" maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('parent1_address')" />
                        </div>
                    </div>

                    <!-- Parent 2 -->
                    <div class="mb-6 rounded-lg border border-gray-200 p-4 dark:border-gray-600">
                        <h5 class="mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">Parent/Guardian 2
                            (Optional)</h5>

                        <div class="mb-4">
                            <x-input-label for="parent2_name" :value="__('Name')" />
                            <x-text-input id="parent2_name" class="mt-1 block w-full" type="text"
                                name="parent2_name" :value="old('parent2_name')" maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('parent2_name')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="parent2_email" :value="__('Email')" />
                            <x-text-input id="parent2_email" class="mt-1 block w-full" type="email"
                                name="parent2_email" :value="old('parent2_email')" maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('parent2_email')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="parent2_phone" :value="__('Phone')" />
                            <x-text-input id="parent2_phone" class="mt-1 block w-full" type="tel"
                                name="parent2_phone" :value="old('parent2_phone')" maxlength="20" />
                            <x-input-error class="mt-2" :messages="$errors->get('parent2_phone')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="parent2_address" :value="__('Address')" />
                            <x-text-input id="parent2_address" class="mt-1 block w-full" type="text"
                                name="parent2_address" :value="old('parent2_address')" maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('parent2_address')" />
                        </div>
                    </div>

                    <!-- Legacy Guardian Fields (Hidden for backward compatibility) -->
                    <div class="hidden">
                        <div class="mb-4">
                            <x-input-label for="guardian_name" :value="__('Guardian Name')" />
                            <x-text-input id="guardian_name" class="mt-1 block w-full" type="text"
                                name="guardian_name" :value="old('guardian_name')" maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('guardian_name')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="guardian_contact" :value="__('Guardian Contact')" />
                            <x-text-input id="guardian_contact" class="mt-1 block w-full" type="tel"
                                name="guardian_contact" :value="old('guardian_contact')" maxlength="20" />
                            <x-input-error class="mt-2" :messages="$errors->get('guardian_contact')" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-4">
                    <a href="{{ route('tenant.students') }}"
                        class="rounded-md border border-gray-300 bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:border-gray-500 dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-500">
                        Cancel
                    </a>
                    <x-primary-button>Create Student</x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-populate guardian fields with parent 1 data
            const parent1Name = document.getElementById('parent1_name');
            const parent1Contact = document.getElementById('parent1_phone');
            const guardianName = document.getElementById('guardian_name');
            const guardianContact = document.getElementById('guardian_contact');

            function updateGuardianFields() {
                if (parent1Name.value) {
                    guardianName.value = parent1Name.value;
                }
                if (parent1Contact.value) {
                    guardianContact.value = parent1Contact.value;
                }
            }

            parent1Name.addEventListener('input', updateGuardianFields);
            parent1Contact.addEventListener('input', updateGuardianFields);
        });
    </script>
</x-tenant-dash-component>
