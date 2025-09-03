<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Teacher Details') }}
            </h2>
            <a href="{{ route('tenant.teachers') }}" class="text-blue-600 hover:underline dark:text-blue-400">&larr; Back
                to
                Teachers</a>
        </div>
    </x-slot>

    <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="rounded-lg bg-white p-6 shadow-xs dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-gray-100">Teacher Information</h3>
            <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Name</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">{{ $teacher->name }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">{{ $teacher->email }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Subject</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">{{ $teacher->subject }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Phone</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">
                        {{ $teacher->phone ?? 'Not provided' }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Address</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">
                        {{ $teacher->address ?? 'Not provided' }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Hire Date</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">
                        {{ \Carbon\Carbon::parse($teacher->hire_date)->format('F j, Y') }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Status</dt>
                    <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">
                        <span
                            class="@if ($teacher->is_active) bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif inline-flex rounded-full px-2 py-1 text-xs font-semibold">
                            {{ $teacher->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </dd>
                </div>
                @if ($teacher->bio)
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Bio</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">{{ $teacher->bio }}
                        </dd>
                    </div>
                @endif
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Created At</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">
                        {{ $teacher->created_at->format('F j, Y \a\t g:i A') }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Updated At</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">
                        {{ $teacher->updated_at->format('F j, Y \a\t g:i A') }}</dd>
                </div>
            </dl>

            @if ($teacher->user)
                <h3 class="mb-4 mt-8 text-lg font-medium text-gray-900 dark:text-gray-100">Account Information</h3>
                <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">User Role</dt>
                        <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">
                            @php $role = $teacher->user->getRoleNames()->join(', '); @endphp
                            <span
                                class="@if ($role === 'tenant_admin') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                                    @elseif ($role === 'teacher') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                    @elseif ($role === 'student') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                    @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 @endif inline-flex rounded-full px-2 py-1 text-xs font-semibold">
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
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Account Created</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">
                            {{ $teacher->user->created_at->format('F j, Y \a\t g:i A') }}
                        </dd>
                    </div>
                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Last Login</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">
                            {{ $teacher->user->last_login_at ? $teacher->user->last_login_at->format('F j, Y \a\t g:i A') : 'Never' }}
                        </dd>
                    </div>
                </dl>
            @endif
            <div class="mt-6 flex flex-row justify-end space-x-4">
                <a href="{{ route('tenant.teachers') }}"
                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-xs hover:bg-gray-50 focus:outline-hidden focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                    Back to Teachers
                </a>
                <a href="{{ route('tenant.teachers.edit', $teacher) }}"
                    class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-xs hover:bg-blue-700 focus:outline-hidden focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Edit Teacher
                </a>
            </div>
        </div>
    </div>
</x-tenant-dash-component>
