<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="flex items-center text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                <i
                    class="fas fa-user-graduate mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                {{ __('Create Review Ticket') }}
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
                Add New Review Ticket
            </h3>
            <form method="POST" action="{{ route('tenant.review-tickets.store') }}">
                @csrf

                <!-- Personal Information -->
                <div
                    class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <h4
                        class="text-md mb-4 flex items-center font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        <i
                            class="fas fa-ticket-alt mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        Ticket Information
                    </h4>

                    <div class="mb-4">
                        <x-input-label for="class_id" :value="__('Class')" />
                        <select id="class_id" name="class_id"
                            class="mt-1 block w-full rounded-md border border-[color:var(--color-light-brunswick-green)] bg-white px-3 py-2 text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            <option value="">{{ __('Select Class') }}</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}" @if (old('class_id') == $class->id) selected @endif>
                                    {{ $class->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('class_id')" />

                    </div>

                    <div class="mb-4">
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="mt-1 block w-full" type="text" name="title"
                            :value="old('title')" required autofocus maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>
                    <h4
                        class="text-md mb-4 flex items-center font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        Questions
                    </h4>

                    <div class="mb-4">
                        <x-input-label for="questions" :value="__('Question 1')" />
                        <x-text-input id="questions" class="mt-1 block w-full" type="text" name="questions[]"
                            :value="old('questions.0')" required maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('questions.0')" />
                    </div>

                    <button type="button" id="add-question-btn"
                        class="mt-2 inline-flex items-center rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
                        <i
                            class="fas fa-plus-circle mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        Add Another Question
                    </button>

                    <div
                        class="flex items-center justify-end space-x-4 border-t border-[color:var(--color-light-brunswick-green)] pt-6 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)]">
                        <a href="{{ route('tenant.students') }}"
                            class="inline-flex items-center rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
                            <i class="fas fa-times mr-2"></i>
                            Cancel
                        </a>
                        <x-primary-button class="inline-flex items-center">
                            <i class="fas fa-save mr-2"></i>
                            Create Review Ticket
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
        // Add functionality to dynamically add question fields
        document.getElementById('add-question-btn').addEventListener('click', function() {
            const questionContainer = document.createElement('div');
            let questionCount = document.querySelectorAll('input[name^="questions"]').length + 1;
            questionContainer.classList.add('mb-4');
            questionContainer.innerHTML = `
                <x-input-label for="questions" :value="__('Question ${questionCount}')" />
                <x-text-input id="questions" class="mt-1 block w-full" type="text" name="questions[]" required maxlength="255" />
                <x-input-error class="mt-2" :messages="$errors->get('questions')" />
            `;
            this.insertAdjacentElement('beforebegin', questionContainer);
            questionContainer.scrollIntoView({
                behavior: 'smooth'
            });

        });
    </script>
</x-tenant-dash-component>
