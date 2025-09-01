<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Announcement Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <div
            class="overflow-hidden rounded-lg bg-white shadow ring-1 ring-black ring-opacity-5 dark:bg-gray-800 dark:ring-gray-700">
            <div class="px-6 py-8">
                <!-- Header -->
                <div class="mb-8 border-b border-gray-200 pb-6 dark:border-gray-700">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $announcement->title }}</h1>
                            <div
                                class="mt-2 flex flex-wrap items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                                <span>Created by {{ $announcement->creator->name }}</span>
                                <span>•</span>
                                <span>{{ $announcement->created_at->format('M d, Y g:i A') }}</span>
                                @if ($announcement->expires_at)
                                    <span>•</span>
                                    <span
                                        class="{{ $announcement->expires_at->isPast() ? 'text-red-600 dark:text-red-400' : 'text-amber-600 dark:text-amber-400' }}">
                                        {{ $announcement->expires_at->isPast() ? 'Expired' : 'Expires' }}:
                                        {{ $announcement->expires_at->format('M d, Y g:i A') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span
                                class="{{ $announcement->is_active
                                    ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                                    : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }} inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-xs font-medium">
                                <div
                                    class="{{ $announcement->is_active ? 'bg-green-500' : 'bg-red-500' }} h-1.5 w-1.5 rounded-full">
                                </div>
                                {{ $announcement->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Target Roles -->
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-900 dark:text-white">Target Audience</h3>
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach ($announcement->target_roles as $role)
                            @php
                                $roleLabels = [
                                    'tenant_admin' => 'Tenant Admin',
                                    'teacher' => 'Teacher',
                                    'student' => 'Student',
                                    'parent' => 'Parent',
                                    'admin' => 'System Admin',
                                    'multi_admin' => 'Multi Admin',
                                ];
                                $roleLabel = $roleLabels[$role] ?? ucfirst(str_replace('_', ' ', $role));
                            @endphp
                            <span
                                class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                {{ $roleLabel }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Content -->
                <div class="mb-8">
                    <h3 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Content</h3>
                    <div class="prose prose-gray dark:prose-invert max-w-none">
                        <div class="whitespace-pre-wrap leading-relaxed text-gray-700 dark:text-gray-300">
                            {{ $announcement->content }}</div>
                    </div>
                </div>

                <!-- Attachments -->
                @if ($announcement->hasAttachments())
                    <div class="mb-8">
                        <h3 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Attachments</h3>
                        <div class="space-y-3">
                            @foreach ($announcement->attachments as $attachment)
                                <div
                                    class="flex items-center justify-between rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0">
                                            @php
                                                $extension = strtolower(
                                                    pathinfo($attachment['original_name'], PATHINFO_EXTENSION),
                                                );
                                                $iconColor = match ($extension) {
                                                    'pdf' => 'text-red-600',
                                                    'doc', 'docx' => 'text-blue-600',
                                                    'xls', 'xlsx' => 'text-green-600',
                                                    'ppt', 'pptx' => 'text-orange-600',
                                                    'jpg', 'jpeg', 'png', 'gif' => 'text-purple-600',
                                                    'zip', 'rar' => 'text-yellow-600',
                                                    default => 'text-gray-600',
                                                };
                                            @endphp
                                            <svg class="{{ $iconColor }} h-8 w-8" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $attachment['original_name'] }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $announcement->formatFileSize($attachment['size']) }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('tenant.announcements.download', [$announcement, $attachment['filename']]) }}"
                                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        Download
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex items-center justify-between border-t border-gray-200 pt-6 dark:border-gray-700">
                    <a href="{{ url()->previous() }}"
                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800">
                        Back
                    </a>

                    @can('edit announcements')
                        <div class="flex items-center gap-3">
                            <a href="{{ route('tenant.announcements.edit', $announcement) }}"
                                class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                Edit Announcement
                            </a>
                            @can('delete announcements')
                                <form action="{{ route('tenant.announcements.destroy', $announcement) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this announcement?')"
                                        class="inline-flex items-center rounded-md bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                        Delete
                                    </button>
                                </form>
                            @endcan
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-tenant-dash-component>
