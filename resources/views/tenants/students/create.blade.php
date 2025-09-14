<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="flex items-center text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                <i
                    class="fas fa-user-graduate mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                {{ __('Students') }}
            </h2>
        </div>
    </x-slot>

    <div
        class="min-h-screen min-w-full bg-[color:var(--color-light-dark-green)] px-4 py-8 transition-colors duration-200 sm:px-6 lg:px-8 dark:bg-[color:var(--color-dark-green)]">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Success Message -->
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

        <div
            class="mx-auto max-w-3xl rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
            <h3
                class="mb-4 flex items-center text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                <i
                    class="fas fa-plus-circle mr-2 text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
                {{ __('Add New Student') }}
            </h3>
            <form method="POST" action="{{ route('tenant.students.store') }}" aria-label="Create new student form">
                @csrf

                <!-- Personal Information -->
                <div
                    class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <h4
                        class="text-md mb-4 flex items-center font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        <i
                            class="fas fa-user mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        Personal Information
                    </h4>

                    <div class="mb-4">
                        <x-input-label for="name"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-user mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Name') }}
                        </x-input-label>
                        <x-text-input id="name" class="mt-1 block w-full" type="text" name="name"
                            :value="old('name')" required autofocus maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-envelope mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Email') }}
                        </x-input-label>
                        <x-text-input id="email" class="mt-1 block w-full" type="email" name="email"
                            :value="old('email')" required maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="phone"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-phone mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Phone') }}
                        </x-input-label>
                        <x-text-input id="phone" class="mt-1 block w-full" type="tel" name="phone"
                            :value="old('phone')" maxlength="20" />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="address"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-map-marker-alt mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Address') }}
                        </x-input-label>
                        <x-text-input id="address" class="mt-1 block w-full" type="text" name="address"
                            :value="old('address')" maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="date_of_birth"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-calendar-alt mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Date of Birth') }}
                        </x-input-label>
                        <x-text-input id="date_of_birth" class="mt-1 block w-full" type="date" name="date_of_birth"
                            :value="old('date_of_birth')" />
                        <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="gender"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-venus-mars mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Gender') }}
                        </x-input-label>
                        <select id="gender" name="gender"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-dark-green)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                    </div>
                </div>

                <!-- Academic Information -->
                <div
                    class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <h4
                        class="text-md mb-4 flex items-center font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        <i
                            class="fas fa-graduation-cap mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        Academic Information
                    </h4>

                    <div class="mb-4">
                        <x-input-label for="enrollment_date"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-calendar-check mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Enrollment Date') }}
                        </x-input-label>
                        <x-text-input id="enrollment_date" class="mt-1 block w-full" type="date"
                            name="enrollment_date" :value="old('enrollment_date')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('enrollment_date')" />
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center">
                            <input id="is_active" type="checkbox" name="is_active" value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="mr-2 h-4 w-4 rounded-sm border-[color:var(--color-light-brunswick-green)] text-[color:var(--color-castleton-green)] transition-colors duration-200 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            <x-input-label for="is_active"
                                class="flex cursor-pointer items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-check-circle mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Active Student') }}
                            </x-input-label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('is_active')" />
                    </div>
                </div>

                <!-- Guardian Information -->
                <div
                    class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <h4
                        class="text-md mb-4 flex items-center font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        <i
                            class="fas fa-users mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        Parent/Guardian Information
                    </h4>

                    <!-- Parent 1 -->
                    <div
                        class="mb-6 rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)]">
                        <h5
                            class="mb-3 flex items-center text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            <i
                                class="fas fa-user-friends mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Parent/Guardian 1
                        </h5>

                        <div class="mb-4">
                            <x-input-label for="parent1_name"
                                class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-user mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Name') }}
                            </x-input-label>
                            <x-text-input id="parent1_name" class="mt-1 block w-full" type="text"
                                name="parent1_name" :value="old('parent1_name')" maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('parent1_name')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="parent1_email"
                                class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-envelope mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Email') }}
                            </x-input-label>
                            <x-text-input id="parent1_email" class="mt-1 block w-full" type="email"
                                name="parent1_email" :value="old('parent1_email')" maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('parent1_email')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="parent1_phone"
                                class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-phone mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Phone') }}
                            </x-input-label>
                            <x-text-input id="parent1_phone" class="mt-1 block w-full" type="tel"
                                name="parent1_phone" :value="old('parent1_phone')" maxlength="20" />
                            <x-input-error class="mt-2" :messages="$errors->get('parent1_phone')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="parent1_address"
                                class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-map-marker-alt mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Address') }}
                            </x-input-label>
                            <x-text-input id="parent1_address" class="mt-1 block w-full" type="text"
                                name="parent1_address" :value="old('parent1_address')" maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('parent1_address')" />
                        </div>
                    </div>

                    <!-- Parent 2 -->
                    <div
                        class="mb-6 rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)]">
                        <h5
                            class="mb-3 flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-user-plus mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Parent/Guardian 2 (Optional)
                        </h5>

                        <div class="mb-4">
                            <x-input-label for="parent2_name"
                                class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-user mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Name') }}
                            </x-input-label>
                            <x-text-input id="parent2_name" class="mt-1 block w-full" type="text"
                                name="parent2_name" :value="old('parent2_name')" maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('parent2_name')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="parent2_email"
                                class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-envelope mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Email') }}
                            </x-input-label>
                            <x-text-input id="parent2_email" class="mt-1 block w-full" type="email"
                                name="parent2_email" :value="old('parent2_email')" maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('parent2_email')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="parent2_phone"
                                class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-phone mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Phone') }}
                            </x-input-label>
                            <x-text-input id="parent2_phone" class="mt-1 block w-full" type="tel"
                                name="parent2_phone" :value="old('parent2_phone')" maxlength="20" />
                            <x-input-error class="mt-2" :messages="$errors->get('parent2_phone')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="parent2_address"
                                class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-map-marker-alt mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Address') }}
                            </x-input-label>
                            <x-text-input id="parent2_address" class="mt-1 block w-full" type="text"
                                name="parent2_address" :value="old('parent2_address')" maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('parent2_address')" />
                        </div>
                    </div>

                    <!-- Legacy Guardian Fields (Hidden for backward compatibility) -->
                    <div class="hidden">
                        <div class="mb-4">
                            <x-input-label for="guardian_name"
                                class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-user mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Guardian Name') }}
                            </x-input-label>
                            <x-text-input id="guardian_name" class="mt-1 block w-full" type="text"
                                name="guardian_name" :value="old('guardian_name')" maxlength="255" />
                            <x-input-error class="mt-2" :messages="$errors->get('guardian_name')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="guardian_contact"
                                class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-phone mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Guardian Contact') }}
                            </x-input-label>
                            <x-text-input id="guardian_contact" class="mt-1 block w-full" type="tel"
                                name="guardian_contact" :value="old('guardian_contact')" maxlength="20" />
                            <x-input-error class="mt-2" :messages="$errors->get('guardian_contact')" />
                        </div>
                    </div>
                </div>

                <div
                    class="flex items-center justify-end space-x-4 border-t border-[color:var(--color-light-brunswick-green)] pt-6 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)]">
                    <a href="{{ route('tenant.students') }}"
                        class="inline-flex items-center rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
                        <i class="fas fa-times mr-2"></i>
                        Cancel
                    </a>
                    <x-primary-button class="inline-flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Create Student
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-populate guardian fields with parent 1 data for backward compatibility
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

            // Add smooth fade-in animation to form sections
            const formSections = document.querySelectorAll('.rounded-lg.border');
            formSections.forEach((section, index) => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(10px)';
                section.style.transition = 'all 0.3s ease';

                setTimeout(() => {
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</x-tenant-dash-component>
