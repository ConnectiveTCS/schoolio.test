<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="flex items-center text-xl font-semibold leading-tight text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                <i
                    class="fas fa-user-circle mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                {{ __('User Details') }}
            </h2>
            <a href="{{ route('tenant.users') }}"
                class="inline-flex items-center font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-dark-green)]">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Users
            </a>
        </div>
    </x-slot>

    <div
        class="mx-auto max-w-3xl bg-[color:var(--color-light-dark-green)] px-4 py-8 transition-colors duration-200 sm:px-6 lg:px-8 dark:bg-[color:var(--color-dark-green)]">
        <div
            class="rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
            <h3
                class="mb-6 flex items-center text-lg font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                <i
                    class="fas fa-info-circle mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                User Information
            </h3>
            <dl
                class="divide-y divide-[color:var(--color-brunswick-green)] dark:divide-[color:var(--color-light-brunswick-green)]">
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt
                        class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i
                            class="fas fa-user mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        Name
                    </dt>
                    <dd
                        class="mt-1 text-sm text-[color:var(--color-dark-green)] sm:col-span-2 sm:mt-0 dark:text-[color:var(--color-light-dark-green)]">
                        {{ $user->name }}
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
                        {{ $user->email }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt
                        class="flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <i
                            class="fas fa-user-tag mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        Role
                    </dt>
                    <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">
                        @php $role = $user->getRoleNames()->join(', '); @endphp
                        <span
                            class="@if ($role === 'tenant_admin') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                            @elseif ($role === 'teacher') 
                                bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                            @elseif ($role === 'student') 
                                bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                            @else 
                                bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-gunmetal)] @endif inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold transition-colors duration-200">
                            @if ($role === 'tenant_admin')
                                <i class="fas fa-crown mr-1"></i>
                                Tenant Admin
                            @elseif ($role === 'teacher')
                                <i class="fas fa-chalkboard-teacher mr-1"></i>
                                Teacher
                            @elseif ($role === 'student')
                                <i class="fas fa-graduation-cap mr-1"></i>
                                Student
                            @else
                                <i class="fas fa-user mr-1"></i>
                                {{ $role }}
                            @endif
                        </span>
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
                        {{ $user->created_at->format('F j, Y \a\t g:i A') }}</dd>
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
                        {{ $user->updated_at->format('F j, Y \a\t g:i A') }}</dd>
                </div>
            </dl>
            <h3
                class="my-6 flex items-center border-t border-[color:var(--color-brunswick-green)] pt-6 text-lg font-medium text-[color:var(--color-gunmetal)] dark:border-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)]">
                <i
                    class="fas fa-chalkboard-teacher mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                Teacher Information
            </h3>
            <div
                class="rounded-lg bg-[color:var(--color-light-castleton-green)] p-4 transition-colors duration-200 dark:bg-[color:var(--color-castleton-green)]">
                @if ($user->roles->pluck('name')->contains('teacher'))
                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt
                                class="mb-1 flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-user mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                Name
                            </dt>
                            <dd
                                class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                {{ $user->teacher->name }}</dd>
                        </div>
                        <div>
                            <dt
                                class="mb-1 flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-book mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                Subject
                            </dt>
                            <dd
                                class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                {{ $user->teacher->subject ?? 'Not specified' }}</dd>
                        </div>
                        <div>
                            <dt
                                class="mb-1 flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-envelope mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                Email
                            </dt>
                            <dd
                                class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                {{ $user->teacher->email ?? 'Not provided' }}</dd>
                        </div>
                        <div>
                            <dt
                                class="mb-1 flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-phone mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                Contact
                            </dt>
                            <dd
                                class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                {{ $user->teacher->phone ?? 'Not provided' }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt
                                class="mb-1 flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-map-marker-alt mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                Address
                            </dt>
                            <dd
                                class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                {{ $user->teacher->address ?? 'Not provided' }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt
                                class="mb-1 flex items-center text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                <i
                                    class="fas fa-file-alt mr-2 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                Bio
                            </dt>
                            <dd
                                class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                {{ $user->teacher->bio ?? 'No bio available' }}</dd>
                        </div>
                    </dl>
                @else
                    <div class="flex items-center justify-center py-8">
                        <div class="text-center">
                            <i
                                class="fas fa-info-circle mb-3 text-3xl text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
                            <p
                                class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                No teacher information available for this user.</p>
                        </div>
                    </div>
                @endif
            </div>
            <div
                class="mt-6 flex flex-col justify-end space-y-3 border-t border-[color:var(--color-brunswick-green)] pt-6 sm:flex-row sm:space-x-4 sm:space-y-0 dark:border-[color:var(--color-light-brunswick-green)]">
                <a href="{{ route('tenant.users') }}"
                    class="inline-flex items-center justify-center rounded-md border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] px-4 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] transition-all duration-200 hover:bg-[color:var(--color-light-castleton-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-castleton-green)]">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Users
                </a>
                <a href="{{ route('tenant.users.edit', $user) }}"
                    class="inline-flex items-center justify-center rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white transition-all duration-200 hover:bg-[color:var(--color-dark-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-light-dark-green)]">
                    <i class="fas fa-edit mr-2"></i>
                    Edit User
                </a>
            </div>
        </div>
    </div>
</x-tenant-dash-component>
