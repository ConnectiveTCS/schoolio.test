<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="flex items-center text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                <i
                    class="fas fa-bullhorn mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                {{ __('Announcements') }}
            </h2>
        </div>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        @if ($announcements->count() > 0)
            <div class="space-y-6">
                @foreach ($announcements as $announcement)
                    <div
                        class="overflow-hidden rounded-lg bg-[color:var(--color-light-castleton-green)] shadow-sm ring-1 ring-[color:var(--color-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-castleton-green)] dark:ring-[color:var(--color-light-brunswick-green)]">
                        <div class="px-6 py-6">
                            <!-- Header -->
                            <div class="mb-4 flex items-start justify-between">
                                <div class="flex-1">
                                    <h3
                                        class="flex items-center text-lg font-semibold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        <i
                                            class="fas fa-newspaper mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                        {{ $announcement->title }}
                                    </h3>
                                    <div
                                        class="mt-1 flex flex-wrap items-center gap-3 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                        <span class="flex items-center">
                                            <i class="fas fa-user mr-1"></i>
                                            By {{ $announcement->creator->name }}
                                        </span>
                                        <span>•</span>
                                        <span class="flex items-center">
                                            <i class="fas fa-calendar mr-1"></i>
                                            {{ $announcement->created_at->format('M d, Y g:i A') }}
                                        </span>
                                        @if ($announcement->expires_at && !$announcement->expires_at->isPast())
                                            <span>•</span>
                                            <span
                                                class="flex items-center text-[color:var(--color-brunswick-green)] transition-colors duration-200 dark:text-[color:var(--color-light-brunswick-green)]">
                                                <i class="fas fa-clock mr-1"></i>
                                                Expires: {{ $announcement->expires_at->format('M d, Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    @if ($announcement->expires_at && $announcement->expires_at->isPast())
                                        <span
                                            class="inline-flex items-center rounded-full bg-[color:var(--color-light-brunswick-green)] px-2.5 py-0.5 text-xs font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)]">
                                            <i class="fas fa-clock mr-1"></i>
                                            Expired
                                        </span>
                                    @endif
                                    <span
                                        class="inline-flex items-center rounded-full bg-[color:var(--color-light-castleton-green)] px-2.5 py-0.5 text-xs font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        <i class="fas fa-star mr-1"></i>
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

                                            $roleIcons = [
                                                'tenant_admin' => 'fa-crown',
                                                'teacher' => 'fa-chalkboard-teacher',
                                                'student' => 'fa-graduation-cap',
                                                'parent' => 'fa-users',
                                                'admin' => 'fa-user-shield',
                                                'multi_admin' => 'fa-user-cog',
                                            ];
                                            $roleIcon = $roleIcons[$role] ?? 'fa-user';
                                        @endphp
                                        <span
                                            class="inline-flex items-center rounded-full bg-[color:var(--color-light-brunswick-green)] px-2 py-0.5 text-xs font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)]">
                                            <i class="fas {{ $roleIcon }} mr-1"></i>
                                            {{ $roleLabel }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="mb-4">
                                <div
                                    class="leading-relaxed text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    @if (strlen($announcement->content) > 300)
                                        <div class="announcement-content-{{ $announcement->id }}">
                                            <div class="preview">
                                                {{ Str::limit($announcement->content, 300) }}
                                                <button type="button" onclick="toggleContent({{ $announcement->id }})"
                                                    class="ml-2 inline-flex items-center text-sm font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                                    <i class="fas fa-chevron-down mr-1"></i>
                                                    Read more
                                                </button>
                                            </div>
                                            <div class="full-content hidden">
                                                <div class="whitespace-pre-wrap">{{ $announcement->content }}</div>
                                                <button type="button" onclick="toggleContent({{ $announcement->id }})"
                                                    class="mt-2 inline-flex items-center text-sm font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                                    <i class="fas fa-chevron-up mr-1"></i>
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
                                    <h4
                                        class="mb-2 flex items-center text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        <i class="fas fa-paperclip mr-2"></i>
                                        Attachments
                                    </h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($announcement->attachments as $attachment)
                                            <a href="{{ route('tenant.announcements.download', [$announcement, $attachment['filename']]) }}"
                                                class="inline-flex items-center rounded-full bg-[color:var(--color-light-castleton-green)] px-3 py-1 text-xs font-medium text-[color:var(--color-dark-green)] transition-all duration-200 hover:bg-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-light-castleton-green)]">
                                                <i class="fas fa-download mr-1 h-3 w-3"></i>
                                                {{ $attachment['original_name'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Actions -->
                            <div class="flex items-center justify-end">
                                <a href="{{ route('tenant.announcements.show', $announcement) }}"
                                    class="inline-flex items-center text-sm font-medium text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                    <i class="fas fa-eye mr-1"></i>
                                    View Full Announcement
                                    <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="py-12 text-center">
                <div
                    class="mx-auto h-12 w-12 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    <i class="fas fa-bullhorn text-4xl"></i>
                </div>
                <h3
                    class="mt-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                    No announcements</h3>
                <p
                    class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    There are no announcements for your role at
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
