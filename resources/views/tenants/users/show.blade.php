<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('User Details') }}
            </h2>
            <a href="{{ route('tenant.users') }}" class="text-blue-600 hover:underline dark:text-blue-400">&larr; Back to
                Users</a>
        </div>
    </x-slot>

    <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="rounded-lg bg-white p-6 shadow-sm dark:bg-gray-800">
            <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-gray-100">User Information</h3>
            <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Name</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">{{ $user->name }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Email</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">{{ $user->email }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Role</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">
                        @php $role = $user->getRoleNames()->join(', '); @endphp
                        @if ($role === 'tenant_admin')
                            Tenant Admin
                        @elseif ($role === 'teacher')
                            Teacher
                        @elseif ($role === 'student')
                            Student
                        @else
                            {{ $role }}
                        @endif
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Created At</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">
                        {{ $user->created_at->format('Y-m-d H:i') }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Updated At</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:col-span-2 sm:mt-0">
                        {{ $user->updated_at->format('Y-m-d H:i') }}</dd>
                </div>
            </dl>
            <h3 class="my-4 text-lg font-medium text-gray-900 dark:text-gray-100">Teacher Information</h3>
            <div>
                @if ($user->roles->pluck('name')->contains('teacher'))
                    <p><strong>Name:</strong> {{ $user->teacher->name }}</p>
                    <p><strong>Subject:</strong> {{ $user->teacher->subject }}</p>
                    <p><strong>Bio:</strong> {{ $user->teacher->bio }}</p>
                    <p><strong>Email:</strong> {{ $user->teacher->email }}</p>
                    <p><strong>Contact:</strong> {{ $user->teacher->phone }}</p>
                    <p><strong>Address:</strong> {{ $user->teacher->address }}</p>
                @else
                    <p>No teacher information available.</p>
                @endif
            </div>
            <div class="mt-4 flex space-x-4 flex-row justify-end">
                <x-secondary-button>
                    Back to Dashboard
                </x-secondary-button>
                <x-primary-button onclick="location.href='{{ route('tenant.users.edit', $user) }}'">
                    Edit User
                </x-primary-button>
            </div>
        </div>
    </div>
</x-tenant-dash-component>
