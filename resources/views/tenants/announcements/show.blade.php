<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] flex items-center transition-colors duration-200">
                <i class="fas fa-eye mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                {{ __('Announcement Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <div
            class="overflow-hidden rounded-lg bg-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)] shadow-sm ring-1 ring-[color:var(--color-brunswick-green)] dark:ring-[color:var(--color-light-brunswick-green)] transition-colors duration-200">
            <div class="px-6 py-8">
                <!-- Header -->
                <div class="mb-8 border-b border-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-light-brunswick-green)] pb-6 transition-colors duration-200">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h1 class="text-2xl font-bold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] flex items-center transition-colors duration-200">
                                <i class="fas fa-newspaper mr-3 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                {{ $announcement->title }}
                            </h1>
                            <div
                                class="mt-2 flex flex-wrap items-center gap-4 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] transition-colors duration-200">
                                <span class="flex items-center">
                                    <i class="fas fa-user mr-1"></i>
                                    Created by {{ $announcement->creator->name }}
                                </span>
                                <span>•</span>
                                <span class="flex items-center">
                                    <i class="fas fa-calendar mr-1"></i>
                                    {{ $announcement->created_at->format('M d, Y g:i A') }}
                                </span>
                                @if ($announcement->expires_at)
                                    <span>•</span>
                                    <span
                                        class="{{ $announcement->expires_at->isPast() ? 'text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]' : 'text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]' }} flex items-center transition-colors duration-200">
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ $announcement->expires_at->isPast() ? 'Expired' : 'Expires' }}:
                                        {{ $announcement->expires_at->format('M d, Y g:i A') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span
                                class="{{ $announcement->is_active
                                    ? 'bg-[color:var(--color-light-castleton-green)] text-[color:var(--color-dark-green)] dark:bg-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-dark-green)]'
                                    : 'bg-[color:var(--color-light-brunswick-green)] text-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-gunmetal)]' }} inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-xs font-medium transition-colors duration-200">
                                <div
                                    class="{{ $announcement->is_active ? 'bg-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)]' : 'bg-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-light-gunmetal)]' }} h-1.5 w-1.5 rounded-full">
                                </div>
                                {{ $announcement->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Target Roles -->
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] flex items-center transition-colors duration-200">
                        <i class="fas fa-users mr-2"></i>
                        Target Audience
                    </h3>
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
                                class="inline-flex items-center rounded-full bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] px-2.5 py-0.5 text-xs font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] transition-colors duration-200">
                                <i class="fas {{ $roleIcon }} mr-1"></i>
                                {{ $roleLabel }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Content -->
                <div class="mb-8">
                    <h3 class="mb-3 text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] flex items-center transition-colors duration-200">
                        <i class="fas fa-align-left mr-2"></i>
                        Content
                    </h3>
                    <div class="prose prose-gray dark:prose-invert max-w-none">
                        <div class="whitespace-pre-wrap leading-relaxed text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] transition-colors duration-200 bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] p-4 rounded-lg">
                            {{ $announcement->content }}</div>
                    </div>
                </div>

                <!-- Attachments -->
                @if ($announcement->hasAttachments())
                    <div class="mb-8">
                        <h3 class="mb-3 text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] flex items-center transition-colors duration-200">
                            <i class="fas fa-paperclip mr-2"></i>
                            Attachments
                        </h3>
                        <div class="space-y-4">
                            @foreach ($announcement->attachments as $attachment)
                                @php
                                    $extension = strtolower(
                                        pathinfo($attachment['original_name'], PATHINFO_EXTENSION),
                                    );
                                    $iconClass = match ($extension) {
                                        'pdf' => 'fa-file-pdf',
                                        'doc', 'docx' => 'fa-file-word',
                                        'xls', 'xlsx' => 'fa-file-excel',
                                        'ppt', 'pptx' => 'fa-file-powerpoint',
                                        'jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp' => 'fa-file-image',
                                        'zip', 'rar' => 'fa-file-archive',
                                        'txt' => 'fa-file-alt',
                                        default => 'fa-file',
                                    };
                                    $iconColor = match ($extension) {
                                        'pdf' => 'text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]',
                                        'doc', 'docx' => 'text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]',
                                        'xls', 'xlsx' => 'text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]',
                                        'ppt', 'pptx' => 'text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]',
                                        'jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp' => 'text-[color:var(--color-prussian-blue)] dark:text-[color:var(--color-light-prussian-blue)]',
                                        'zip', 'rar' => 'text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]',
                                        default => 'text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]',
                                    };
                                    
                                    $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                                    $isIframeSupported = in_array($extension, ['pdf']);
                                    $attachmentPath = asset('storage/tenant' . tenant('id') . '/announcements/' . $attachment['filename']);
                                @endphp
                                
                                <div class="rounded-lg bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] p-4 transition-colors duration-200">
                                    <!-- Attachment Header -->
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center space-x-3">
                                            <div class="shrink-0">
                                                <i class="fas {{ $iconClass }} {{ $iconColor }} text-2xl"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] transition-colors duration-200">
                                                    {{ $attachment['original_name'] }}</p>
                                                <p class="text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] transition-colors duration-200">
                                                    {{ $announcement->formatFileSize($attachment['size']) }}</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('tenant.announcements.download', [$announcement, $attachment['filename']]) }}"
                                            class="inline-flex items-center rounded-md border border-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)] px-3 py-2 text-sm font-medium leading-4 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)] shadow-xs hover:bg-[color:var(--color-castleton-green)] dark:hover:bg-[color:var(--color-light-castleton-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2 transition-all duration-200">
                                            <i class="fas fa-download mr-2 h-4 w-4"></i>
                                            Download
                                        </a>
                                    </div>
                                    
                                    <!-- Image Preview -->
                                    @if ($isImage)
                                        <div class="mt-3">
                                            <img src="{{ $attachmentPath }}" 
                                                 alt="{{ $attachment['original_name'] }}" 
                                                 class="max-w-full h-auto rounded-lg border border-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-light-brunswick-green)] shadow-sm cursor-pointer hover:shadow-md transition-shadow duration-200"
                                                 onclick="openImageModal('{{ $attachmentPath }}', '{{ $attachment['original_name'] }}')"
                                                 style="max-height: 400px; object-fit: contain;">
                                        </div>
                                    @endif
                                    
                                    <!-- Document Preview (PDF) -->
                                    @if ($isIframeSupported)
                                        <div class="mt-3">
                                            <div class="bg-[color:var(--color-light-castleton-green)] dark:bg-[color:var(--color-castleton-green)] rounded-lg p-2 transition-colors duration-200">
                                                <iframe src="{{ $attachmentPath }}" 
                                                        class="w-full rounded border border-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-light-brunswick-green)]" 
                                                        style="height: 500px;"
                                                        title="{{ $attachment['original_name'] }}">
                                                    <p class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] p-4">
                                                        Your browser does not support PDFs. 
                                                        <a href="{{ route('tenant.announcements.download', [$announcement, $attachment['filename']]) }}" 
                                                           class="text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)] hover:underline">
                                                            Download the PDF
                                                        </a>
                                                    </p>
                                                </iframe>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex items-center justify-between border-t border-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-light-brunswick-green)] pt-6 transition-colors duration-200">
                    <a href="{{ url()->previous() }}"
                        class="inline-flex items-center rounded-md border border-[color:var(--color-brunswick-green)] dark:border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)] px-4 py-2 text-xs font-semibold uppercase tracking-widest text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] shadow-xs transition-all duration-200 hover:bg-[color:var(--color-brunswick-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back
                    </a>

                    @can('edit announcements')
                        <div class="flex items-center gap-3">
                            <a href="{{ route('tenant.announcements.edit', $announcement) }}"
                                class="inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-light-castleton-green)] px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition-all duration-200 hover:bg-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-dark-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Announcement
                            </a>
                            @can('delete announcements')
                                <form action="{{ route('tenant.announcements.destroy', $announcement) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this announcement?')"
                                        class="inline-flex items-center rounded-md bg-[color:var(--color-gunmetal)] dark:bg-[color:var(--color-light-gunmetal)] px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition-all duration-200 hover:bg-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-dark-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-prussian-blue)] focus:ring-offset-2">
                                        <i class="fas fa-trash mr-2"></i>
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

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-75" onclick="closeImageModal()">
        <div class="relative max-w-4xl max-h-full p-4">
            <button onclick="closeImageModal()" class="absolute top-2 right-2 text-white hover:text-gray-300 z-10">
                <i class="fas fa-times text-2xl"></i>
            </button>
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full rounded-lg shadow-lg">
        </div>
    </div>

    <script>
        function openImageModal(imageSrc, imageAlt) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            
            modalImage.src = imageSrc;
            modalImage.alt = imageAlt;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            
            // Restore body scroll
            document.body.style.overflow = 'auto';
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
</x-tenant-dash-component>
