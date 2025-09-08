<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <i
                    class="fas fa-user-graduate mr-3 text-2xl text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                <h2
                    class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    {{ __('Student Details') }}
                </h2>
            </div>
            <a href="{{ route('tenant.students') }}"
                class="inline-flex items-center text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]">
                <i class="fas fa-arrow-left mr-2"></i>Back to Students
            </a>
        </div>
    </x-slot>

    <div class="mx-auto max-w-3xl px-4 py-8 transition-colors duration-200 sm:px-6 lg:px-8">
        <div
            class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-sm dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
            <div class="mb-4 flex items-center">
                <i
                    class="fas fa-info-circle mr-2 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                <h3
                    class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Student Information</h3>
            </div>
            <dl
                class="divide-y divide-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-castleton-green)]">
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt
                        class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i class="fas fa-user mr-2 w-4"></i>Name
                    </dt>
                    <dd
                        class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                        {{ $student->name }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt
                        class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i class="fas fa-envelope mr-2 w-4"></i>Email
                    </dt>
                    <dd
                        class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                        {{ $student->email }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt
                        class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i class="fas fa-phone mr-2 w-4"></i>Phone
                    </dt>
                    <dd
                        class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                        {{ $student->phone ?? 'Not provided' }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt
                        class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i class="fas fa-map-marker-alt mr-2 w-4"></i>Address
                    </dt>
                    <dd
                        class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                        {{ $student->address ?? 'Not provided' }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt
                        class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i class="fas fa-birthday-cake mr-2 w-4"></i>Date of Birth
                    </dt>
                    <dd
                        class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                        {{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('F j, Y') : 'Not provided' }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt
                        class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i class="fas fa-venus-mars mr-2 w-4"></i>Gender
                    </dt>
                    <dd
                        class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                        {{ $student->gender ? ucfirst($student->gender) : 'Not specified' }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt
                        class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i class="fas fa-calendar-alt mr-2 w-4"></i>Enrollment Date
                    </dt>
                    <dd
                        class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                        {{ $student->enrollment_date ? \Carbon\Carbon::parse($student->enrollment_date)->format('F j, Y') : 'Not set' }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt
                        class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i
                            class="fas fa-circle {{ $student->is_active ? 'text-green-600' : 'text-red-600' }} mr-2 w-4"></i>Status
                    </dt>
                    <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">
                        <span
                            class="{{ $student->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }} inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold transition-colors duration-200">
                            <i class="fas fa-{{ $student->is_active ? 'check' : 'times' }} mr-1"></i>
                            {{ $student->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt
                        class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i class="fas fa-user-shield mr-2 w-4"></i>Guardian Name
                    </dt>
                    <dd
                        class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                        {{ $student->guardian_name ?? 'Not provided' }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt
                        class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i class="fas fa-phone-alt mr-2 w-4"></i>Guardian Contact
                    </dt>
                    <dd
                        class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                        {{ $student->guardian_contact ?? 'Not provided' }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt
                        class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i class="fas fa-clock mr-2 w-4"></i>Created At
                    </dt>
                    <dd
                        class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                        {{ $student->created_at->format('F j, Y \a\t g:i A') }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt
                        class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i class="fas fa-edit mr-2 w-4"></i>Updated At
                    </dt>
                    <dd
                        class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                        {{ $student->updated_at->format('F j, Y \a\t g:i A') }}</dd>
                </div>
            </dl>

            @if ($student->user)
                <div class="mb-4 mt-8 flex items-center">
                    <i
                        class="fas fa-user-cog mr-2 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                    <h3
                        class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        Account Information</h3>
                </div>
                <dl
                    class="divide-y divide-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-castleton-green)]">
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i class="fas fa-user-tag mr-2 w-4"></i>User Role
                        </dt>
                        <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">
                            @php
                                $role = $student->user->getRoleNames()->join(', ');
                            @endphp
                            <span
                                class="{{ $role === 'student' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]' }} inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold transition-colors duration-200">
                                <i class="fas fa-graduation-cap mr-1"></i>
                                {{ $role === 'student' ? 'Student' : ucfirst($role) }}
                            </span>
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i class="fas fa-user-plus mr-2 w-4"></i>Account Created
                        </dt>
                        <dd
                            class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $student->user->created_at->format('F j, Y \a\t g:i A') }}
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i class="fas fa-envelope-circle-check mr-2 w-4"></i>Email Verified
                        </dt>
                        <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">
                            <span
                                class="{{ $student->user->email_verified_at ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }} inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold transition-colors duration-200">
                                <i
                                    class="fas fa-{{ $student->user->email_verified_at ? 'check-circle' : 'clock' }} mr-1"></i>
                                {{ $student->user->email_verified_at ? 'Verified' : 'Pending' }}
                            </span>
                        </dd>
                    </div>
                </dl>
            @endif

            <!-- Class Enrollments Section -->
            <div class="mt-8">
                <div class="mb-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <i
                            class="fas fa-chalkboard mr-2 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                        <h3
                            class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Class Enrollments</h3>
                    </div>
                    @if ($availableClasses->count() > 0)
                        <button onclick="toggleEnrollForm()"
                            class="focus:outline-hidden inline-flex items-center rounded-md bg-green-600 px-4 py-2 text-sm font-medium text-white transition-colors duration-200 hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:bg-green-700 dark:hover:bg-green-600">
                            <i class="fas fa-plus mr-2"></i>Enroll in Class
                        </button>
                    @endif
                </div>

                <!-- Enroll in Class Form -->
                @if ($availableClasses->count() > 0)
                    <div id="enrollForm"
                        class="mb-6 hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                        <form action="{{ route('tenant.students.enrollInClass', $student) }}" method="POST">
                            @csrf
                            <div class="flex items-end space-x-4">
                                <div class="flex-1">
                                    <label for="class_id"
                                        class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        <i class="fas fa-list mr-2"></i>Select Class
                                    </label>
                                    <select name="class_id" id="class_id" required
                                        class="mt-1 block w-full rounded-md border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] text-[color:var(--color-dark-green)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        <option value="">Choose a class...</option>
                                        @foreach ($availableClasses as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}
                                                @if ($class->subject)
                                                    - {{ $class->subject }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit"
                                    class="focus:outline-hidden inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                                    <i class="fas fa-user-plus mr-2"></i>Enroll
                                </button>
                                <button type="button" onclick="toggleEnrollForm()"
                                    class="focus:outline-hidden inline-flex items-center rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-gunmetal)] focus:ring-offset-2 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
                                    <i class="fas fa-times mr-2"></i>Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- Current Enrollments Table -->
                <div
                    class="overflow-hidden rounded-lg border border-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                    <table
                        class="min-w-full divide-y divide-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-castleton-green)]">
                        <thead
                            class="bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)]">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    <i class="fas fa-chalkboard-teacher mr-2"></i>Class Name
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    <i class="fas fa-book mr-2"></i>Subject
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    <i class="fas fa-calendar-plus mr-2"></i>Enrolled At
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    <i class="fas fa-info-circle mr-2"></i>Status
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                    <i class="fas fa-cogs mr-2"></i>Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] transition-colors duration-200 dark:divide-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-brunswick-green)]">
                            @forelse ($student->classes as $class)
                                <tr
                                    class="transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-gunmetal)]">
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        <a href="{{ route('tenant.classes.show', $class) }}"
                                            class="inline-flex items-center text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                            <i class="fas fa-external-link-alt mr-2"></i>
                                            {{ $class->name }}
                                        </a>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $class->subject ?? 'N/A' }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        {{ $class->pivot->enrolled_at ? \Carbon\Carbon::parse($class->pivot->enrolled_at)->format('M j, Y') : 'N/A' }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        <span
                                            class="{{ $class->pivot->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }} inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold transition-colors duration-200">
                                            <i
                                                class="fas fa-{{ $class->pivot->is_active ? 'check' : 'times' }} mr-1"></i>
                                            {{ $class->pivot->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        <form
                                            action="{{ route('tenant.students.unenrollFromClass', [$student, $class]) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to unenroll this student from {{ $class->name }}?')"
                                                class="inline-flex items-center text-red-600 transition-colors duration-200 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                                <i class="fas fa-user-minus mr-1"></i>Unenroll
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="px-6 py-12 text-center text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        <div class="flex flex-col items-center">
                                            <i
                                                class="fas fa-inbox mb-4 text-4xl text-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-castleton-green)]"></i>
                                            <p class="mb-2">Student is not enrolled in any classes yet.</p>
                                            @if ($availableClasses->count() > 0)
                                                <button onclick="toggleEnrollForm()"
                                                    class="inline-flex items-center text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                                                    <i class="fas fa-plus mr-2"></i>Enroll in a class
                                                </button>
                                            @else
                                                <span
                                                    class="mt-2 block text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                                    <i class="fas fa-info-circle mr-2"></i>No classes available for
                                                    enrollment.
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6 flex flex-row justify-end space-x-4">
                <a href="{{ route('tenant.students') }}"
                    class="focus:outline-hidden inline-flex items-center rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Students
                </a>
                <a href="{{ route('tenant.students.edit', $student) }}"
                    class="focus:outline-hidden inline-flex items-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                    <i class="fas fa-edit mr-2"></i>Edit Student
                </a>
            </div>
        </div>
    </div>

    <script>
        function toggleEnrollForm() {
            const form = document.getElementById('enrollForm');
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
            } else {
                form.classList.add('hidden');
                // Reset form when hiding
                document.getElementById('class_id').value = '';
            }
        }
    </script>
</x-tenant-dash-component>
