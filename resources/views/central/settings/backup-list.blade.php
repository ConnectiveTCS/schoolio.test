@extends('central.layout')

@section('title', 'Backup History')

@section('content')
    <div
        class="mx-auto min-h-screen max-w-7xl bg-[color:var(--color-light-dark-green)] px-4 transition-colors duration-200 sm:px-6 lg:px-8 dark:bg-[color:var(--color-dark-green)]">
        <div class="py-6">
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1
                            class="text-2xl font-bold text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                            Backup History</h1>
                        <p
                            class="mt-1 text-sm text-[color:var(--color-gunmetal)] transition-colors duration-200 dark:text-[color:var(--color-light-gunmetal)]">
                            View and manage system backup files.
                        </p>
                    </div>
                    <a href="{{ route('central.settings') }}"
                        class="inline-flex justify-center rounded-md border border-[color:var(--color-brunswick-green)] bg-transparent px-4 py-2 text-sm font-medium text-[color:var(--color-brunswick-green)] shadow-sm transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] hover:text-white focus:outline-none focus:ring-2 focus:ring-[color:var(--color-brunswick-green)] focus:ring-offset-2 dark:border-[color:var(--color-light-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)] dark:hover:text-[color:var(--color-dark-green)]">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Settings
                    </a>
                </div>
            </div>

            @if (session('backup_success'))
                <div class="mb-6 rounded-md bg-green-50 p-4 transition-colors duration-200 dark:bg-green-900/20">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check h-5 w-5 text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p
                                class="text-sm font-medium text-green-800 transition-colors duration-200 dark:text-green-300">
                                {{ session('backup_success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('backup_error'))
                <div class="mb-6 rounded-md bg-red-50 p-4 transition-colors duration-200 dark:bg-red-900/20">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-times h-5 w-5 text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800 transition-colors duration-200 dark:text-red-300">
                                {{ session('backup_error') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Backup Files Table -->
            <div
                class="rounded-lg border border-[color:var(--color-light-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-sm transition-colors duration-200 hover:shadow-md dark:border-[color:var(--color-castleton-green)] dark:bg-[color:var(--color-castleton-green)]">
                <div
                    class="border-b border-[color:var(--color-light-brunswick-green)] px-6 py-4 transition-colors duration-200 dark:border-[color:var(--color-castleton-green)]">
                    <h3
                        class="text-lg font-medium text-[color:var(--color-dark-green)] transition-colors duration-200 dark:text-[color:var(--color-light-dark-green)]">
                        Available Backups</h3>
                </div>
                <div class="px-6 py-4">
                    @if (count($backups) > 0)
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-300">
                                            File Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-300">
                                            Date Created
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-300">
                                            File Size
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-300">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                                    @foreach ($backups as $backup)
                                        <tr>
                                            <td
                                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                                {{ $backup['name'] }}
                                            </td>
                                            <td
                                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
                                                {{ date('Y-m-d H:i:s', $backup['date']) }}
                                            </td>
                                            <td
                                                class="whitespace-nowrap px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
                                                {{ number_format($backup['size'] / 1024 / 1024, 2) }} MB
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                                <a href="{{ asset('storage/backups/' . $backup['name']) }}" download
                                                    class="text-[color:var(--color-brunswick-green)] hover:text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-brunswick-green)] dark:hover:text-[color:var(--color-brunswick-green)]">
                                                    <i class="fas fa-download mr-1"></i>
                                                    Download
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="py-8 text-center">
                            <i class="fas fa-database mb-4 text-4xl text-gray-400 dark:text-gray-600"></i>
                            <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-gray-100">No backups found</h3>
                            <p class="mb-4 text-sm text-gray-500 dark:text-gray-300">
                                There are no backup files available. Create your first backup to get started.
                            </p>
                            <form action="{{ route('central.settings.backup.create') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-[color:var(--color-brunswick-green)] px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors duration-200 hover:bg-[color:var(--color-dark-green)] focus:outline-none focus:ring-2 focus:ring-[color:var(--color-brunswick-green)] focus:ring-offset-2 dark:bg-[color:var(--color-dark-green)] dark:hover:bg-[color:var(--color-brunswick-green)]">
                                    <i class="fas fa-database mr-2"></i>
                                    Create First Backup
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
