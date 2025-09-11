<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <i
                    class="fas fa-chalkboard mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                <h2
                    class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Class Details
                </h2>
            </div>
            <a href="{{ route('tenant.classes') }}"
                class="inline-flex items-center text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                <i class="fas fa-arrow-left mr-2"></i>Back to Classes
            </a>
        </div>
    </x-slot>

    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="mx-auto max-w-3xl px-4 py-2 sm:px-6 lg:px-8">
            <div
                class="rounded-md border border-green-200 bg-green-100 p-4 transition-colors duration-200 dark:border-green-800 dark:bg-green-900">
                <div class="flex">
                    <div class="shrink-0">
                        <i class="fas fa-check-circle h-5 w-5 text-green-600 dark:text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mx-auto max-w-3xl px-4 py-2 sm:px-6 lg:px-8">
            <div
                class="rounded-md border border-red-200 bg-red-100 p-4 transition-colors duration-200 dark:border-red-800 dark:bg-red-900">
                <div class="flex">
                    <div class="shrink-0">
                        <i class="fas fa-exclamation-circle h-5 w-5 text-red-600 dark:text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800 dark:text-red-200">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="min-h-screen transition-colors duration-200">
        <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div class="mb-4 flex items-center">
                    <i
                        class="fas fa-info-circle mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                    <h3
                        class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        Class Information</h3>
                </div>
                <dl
                    class="divide-y divide-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-castleton-green)]">
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-chalkboard mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Class Name
                        </dt>
                        <dd
                            class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $class->name }}
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-book mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Subject
                        </dt>
                        <dd
                            class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $class->subject ?? 'No subject specified' }}
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-chalkboard-teacher mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Teacher
                        </dt>
                        <dd
                            class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $class->teacher ? $class->teacher->name : 'No teacher assigned' }}
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-door-open mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Room
                        </dt>
                        <dd
                            class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $class->room ?? 'No room assigned' }}
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-file-alt mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Description
                        </dt>
                        <dd
                            class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $class->description ?? 'No description provided' }}
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-calendar-alt mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Schedule
                        </dt>
                        <dd
                            class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                            @if ($class->schedule)
                                <pre
                                    class="whitespace-pre-wrap rounded border bg-[color:var(--color-light-castleton-green)] p-3 text-sm dark:bg-[color:var(--color-castleton-green)]">{{ json_encode($class->schedule, JSON_PRETTY_PRINT) }}</pre>
                            @else
                                No schedule set
                            @endif
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-toggle-on mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Status
                        </dt>
                        <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">
                            <span
                                class="{{ $class->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }} inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold transition-colors duration-200">
                                <i
                                    class="{{ $class->is_active ? 'fas fa-check-circle' : 'fas fa-times-circle' }} mr-1"></i>
                                {{ $class->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-users mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Students Enrolled
                        </dt>
                        <dd
                            class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $class->students->count() }} students
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-calendar-plus mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Created At
                        </dt>
                        <dd
                            class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $class->created_at->format('F j, Y \a\t g:i A') }}</dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-edit mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Updated At
                        </dt>
                        <dd
                            class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $class->updated_at->format('F j, Y \a\t g:i A') }}</dd>
                    </div>
                </dl>

                <!-- Students Section -->
                <div class="mt-8">
                    <div class="mb-4 flex items-center justify-between">
                        <h3
                            class="flex items-center text-lg font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-user-graduate mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Enrolled Students
                        </h3>
                        @if ($availableStudents->count() > 0)
                            <button onclick="toggleAddStudentForm()"
                                class="inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white transition-all duration-200 hover:bg-[color:var(--color-dark-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-light-dark-green)]">
                                <i class="fas fa-user-plus mr-2"></i>
                                Add Student
                            </button>
                        @endif
                    </div>

                    <!-- Add Student Form -->
                    @if ($availableStudents->count() > 0)
                        <div id="addStudentForm"
                            class="mb-6 hidden rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                            <form action="{{ route('tenant.classes.addStudent', $class) }}" method="POST">
                                @csrf
                                <div class="flex items-end space-x-4">
                                    <div class="flex-1">
                                        <label for="student_id"
                                            class="block text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            <i class="fas fa-search mr-1"></i>
                                            Select Student
                                        </label>
                                        <select name="student_id" id="student_id" required
                                            class="mt-1 block w-full rounded-md border-[color:var(--color-brunswick-green)] bg-white text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 focus:border-[color:var(--color-castleton-green)] focus:ring-[color:var(--color-castleton-green)] dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            <option value="">Choose a student...</option>
                                            @foreach ($availableStudents as $student)
                                                <option value="{{ $student->id }}">{{ $student->name }}
                                                    ({{ $student->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit"
                                        class="inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white transition-all duration-200 hover:bg-[color:var(--color-dark-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-light-dark-green)]">
                                        <i class="fas fa-plus mr-2"></i>
                                        Add to Class
                                    </button>
                                    <button type="button" onclick="toggleAddStudentForm()"
                                        class="inline-flex items-center rounded-md border border-[color:var(--color-brunswick-green)] bg-white px-4 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] transition-all duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-brunswick-green)]">
                                        <i class="fas fa-times mr-2"></i>
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif

                    <!-- Students Table -->
                    <div
                        class="overflow-hidden rounded-lg border border-[color:var(--color-brunswick-green)] shadow-lg dark:border-[color:var(--color-light-brunswick-green)]">
                        <table
                            class="min-w-full divide-y divide-[color:var(--color-brunswick-green)] dark:divide-[color:var(--color-light-brunswick-green)]">
                            <thead
                                class="bg-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        <i class="fas fa-user mr-2"></i>
                                        Name
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        <i class="fas fa-envelope mr-2"></i>
                                        Email
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        <i class="fas fa-toggle-on mr-2"></i>
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        <i class="fas fa-cogs mr-2"></i>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                class="divide-y divide-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                @forelse ($class->students as $student)
                                    <tr
                                        class="transition-colors duration-200 hover:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-castleton-green)]">
                                        <td
                                            class="whitespace-nowrap px-6 py-4 text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            {{ $student->name }}
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                            {{ $student->email }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm">
                                            <span
                                                class="{{ $student->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }} inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold transition-colors duration-200">
                                                <i
                                                    class="{{ $student->is_active ? 'fas fa-check-circle' : 'fas fa-times-circle' }} mr-1"></i>
                                                {{ $student->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm">
                                            <form
                                                action="{{ route('tenant.classes.removeStudent', [$class, $student]) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to remove this student from the class?')"
                                                    class="inline-flex items-center font-medium text-red-600 transition-colors duration-200 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                    <i class="fas fa-user-minus mr-1"></i>
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <i
                                                    class="fas fa-users mb-3 text-4xl text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
                                                <h3
                                                    class="mb-2 text-lg font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                                    No students enrolled</h3>
                                                <p
                                                    class="mb-4 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                                    This class doesn't have any students yet.
                                                </p>
                                                @if ($availableStudents->count() > 0)
                                                    <button onclick="toggleAddStudentForm()"
                                                        class="inline-flex items-center font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                                        <i class="fas fa-plus mr-2"></i>
                                                        Add some students
                                                    </button>
                                                @else
                                                    <span
                                                        class="mt-2 block text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">All
                                                        available students are already enrolled in other classes.</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-8">
                    <div class="mb-4 flex items-center justify-between">
                        <h3
                            class="flex items-center text-lg font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-ticket-alt mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Review Tickets
                        </h3>
                    </div>
                    <div
                        class="overflow-hidden rounded-lg border border-[color:var(--color-brunswick-green)] shadow-lg dark:border-[color:var(--color-light-brunswick-green)]">
                        <table
                            class="min-w-full divide-y divide-[color:var(--color-brunswick-green)] dark:divide-[color:var(--color-light-brunswick-green)]">
                            <thead
                                class="bg-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        <i class="fas fa-ticket-alt mr-2"></i>
                                        Title
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        <i class="fas fa-user mr-2"></i>
                                        Pending
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Busy
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        <i class="fas fa-calendar mr-2"></i>
                                        Completed
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        <i class="fas fa-cogs mr-2"></i>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                class="divide-y divide-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                                @forelse ($reviewTickets as $ticket)
                                    <tr
                                        class="transition-colors duration-200 hover:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-castleton-green)]">
                                        <td
                                            class="whitespace-nowrap px-6 py-4 text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                            {{ $ticket->title }}
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                            {{-- Count all pending for each review ticket in the class --}}
                                            {{ $ticket->where('status', 'pending')->count() }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm">
                                            {{ $ticket->where('status', 'in_review')->count() }}
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-6 py-4 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                            {{ $ticket->where('status', 'completed')->count() }}
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4 text-sm">
                                            <a href="{{ route('tenant.review-tickets.show', $ticket) }}"
                                                class="inline-flex items-center font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                                <i class="fas fa-eye mr-1"></i>
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <i
                                                    class="fas fa-ticket-alt mb-3 text-4xl text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
                                                <h3
                                                    class="mb-2 text-lg font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                                    No review tickets found</h3>
                                                <p
                                                    class="mb-4 text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                                    There are currently no review tickets for this class.
                                                </p>
                                                <a href="{{ route('tenant.review-tickets.create', ['class_id' => $class->id]) }}"
                                                    class="inline-flex cursor-pointer items-center font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                                    <i class="fas fa-plus mr-2"></i>
                                                    Create a review ticket
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="mt-6 flex flex-row justify-end space-x-4">
                    <a href="{{ route('tenant.classes') }}"
                        class="inline-flex items-center rounded-md border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] transition-all duration-200 hover:bg-[color:var(--color-light-castleton-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-castleton-green)]">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Classes
                    </a>
                    <a href="{{ route('tenant.classes.edit', $class) }}"
                        class="inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white transition-all duration-200 hover:bg-[color:var(--color-dark-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-light-dark-green)]">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Class
                    </a>
                </div>
            </div>
        </div>

        <script>
            function toggleAddStudentForm() {
                const form = document.getElementById('addStudentForm');
                if (form.classList.contains('hidden')) {
                    form.classList.remove('hidden');
                } else {
                    form.classList.add('hidden');
                    // Reset form when hiding
                    document.getElementById('student_id').value = '';
                }
            }
        </script>
</x-tenant-dash-component>
