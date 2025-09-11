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
        class="min-h-screen min-w-full bg-[color:var(--color-light-dark-green)] p-6 transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div
            class="mx-auto max-w-3xl rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
            <h3
                class="mb-4 flex items-center text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                <i
                    class="fas fa-plus-circle mr-2 text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
                Add New Student
            </h3>
            <form method="POST" action="{{ route('tenant.students.store') }}">
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
                        <x-input-label for="enrollment_date" :value="__('Enrollment Date')" />
                        <x-text-input id="enrollment_date" class="mt-1 block w-full" type="date"
                            name="enrollment_date" :value="old('enrollment_date')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('enrollment_date')" />
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center">
                            <input id="is_active" type="checkbox" name="is_active" value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="mr-2 h-4 w-4 rounded-sm border-[color:var(--color-light-brunswick-green)] text-[color:var(--color-castleton-green)] transition-colors duration-200 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            <x-input-label for="is_active" :value="__('Active Student')" class="cursor-pointer" />
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
                    <div
                        class="mb-6 rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)]">
                        <h5
                            class="mb-3 flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-user-plus mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Parent/Guardian 2 (Optional)
                        </h5>

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

            // Add smooth animations to form sections
            const formSections = document.querySelectorAll('.rounded-lg.border');
            formSections.forEach((section, index) => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                section.style.transition = 'all 0.4s ease';

                setTimeout(() => {
                    section.style.opacity = '1';
                    section.style.transform = 'translateY(0)';
                }, index * 150);
            });

            // Add focus enhancement for form inputs
            const inputs = document.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.closest('.mb-4')?.classList.add('transform', 'scale-[1.02]');
                });

                input.addEventListener('blur', function() {
                    this.closest('.mb-4')?.classList.remove('transform', 'scale-[1.02]');
                });
            });

            // Add hover effects to buttons
            const buttons = document.querySelectorAll('a, button');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-1px)';
                });

                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</x-tenant-dash-component>
