<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2
                class="flex items-center text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                <i
                    class="fas fa-bullhorn mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                {{ __('Manage Announcements') }}
            </h2>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <!-- Session Status -->
        <x-auth-session-status class="mb-6" :status="session('status')" />

        <!-- Success Message -->
        @if (session('success'))
            <div
                class="mb-6 rounded-lg border border-[color:var(--color-castleton-green)] bg-[color:var(--color-light-castleton-green)] p-4 text-[color:var(--color-dark-green)] transition-colors duration-200 dark:border-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]">
                <div class="flex items-center">
                    <i
                        class="fas fa-check-circle mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Header Actions -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h3
                    class="flex items-center text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                    <i
                        class="fas fa-list mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                    All Announcements
                </h3>
                <p
                    class="text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                    <i
                        class="fas fa-info-circle mr-1 text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
                    {{ $announcements->total() }} total announcements
                </p>
            </div>
            @can('create announcements')
                <a href="{{ route('tenant.announcements.create') }}"
                    class="shadow-xs inline-flex items-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-2.5 text-sm font-semibold text-white transition-all duration-200 hover:bg-[color:var(--color-dark-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-light-dark-green)]">
                    <i class="fas fa-plus h-4 w-4"></i>
                    {{ __('Create Announcement') }}
                </a>
            @endcan
        </div>

        <!-- Table Container -->
        <div
            class="overflow-hidden rounded-lg bg-[color:var(--color-light-castleton-green)] shadow-sm ring-1 ring-[color:var(--color-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-castleton-green)] dark:ring-[color:var(--color-light-brunswick-green)]">
            @if ($announcements->count() > 0)
                <table
                    class="min-w-full divide-y divide-[color:var(--color-brunswick-green)] dark:divide-[color:var(--color-light-brunswick-green)]">
                    <thead
                        class="bg-[color:var(--color-light-brunswick-green)] transition-colors duration-200 dark:bg-[color:var(--color-brunswick-green)]">
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i class="fas fa-heading mr-2"></i>Title
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i class="fas fa-users mr-2"></i>Target Roles
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i class="fas fa-user mr-2"></i>Created By
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i class="fas fa-toggle-on mr-2"></i>Status
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                <i class="fas fa-calendar mr-2"></i>Created
                            </th>
                            <th class="relative px-6 py-4">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="divide-y divide-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-castleton-green)] transition-colors duration-200 dark:divide-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                        @foreach ($announcements as $announcement)
                            <tr
                                class="transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-brunswick-green)]">
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                                {{ $announcement->title }}
                                            </div>
                                            @if ($announcement->hasAttachments())
                                                <div class="flex items-center">
                                                    <i
                                                        class="fas fa-paperclip h-4 w-4 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"></i>
                                                    <span
                                                        class="ml-1 text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">{{ $announcement->attachment_count }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        @if ($announcement->expires_at)
                                            <div
                                                class="flex items-center text-xs text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                                <i class="fas fa-clock mr-1"></i>
                                                Expires: {{ $announcement->expires_at->format('M d, Y g:i A') }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-sm text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $announcement->formatted_target_roles }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-sm text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                                        {{ $announcement->creator->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('tenant.announcements.toggle-status', $announcement) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="{{ $announcement->is_active
                                                ? 'bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] hover:bg-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)] dark:hover:bg-[color:var(--color-light-castleton-green)]'
                                                : 'bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-gunmetal)] hover:bg-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-light-brunswick-green)]' }} inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-xs font-medium transition-all duration-200">
                                            <div
                                                class="{{ $announcement->is_active ? 'bg-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)]' : 'bg-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-light-gunmetal)]' }} h-1.5 w-1.5 rounded-full">
                                            </div>
                                            {{ $announcement->is_active ? 'Active' : 'Inactive' }}
                                        </button>
                                    </form>
                                </td>
                                <td
                                    class="px-6 py-4 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                                    {{ $announcement->created_at->format('M d, Y') }}
                                </td>
                                <td class="relative px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('tenant.announcements.show', $announcement) }}"
                                            class="inline-flex items-center text-[color:var(--color-castleton-green)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                            <i class="fas fa-eye mr-1"></i>View
                                        </a>
                                        @can('edit announcements')
                                            <a href="{{ route('tenant.announcements.edit', $announcement) }}"
                                                class="inline-flex items-center text-[color:var(--color-brunswick-green)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-brunswick-green)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                                <i class="fas fa-edit mr-1"></i>Edit
                                            </a>
                                        @endcan
                                        @can('delete announcements')
                                            <form action="{{ route('tenant.announcements.destroy', $announcement) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this announcement?')"
                                                    class="inline-flex items-center text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:text-[color:var(--color-light-dark-green)]">
                                                    <i class="fas fa-trash mr-1"></i>Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-8 text-center">
                    <div
                        class="mx-auto h-12 w-12 text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        <i class="fas fa-bullhorn text-4xl"></i>
                    </div>
                    <h3
                        class="mt-2 text-sm font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        No announcements</h3>
                    <p
                        class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                        Get started by creating a new announcement.
                    </p>
                    @can('create announcements')
                        <div class="mt-6">
                            <a href="{{ route('tenant.announcements.create') }}"
                                class="shadow-xs inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-3 py-2 text-sm font-semibold text-white transition-all duration-200 hover:bg-[color:var(--color-dark-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-light-dark-green)]">
                                <i class="fas fa-plus mr-2"></i>
                                Create Announcement
                            </a>
                        </div>
                    @endcan
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if ($announcements->hasPages())
            <div class="mt-6">
                {{ $announcements->links() }}
            </div>
        @endif
    </div>
</x-tenant-dash-component>
