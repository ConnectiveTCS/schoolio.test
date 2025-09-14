<x-guest-layout>
    <div
        class="flex min-h-screen items-center justify-center bg-[color:var(--color-light-dark-green)] px-4 py-12 transition-colors duration-200 dark:bg-[color:var(--color-dark-green)]">
        <div class="w-full max-w-md">
            <!-- Logo and Header -->
            <div class="mb-8 text-center">
                <div
                    class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900/20">
                    <i class="fas fa-tools text-2xl text-orange-600 dark:text-orange-400"></i>
                </div>
                <h2
                    class="mt-6 text-center text-2xl font-bold text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    Under Maintenance
                </h2>
                <p
                    class="mt-2 text-center text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                    We're making some improvements
                </p>
            </div>

            <!-- Content Card -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 shadow-lg transition-colors duration-200 dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                <!-- Maintenance Message -->
                <div
                    class="mb-6 rounded-lg border border-orange-200 bg-orange-50 p-4 dark:border-orange-800 dark:bg-orange-900/40">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <i class="fas fa-wrench text-orange-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-orange-800 dark:text-orange-200">
                                {{ $message }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Estimated Time -->
                <div
                    class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <div class="text-center">
                        <i
                            class="fas fa-clock mb-3 text-2xl text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        <h3
                            class="mb-2 text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                            Estimated Completion Time
                        </h3>
                        <p
                            class="text-lg font-semibold text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]">
                            {{ $estimated_time }}
                        </p>
                    </div>
                </div>

                <!-- What's Happening -->
                <div
                    class="mb-6 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] p-4 transition-colors duration-200 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                    <h3
                        class="mb-2 flex items-center text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                        <i
                            class="fas fa-cog mr-2 text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                        What we're doing:
                    </h3>
                    <ul
                        class="space-y-1 text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>
                            Updating system components
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>
                            Improving performance
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>
                            Enhancing security
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-arrow-right mr-2 text-xs"></i>
                            Adding new features
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col space-y-3 sm:flex-row sm:space-x-3 sm:space-y-0">
                    <a href="{{ $redirect_url }}"
                        class="shadow-xs inline-flex flex-1 items-center justify-center gap-2 rounded-lg bg-[color:var(--color-castleton-green)] px-4 py-2.5 text-sm font-semibold text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:bg-[color:var(--color-light-castleton-green)] dark:text-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:focus:ring-offset-[color:var(--color-dark-green)]">
                        <i class="fas fa-home h-4 w-4"></i>
                        {{ $redirect_text }}
                    </a>
                    <button onclick="window.location.reload()"
                        class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-dark-green)] px-4 py-2.5 text-sm font-semibold text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-light-brunswick-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-castleton-green)] focus:ring-offset-2 dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)] dark:hover:bg-[color:var(--color-prussian-blue)]">
                        <i class="fas fa-sync-alt h-4 w-4"></i>
                        Check Again
                    </button>
                </div>

                <!-- Progress Indicator -->
                <div class="mt-6">
                    <div
                        class="mb-1 flex items-center justify-between text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        <span>Maintenance Progress</span>
                        <span id="progress-text">Loading...</span>
                    </div>
                    <div
                        class="h-2 w-full rounded-full bg-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-brunswick-green)]">
                        <div id="progress-bar"
                            class="h-2 rounded-full bg-[color:var(--color-castleton-green)] transition-all duration-1000 dark:bg-[color:var(--color-light-castleton-green)]"
                            style="width: 0%"></div>
                    </div>
                </div>

                <!-- Support Contact -->
                <div class="mt-6 text-center">
                    <p class="text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                        Emergency support needed?
                        <a href="mailto:support@schoolio.test"
                            class="font-medium text-[color:var(--color-castleton-green)] hover:text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-castleton-green)] dark:hover:text-[color:var(--color-light-brunswick-green)]">
                            Contact Support
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth fade-in animation
        const card = document.querySelector('.rounded-lg.border');
        if (card) {
            card.style.opacity = '0';
            card.style.transform = 'translateY(10px)';
            card.style.transition = 'all 0.3s ease';

            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        }

        // Simulate progress bar animation
        const progressBar = document.getElementById('progress-bar');
        const progressText = document.getElementById('progress-text');

        let progress = 0;
        const interval = setInterval(() => {
            progress += Math.random() * 2;
            if (progress > 85) progress = 85; // Cap at 85% to show ongoing work

            progressBar.style.width = progress + '%';
            progressText.textContent = Math.round(progress) + '%';

            if (progress >= 85) {
                clearInterval(interval);
                progressText.textContent = 'In Progress...';
            }
        }, 2000);

        // Auto-refresh every 30 seconds
        setTimeout(() => {
            const refreshButton = document.querySelector('button[onclick*="reload"]');
            if (refreshButton) {
                refreshButton.innerHTML =
                    '<i class="fas fa-sync-alt h-4 w-4 animate-spin"></i>Checking...';
                setTimeout(() => window.location.reload(), 1000);
            }
        }, 30000);
    });
</script>
