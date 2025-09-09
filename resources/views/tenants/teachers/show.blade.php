<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <i
                    class="fas fa-user-tie mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                <h2
                    class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    {{ __('Teacher Details') }}
                </h2>
            </div>
            <a href="{{ route('tenant.teachers') }}"
                class="inline-flex items-center text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                <i class="fas fa-arrow-left mr-2"></i>Back to Teachers
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen transition-colors duration-200">
        <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-6 shadow-sm transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-dark-green)]">
                <div class="mb-4 flex items-center">
                    <i
                        class="fas fa-info-circle mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                    <h3
                        class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        Teacher Information</h3>
                </div>
                <dl
                    class="divide-y divide-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-castleton-green)]">
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-user mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Name
                        </dt>
                        <dd
                            class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $teacher->name }}
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-envelope mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Email
                        </dt>
                        <dd
                            class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $teacher->email }}
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
                            {{ $teacher->subject }}
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-phone mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Phone
                        </dt>
                        <dd
                            class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $teacher->phone ?? 'Not provided' }}
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-map-marker-alt mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Address
                        </dt>
                        <dd
                            class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $teacher->address ?? 'Not provided' }}
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-calendar-plus mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Hire Date
                        </dt>
                        <dd
                            class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                            {{ \Carbon\Carbon::parse($teacher->hire_date)->format('F j, Y') }}
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
                                class="@if ($teacher->is_active) bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold transition-colors duration-200">
                                <i
                                    class="@if ($teacher->is_active) fas fa-check-circle @else fas fa-times-circle @endif mr-1"></i>
                                {{ $teacher->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </dd>
                    </div>
                    @if ($teacher->bio)
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt
                                class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-file-alt mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                Bio
                            </dt>
                            <dd
                                class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                                {{ $teacher->bio }}
                            </dd>
                        </div>
                    @endif
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt
                            class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            <i
                                class="fas fa-calendar-plus mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                            Created At
                        </dt>
                        <dd
                            class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                            {{ $teacher->created_at->format('F j, Y \a\t g:i A') }}</dd>
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
                            {{ $teacher->updated_at->format('F j, Y \a\t g:i A') }}</dd>
                    </div>
                </dl>

                @if ($teacher->user)
                    <div class="mb-4 mt-8 flex items-center">
                        <i
                            class="fas fa-user-shield mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        <h3
                            class="text-lg font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Account Information</h3>
                    </div>
                    <dl
                        class="divide-y divide-[color:var(--color-light-brunswick-green)] dark:divide-[color:var(--color-castleton-green)]">
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt
                                class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-user-tag mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                User Role
                            </dt>
                            <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">
                                @php $role = $teacher->user->getRoleNames()->join(', '); @endphp
                                <span
                                    class="@if ($role === 'tenant_admin') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                                    @elseif ($role === 'teacher') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                    @elseif ($role === 'student') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                    @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 @endif inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold transition-colors duration-200">
                                    <i
                                        class="@if ($role === 'tenant_admin') fas fa-crown
                                    @elseif ($role === 'teacher') fas fa-chalkboard-teacher
                                    @elseif ($role === 'student') fas fa-graduation-cap
                                    @else fas fa-user @endif mr-1"></i>
                                    @if ($role === 'tenant_admin')
                                        Tenant Admin
                                    @elseif ($role === 'teacher')
                                        Teacher
                                    @elseif ($role === 'student')
                                        Student
                                    @else
                                        {{ $role }}
                                    @endif
                                </span>
                            </dd>
                        </div>
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt
                                class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-user-plus mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                Account Created
                            </dt>
                            <dd
                                class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                                {{ $teacher->user->created_at->format('F j, Y \a\t g:i A') }}
                            </dd>
                        </div>
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt
                                class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-sign-in-alt mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                Last Login
                            </dt>
                            <dd
                                class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                                {{ $teacher->user->last_login_at ? $teacher->user->last_login_at->format('F j, Y \a\t g:i A') : 'Never' }}
                            </dd>
                        </div>
                    </dl>
                @endif
                <div
                    class="mt-8 flex flex-row justify-end space-x-4 border-t border-[color:var(--color-light-brunswick-green)] pt-6 dark:border-[color:var(--color-castleton-green)]">
                    <a href="{{ route('tenant.teachers') }}"
                        class="inline-flex items-center rounded-md border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] shadow-sm transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Teachers
                    </a>
                    <a href="{{ route('tenant.teachers.edit', $teacher) }}"
                        class="inline-flex items-center rounded-md border border-transparent bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Teacher
                    </a>
                </div>
            </div>
        </div>
</x-tenant-dash-component>
