<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                {{ __('Take Attendance') }}
            </h2>
            <a href="{{ route('tenant.attendance.index') }}"
                class="focus:outline-hidden inline-flex items-center gap-2 rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-castleton-green)] focus:ring-2 focus:ring-[color:var(--color-light-brunswick-green)] focus:ring-offset-2 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-castleton-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                <i class="fas fa-arrow-left h-4 w-4"></i>
                Back to Attendance
            </a>
        </div>
    </x-slot>

    <div class="p-6">
        <!-- Class and Date Selection -->
        <div
            class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
            <form method="GET" action="{{ route('tenant.attendance.create') }}" class="space-y-4">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="class_id"
                            class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Select
                            Class</label>
                        <select name="class_id" id="class_id" required
                            class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)]"
                            onchange="this.form.submit()">
                            <option value="">Choose a class...</option>
                            @foreach ($classes as $classOption)
                                <option value="{{ $classOption->id }}"
                                    {{ request('class_id') == $classOption->id ? 'selected' : '' }}>
                                    {{ $classOption->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="date"
                            class="block text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">Date</label>
                        <input type="date" name="date" id="date" value="{{ $date }}"
                            class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)]"
                            onchange="this.form.submit()">
                    </div>
                </div>
            </form>
        </div>

        @if ($class)
            <!-- Attendance Form -->
            <div
                class="overflow-hidden border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow transition-colors duration-200 sm:rounded-lg dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                <div class="px-4 py-5 sm:p-6">
                    <h3
                        class="mb-4 text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        {{ $class->name }} - {{ \Carbon\Carbon::parse($date)->format('M d, Y') }}
                    </h3>

                    @if ($class->students->count() > 0)
                        <form method="POST" action="{{ route('tenant.attendance.store') }}">
                            @csrf
                            <input type="hidden" name="class_id" value="{{ $class->id }}">
                            <input type="hidden" name="date" value="{{ $date }}">

                            <div class="space-y-4">
                                <!-- Quick Actions -->
                                <div class="mb-6 flex items-center gap-4">
                                    <button type="button" onclick="markAll('present')"
                                        class="focus:outline-hidden inline-flex items-center gap-2 rounded-md bg-green-600 px-3 py-1.5 text-xs font-medium text-white transition-colors duration-200 hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                        Mark All Present
                                    </button>
                                    <button type="button" onclick="markAll('absent')"
                                        class="focus:outline-hidden inline-flex items-center gap-2 rounded-md bg-red-600 px-3 py-1.5 text-xs font-medium text-white transition-colors duration-200 hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                        Mark All Absent
                                    </button>
                                </div>

                                <!-- Student List -->
                                @foreach ($class->students as $student)
                                    @php
                                        $attendance = $existingAttendance->get($student->id);
                                        $currentStatus = $attendance ? $attendance->status : 'present';
                                        $currentNotes = $attendance ? $attendance->notes : '';
                                    @endphp
                                    <div
                                        class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    <div
                                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-[color:var(--color-castleton-green)] transition-colors duration-200 dark:bg-[color:var(--color-gunmetal)]">
                                                        <span
                                                            class="text-sm font-medium text-[color:var(--color-light-dark-green)]">
                                                            {{ substr($student->user->name, 0, 2) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <h4
                                                        class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                                        {{ $student->user->name }}
                                                    </h4>
                                                    <p
                                                        class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                        {{ $student->user->email }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-4">
                                                <!-- Status Selection -->
                                                <div class="flex items-center gap-2">
                                                    @foreach ($statusOptions as $value => $label)
                                                        <label class="inline-flex items-center">
                                                            <input type="radio"
                                                                name="attendance[{{ $loop->parent->index }}][status]"
                                                                value="{{ $value }}"
                                                                {{ $currentStatus === $value ? 'checked' : '' }}
                                                                class="form-radio h-4 w-4 border-[color:var(--color-light-brunswick-green)] text-[color:var(--color-castleton-green)] transition-colors duration-200 focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-brunswick-green)] dark:focus:ring-[color:var(--color-brunswick-green)]">
                                                            <span
                                                                class="ml-2 text-sm text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">{{ $label }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Notes -->
                                        <div class="mt-3">
                                            <label for="notes_{{ $student->id }}"
                                                class="block text-xs font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">Notes
                                                (optional)</label>
                                            <input type="text" name="attendance[{{ $loop->index }}][notes]"
                                                id="notes_{{ $student->id }}" value="{{ $currentNotes }}"
                                                placeholder="Add any notes about this student's attendance..."
                                                class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] text-sm text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        </div>
                                        <!-- Hidden student ID -->
                                        <input type="hidden" name="attendance[{{ $loop->index }}][student_id]"
                                            value="{{ $student->id }}">
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-6 flex items-center justify-end gap-4">
                                <a href="{{ route('tenant.attendance.index') }}"
                                    class="focus:outline-hidden inline-flex items-center gap-2 rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-light-castleton-green)] focus:ring-2 focus:ring-[color:var(--color-light-brunswick-green)] focus:ring-offset-2 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-castleton-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                                    Cancel
                                </a>
                                <button type="submit"
                                    class="focus:outline-hidden inline-flex items-center gap-2 rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-light-dark-green)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-brunswick-green)] dark:hover:bg-[color:var(--color-gunmetal)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                                    <i class="fas fa-save h-4 w-4"></i>
                                    Save Attendance
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="py-8 text-center">
                            <i
                                class="fas fa-users mx-auto h-12 w-12 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                            <h3
                                class="mt-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                No students enrolled</h3>
                            <p
                                class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                This class has no students enrolled yet.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="py-12 text-center">
                <i
                    class="fas fa-chalkboard mx-auto h-12 w-12 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]"></i>
                <h3
                    class="mt-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                    Select a class</h3>
                <p
                    class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    Choose a class from the dropdown above to take attendance.
                </p>
            </div>
        @endif
    </div>

    <script>
        function markAll(status) {
            const radios = document.querySelectorAll('input[type="radio"][value="' + status + '"]');
            radios.forEach(radio => {
                radio.checked = true;
            });
        }
    </script>
</x-tenant-dash-component>
