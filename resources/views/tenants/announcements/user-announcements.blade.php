<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Announcements') }}
            </h2>
        </div>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        @if ($announcements->count() > 0)
            <div class="space-y-6">
                @foreach ($announcements as $announcement)
                    <div
                        class="overflow-hidden rounded-lg bg-white shadow ring-1 ring-black ring-opacity-5 dark:bg-gray-800 dark:ring-gray-700">
                        <div class="px-6 py-6">
                            <!-- Header -->
                            <div class="mb-4 flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $announcement->title }}
                                    </h3>
                                    <div
                                        class="mt-1 flex flex-wrap items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                                        <span>By {{ $announcement->creator->name }}</span>
                                        <span>•</span>
                                        <span>{{ $announcement->created_at->format('M d, Y g:i A') }}</span>
                                        @if ($announcement->expires_at && !$announcement->expires_at->isPast())
                                            <span>•</span>
                                            <span class="text-amber-600 dark:text-amber-400">
                                                Expires: {{ $announcement->expires_at->format('M d, Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    @if ($announcement->expires_at && $announcement->expires_at->isPast())
                                        <span
                                            class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-200">
                                            Expired
                                        </span>
                                    @endif
                                    <span
                                        class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        New
                                    </span>
                                </div>
                            </div>

                            <!-- Target Roles -->
                            <div class="mb-4">
                                <div class="flex flex-wrap gap-1">
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
                                            class="inline-flex items-center rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                            {{ $roleLabel }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="mb-4">
                                <div class="leading-relaxed text-gray-700 dark:text-gray-300">
                                    @if (strlen($announcement->content) > 300)
                                        <div class="announcement-content-{{ $announcement->id }}">
                                            <div class="preview">
                                                {{ Str::limit($announcement->content, 300) }}
                                                <button type="button" onclick="toggleContent({{ $announcement->id }})"
                                                    class="ml-2 text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                    Read more
                                                </button>
                                            </div>
                                            <div class="full-content hidden">
                                                <div class="whitespace-pre-wrap">{{ $announcement->content }}</div>
                                                <button type="button" onclick="toggleContent({{ $announcement->id }})"
                                                    class="mt-2 text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                    Show less
                                                </button>
                                            </div>
                                        </div>
                                    @else
                                        <div class="whitespace-pre-wrap">{{ $announcement->content }}</div>
                                    @endif
                                </div>
                            </div>

                            <!-- Attachments -->
                            @if ($announcement->hasAttachments())
                                <div class="mb-4">
                                    <h4 class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Attachments</h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($announcement->attachments as $attachment)
                                            <a href="{{ route('tenant.announcements.download', [$announcement, $attachment['filename']]) }}"
                                                class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-800 hover:bg-blue-200 dark:bg-blue-900 dark:text-blue-200 dark:hover:bg-blue-800">
                                                <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                    </path>
                                                </svg>
                                                {{ $attachment['original_name'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Actions -->
                            <div class="flex items-center justify-end">
                                <a href="{{ route('tenant.announcements.show', $announcement) }}"
                                    class="text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                    View Full Announcement →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="py-12 text-center">
                <div class="mx-auto h-12 w-12 text-gray-400">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10m0 0V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2m0 0v8a2 2 0 002 2h6a2 2 0 002-2V8m-9 4h4">
                        </path>
                    </svg>
                </div>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No announcements</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">There are no announcements for your role at
                    this time.</p>
            </div>
        @endif
    </div>

    <script>
        function toggleContent(announcementId) {
            const container = document.querySelector(`.announcement-content-${announcementId}`);
            const preview = container.querySelector('.preview');
            const fullContent = container.querySelector('.full-content');

            preview.classList.toggle('hidden');
            fullContent.classList.toggle('hidden');
        }
    </script>
</x-tenant-dash-component>
