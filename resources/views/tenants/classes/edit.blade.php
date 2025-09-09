<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="flex items-center text-xl font-semibold leading-tight text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                <i
                    class="fas fa-edit mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                Edit Class
            </h2>
        </div>
    </x-slot>

    <div
        class="min-w-full bg-[color:var(--color-light-dark-green)] p-6 transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div
            class="mx-auto max-w-3xl rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
            <h3
                class="mb-6 flex items-center text-lg font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                <i
                    class="fas fa-chalkboard mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                Edit Class Information
            </h3>
            <form method="POST" action="{{ route('tenant.classes.update', $class) }}">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div
                    class="mb-8 rounded-lg border border-[color:var(--color-castleton-green)] bg-[color:var(--color-light-castleton-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <h4
                        class="text-md mb-6 flex items-center font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i
                            class="fas fa-info-circle mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                        Basic Information
                    </h4>

                    <div class="mb-4">
                        <x-input-label for="name"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-chalkboard mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Class Name') }}
                        </x-input-label>
                        <x-text-input id="name"
                            class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                            type="text" name="name" :value="old('name', $class->name)" required autofocus maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="subject"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-book mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Subject') }}
                        </x-input-label>
                        <x-text-input id="subject"
                            class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                            type="text" name="subject" :value="old('subject', $class->subject)" maxlength="255" />
                        <x-input-error class="mt-2" :messages="$errors->get('subject')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="teacher_id"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-chalkboard-teacher mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Teacher') }}
                        </x-input-label>
                        <select id="teacher_id" name="teacher_id"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            <option value="">Select Teacher</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ old('teacher_id', $class->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('teacher_id')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="room"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-door-open mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Room') }}
                        </x-input-label>
                        <x-text-input id="room"
                            class="mt-1 block w-full border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]"
                            type="text" name="room" :value="old('room', $class->room)" maxlength="50" />
                        <x-input-error class="mt-2" :messages="$errors->get('room')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description"
                            class="flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-file-alt mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            {{ __('Description') }}
                        </x-input-label>
                        <textarea id="description" name="description" rows="4"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">{{ old('description', $class->description) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>
                </div>

                <!-- Schedule Information -->
                <div
                    class="mb-8 rounded-lg border border-[color:var(--color-castleton-green)] bg-[color:var(--color-light-castleton-green)] p-6 transition-colors duration-200 dark:border-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                    <h4
                        class="text-md mb-6 flex items-center font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i
                            class="fas fa-calendar-alt mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                        Schedule Information
                    </h4>

                    <div class="mb-6">
                        <x-input-label
                            class="mb-4 flex items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-clock mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                            Class Schedule
                        </x-input-label>

                        <!-- Days of the week -->
                        <div class="mb-4">
                            <label
                                class="mb-3 block text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-calendar-week mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                Days of the Week
                            </label>
                            <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 lg:grid-cols-7">
                                @php
                                    $days = [
                                        'Monday',
                                        'Tuesday',
                                        'Wednesday',
                                        'Thursday',
                                        'Friday',
                                        'Saturday',
                                        'Sunday',
                                    ];
                                    $existingSchedule = old('schedule', $class->schedule ? $class->schedule : []);
                                    $selectedDays =
                                        is_array($existingSchedule) && isset($existingSchedule['days'])
                                            ? $existingSchedule['days']
                                            : [];
                                @endphp
                                @foreach ($days as $day)
                                    <div class="flex items-center">
                                        <input type="checkbox" id="day_{{ strtolower($day) }}" name="schedule_days[]"
                                            value="{{ $day }}"
                                            {{ in_array($day, $selectedDays) ? 'checked' : '' }}
                                            class="h-4 w-4 rounded border-[color:var(--color-brunswick-green)] text-[color:var(--color-castleton-green)] transition-colors duration-200 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                                        <label for="day_{{ strtolower($day) }}"
                                            class="ml-2 cursor-pointer text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            {{ $day }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Time inputs -->
                        <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label for="start_time"
                                    class="mb-2 block text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    <i
                                        class="fas fa-play mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                    Start Time
                                </label>
                                <input type="time" id="start_time" name="start_time"
                                    value="{{ old('start_time', is_array($existingSchedule) && isset($existingSchedule['start_time']) ? $existingSchedule['start_time'] : '') }}"
                                    class="block w-full rounded-md border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            </div>
                            <div>
                                <label for="end_time"
                                    class="mb-2 block text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    <i
                                        class="fas fa-stop mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                    End Time
                                </label>
                                <input type="time" id="end_time" name="end_time"
                                    value="{{ old('end_time', is_array($existingSchedule) && isset($existingSchedule['end_time']) ? $existingSchedule['end_time'] : '') }}"
                                    class="block w-full rounded-md border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            </div>
                        </div>

                        <!-- Additional notes -->
                        <div class="mb-4">
                            <label for="schedule_notes"
                                class="mb-2 block text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-sticky-note mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                Additional Notes (Optional)
                            </label>
                            <textarea id="schedule_notes" name="schedule_notes" rows="2"
                                placeholder="Any additional scheduling information..."
                                class="block w-full rounded-md border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:focus:border-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">{{ old('schedule_notes', is_array($existingSchedule) && isset($existingSchedule['notes']) ? $existingSchedule['notes'] : '') }}</textarea>
                        </div>

                        <!-- Hidden field for JSON format (for backend compatibility) -->
                        <input type="hidden" id="schedule" name="schedule" value="">

                        <x-input-error class="mt-2" :messages="$errors->get('schedule')" />
                        <p
                            class="mt-2 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            <i class="fas fa-info-circle mr-1"></i>
                            Select the days and times when this class takes place
                        </p>
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center">
                            <input id="is_active" type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $class->is_active) ? 'checked' : '' }}
                                class="mr-3 h-4 w-4 rounded border-[color:var(--color-brunswick-green)] text-[color:var(--color-castleton-green)] transition-colors duration-200 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:focus:ring-[color:var(--color-light-castleton-green)]">
                            <x-input-label for="is_active"
                                class="flex cursor-pointer items-center text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-toggle-on mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                {{ __('Active Class') }}
                            </x-input-label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('is_active')" />
                    </div>
                </div>

                <div
                    class="flex items-center justify-end space-x-4 border-t border-[color:var(--color-brunswick-green)] pt-6 dark:border-[color:var(--color-light-brunswick-green)]">
                    <a href="{{ route('tenant.classes') }}"
                        class="inline-flex items-center rounded-md border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] transition-all duration-200 hover:bg-[color:var(--color-light-castleton-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-castleton-green)]">
                        <i class="fas fa-times mr-2"></i>
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white transition-all duration-200 hover:bg-[color:var(--color-dark-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-light-dark-green)]">
                        <i class="fas fa-save mr-2"></i>
                        Update Class
                    </button>
                </div>
            </form>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const scheduleInput = document.getElementById('schedule');
            const dayCheckboxes = document.querySelectorAll('input[name="schedule_days[]"]');
            const startTimeInput = document.getElementById('start_time');
            const endTimeInput = document.getElementById('end_time');
            const notesInput = document.getElementById('schedule_notes');

            // Function to update the hidden JSON field
            function updateScheduleJson() {
                const selectedDays = Array.from(dayCheckboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                const startTime = startTimeInput.value;
                const endTime = endTimeInput.value;
                const notes = notesInput.value;

                const scheduleData = {};

                if (selectedDays.length > 0) {
                    scheduleData.days = selectedDays;
                }

                if (startTime && endTime) {
                    scheduleData.start_time = startTime;
                    scheduleData.end_time = endTime;
                    scheduleData.time = `${startTime}-${endTime}`;
                } else if (startTime) {
                    scheduleData.start_time = startTime;
                } else if (endTime) {
                    scheduleData.end_time = endTime;
                }

                if (notes.trim()) {
                    scheduleData.notes = notes.trim();
                }

                scheduleInput.value = Object.keys(scheduleData).length > 0 ? JSON.stringify(scheduleData) : '';
            }

            // Add event listeners to all schedule-related inputs
            dayCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateScheduleJson);
            });

            startTimeInput.addEventListener('change', updateScheduleJson);
            endTimeInput.addEventListener('change', updateScheduleJson);
            notesInput.addEventListener('input', updateScheduleJson);

            // Initialize the JSON field on page load
            updateScheduleJson();

            // Update JSON before form submission
            form.addEventListener('submit', function(e) {
                updateScheduleJson();
            });
        });
    </script>
</x-tenant-dash-component>
