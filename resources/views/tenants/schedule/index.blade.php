<x-tenant-dash-component>
    <x-slot name="header">
        <div class="flex items-center justify-between" x-data="scheduleManager()" x-init="init()">
            <h2
                class="text-xl font-semibold text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                <i class="fas fa-calendar-alt mr-2"></i>
                Class Schedule
            </h2>
            <div class="flex space-x-3">
                <!-- View Toggle Buttons -->
                <div
                    class="inline-flex rounded-lg border border-[color:var(--color-brunswick-green)] p-1 dark:border-[color:var(--color-light-brunswick-green)]">
                    <button @click="showWeeklyView()"
                        :class="currentView === 'weekly' ? 'bg-[color:var(--color-castleton-green)] text-white' :
                            'text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]'"
                        class="rounded-md px-3 py-1 text-sm font-medium transition-colors duration-200">
                        <i class="fas fa-calendar-week mr-1"></i>
                        Weekly
                    </button>
                    <button @click="showDailyView()"
                        :class="currentView === 'daily' ? 'bg-[color:var(--color-castleton-green)] text-white' :
                            'text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]'"
                        class="rounded-md px-3 py-1 text-sm font-medium transition-colors duration-200">
                        <i class="fas fa-calendar-day mr-1"></i>
                        Daily
                    </button>
                    <button @click="showListView()"
                        :class="currentView === 'list' ? 'bg-[color:var(--color-castleton-green)] text-white' :
                            'text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]'"
                        class="rounded-md px-3 py-1 text-sm font-medium transition-colors duration-200">
                        <i class="fas fa-list mr-1"></i>
                        List
                    </button>
                </div>

                @can('manage classes')
                    <a href="{{ route('tenant.classes.create') }}"
                        class="inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                        <i class="fas fa-plus mr-2"></i>
                        Add Class
                    </a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" x-data="scheduleManager()" x-init="init()">

            <!-- Loading State -->
            <div x-show="loading" x-cloak class="flex items-center justify-center py-12">
                <div class="h-12 w-12 animate-spin rounded-full border-b-2 border-[color:var(--color-castleton-green)]">
                </div>
                <span
                    class="ml-3 text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">Loading
                    schedule...</span>
            </div>

            <!-- Week Navigation -->
            <div x-show="currentView === 'weekly'" x-cloak
                class="mb-6 flex items-center justify-between rounded-lg bg-[color:var(--color-light-castleton-green)] p-4 dark:bg-[color:var(--color-castleton-green)]">
                <button @click="previousWeek()"
                    class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] hover:text-white dark:text-[color:var(--color-light-gunmetal)]">
                    <i class="fas fa-chevron-left mr-2"></i>
                    Previous Week
                </button>

                <h3 class="text-lg font-semibold text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"
                    x-text="weekTitle">
                    Loading...
                </h3>

                <button @click="nextWeek()"
                    class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] hover:text-white dark:text-[color:var(--color-light-gunmetal)]">
                    Next Week
                    <i class="fas fa-chevron-right ml-2"></i>
                </button>
            </div>

            <!-- Weekly View -->
            <div x-show="currentView === 'weekly'" x-cloak>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-7">
                    <template x-for="(day, date) in weeklySchedule" :key="date">
                        <div
                            class="rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-castleton-green)] shadow-sm dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                            <!-- Day Header -->
                            <div
                                class="rounded-t-lg bg-[color:var(--color-brunswick-green)] p-3 text-white dark:bg-[color:var(--color-light-brunswick-green)]">
                                <h4 class="text-sm font-medium" x-text="day.day_name"></h4>
                                <p class="text-xs opacity-90" x-text="formatDate(day.date)"></p>
                            </div>

                            <!-- Day Classes -->
                            <div class="min-h-[200px] space-y-2 p-3">
                                <template x-for="classItem in day.classes" :key="classItem.id">
                                    <div
                                        class="rounded-md border border-[color:var(--color-light-brunswick-green)] bg-white p-3 transition-shadow duration-200 hover:shadow-md dark:border-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-gunmetal)]">
                                        <div class="mb-2 flex items-start justify-between">
                                            <h5 class="text-sm font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"
                                                x-text="classItem.name"></h5>
                                            <span
                                                class="text-xs font-medium text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"
                                                x-text="classItem.time_display"></span>
                                        </div>
                                        <p class="mb-1 text-xs text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"
                                            x-text="classItem.subject"></p>
                                        <p class="text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"
                                            x-text="classItem.teacher_name"></p>
                                        <div x-show="classItem.room" class="mt-1 flex items-center">
                                            <i
                                                class="fas fa-map-marker-alt mr-1 text-xs text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"></i>
                                            <span
                                                class="text-xs text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"
                                                x-text="classItem.room"></span>
                                        </div>
                                        @can('view classes')
                                            <div class="mt-2">
                                                <a :href="`{{ url('/classes') }}/${classItem.id}`"
                                                    class="text-xs text-[color:var(--color-castleton-green)] hover:underline dark:text-[color:var(--color-light-castleton-green)]">
                                                    View Details →
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                </template>

                                <div x-show="day.classes.length === 0" class="py-8 text-center">
                                    <i
                                        class="fas fa-calendar-times mb-2 text-2xl text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
                                    <p
                                        class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                                        No classes scheduled</p>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Daily View -->
            <div x-show="currentView === 'daily'" x-cloak>
                <div
                    class="mb-6 flex items-center justify-between rounded-lg bg-[color:var(--color-light-castleton-green)] p-4 dark:bg-[color:var(--color-castleton-green)]">
                    <button @click="previousDay()"
                        class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] hover:text-white dark:text-[color:var(--color-light-gunmetal)]">
                        <i class="fas fa-chevron-left mr-2"></i>
                        Previous Day
                    </button>

                    <div class="text-center">
                        <h3 class="text-lg font-semibold text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"
                            x-text="currentDay.day_name"></h3>
                        <p class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"
                            x-text="formatDate(currentDay.date)"></p>
                    </div>

                    <button @click="nextDay()"
                        class="inline-flex items-center rounded-md px-3 py-2 text-sm font-medium text-[color:var(--color-gunmetal)] transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] hover:text-white dark:text-[color:var(--color-light-gunmetal)]">
                        Next Day
                        <i class="fas fa-chevron-right ml-2"></i>
                    </button>
                </div>

                <div class="space-y-4">
                    <template x-for="classItem in currentDay.classes" :key="classItem.id">
                        <div
                            class="rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-6 dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                            <div class="mb-4 flex items-center justify-between">
                                <h4 class="text-lg font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"
                                    x-text="classItem.name"></h4>
                                <span
                                    class="rounded-full bg-[color:var(--color-castleton-green)] px-3 py-1 text-sm font-medium text-white dark:bg-[color:var(--color-light-castleton-green)]"
                                    x-text="classItem.time_display"></span>
                            </div>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                <div>
                                    <p
                                        class="mb-1 text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        Subject</p>
                                    <p class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"
                                        x-text="classItem.subject || 'N/A'"></p>
                                </div>
                                <div>
                                    <p
                                        class="mb-1 text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        Teacher</p>
                                    <p class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"
                                        x-text="classItem.teacher_name"></p>
                                </div>
                                <div>
                                    <p
                                        class="mb-1 text-sm font-medium text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                                        Room</p>
                                    <p class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"
                                        x-text="classItem.room || 'N/A'"></p>
                                </div>
                            </div>
                            @can('view classes')
                                <div
                                    class="mt-4 border-t border-[color:var(--color-brunswick-green)] pt-4 dark:border-[color:var(--color-light-brunswick-green)]">
                                    <a :href="`{{ url('/classes') }}/${classItem.id}`"
                                        class="inline-flex items-center text-[color:var(--color-castleton-green)] hover:underline dark:text-[color:var(--color-light-castleton-green)]">
                                        <i class="fas fa-external-link-alt mr-2"></i>
                                        View Class Details
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </template>

                    <div x-show="currentDay.classes && currentDay.classes.length === 0" class="py-12 text-center">
                        <i
                            class="fas fa-calendar-times mb-4 text-4xl text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
                        <p
                            class="text-lg text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                            No classes scheduled for this day</p>
                    </div>
                </div>
            </div>

            <!-- List View -->
            <div x-show="currentView === 'list'" x-cloak>
                <div class="space-y-6">
                    <template
                        x-for="day in ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']"
                        :key="day">
                        <div x-show="scheduleByDay[day] && scheduleByDay[day].length > 0">
                            <h3 class="mb-4 text-lg font-semibold text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"
                                x-text="day"></h3>
                            <div class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                                <template x-for="classItem in scheduleByDay[day]" :key="classItem.id">
                                    <div
                                        class="rounded-lg border border-[color:var(--color-brunswick-green)] bg-[color:var(--color-light-castleton-green)] p-4 transition-shadow duration-200 hover:shadow-md dark:border-[color:var(--color-light-brunswick-green)] dark:bg-[color:var(--color-castleton-green)]">
                                        <div class="mb-3 flex items-start justify-between">
                                            <h4 class="font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"
                                                x-text="classItem.name"></h4>
                                            <span
                                                class="text-sm font-medium text-[color:var(--color-castleton-green)] dark:text-[color:var(--color-light-castleton-green)]"
                                                x-text="classItem.schedule ? classItem.schedule.time_display : 'Time TBD'"></span>
                                        </div>
                                        <div class="space-y-2">
                                            <div class="flex items-center">
                                                <i
                                                    class="fas fa-book mr-2 w-4 text-xs text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                                <span
                                                    class="text-sm text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"
                                                    x-text="classItem.subject || 'No subject'"></span>
                                            </div>
                                            <div class="flex items-center">
                                                <i
                                                    class="fas fa-user mr-2 w-4 text-xs text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                                <span
                                                    class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"
                                                    x-text="classItem.teacher_name"></span>
                                            </div>
                                            <div x-show="classItem.room" class="flex items-center">
                                                <i
                                                    class="fas fa-map-marker-alt mr-2 w-4 text-xs text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                                <span
                                                    class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"
                                                    x-text="classItem.room"></span>
                                            </div>
                                            <div class="flex items-center">
                                                <i
                                                    class="fas fa-users mr-2 w-4 text-xs text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]"></i>
                                                <span
                                                    class="text-sm text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]"
                                                    x-text="`${classItem.student_count} students`"></span>
                                            </div>
                                        </div>
                                        @can('view classes')
                                            <div
                                                class="mt-3 border-t border-[color:var(--color-brunswick-green)] pt-3 dark:border-[color:var(--color-light-brunswick-green)]">
                                                <a :href="`{{ url('/classes') }}/${classItem.id}`"
                                                    class="text-sm text-[color:var(--color-castleton-green)] hover:underline dark:text-[color:var(--color-light-castleton-green)]">
                                                    View Details →
                                                </a>
                                            </div>
                                        @endcan
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Empty State -->
            <div x-show="!loading && isEmpty()" x-cloak class="py-12 text-center">
                <i
                    class="fas fa-calendar-alt mb-6 text-6xl text-[color:var(--color-brunswick-green)] dark:text-[color:var(--color-light-brunswick-green)]"></i>
                <h3
                    class="mb-2 text-xl font-medium text-[color:var(--color-gunmetal)] dark:text-[color:var(--color-light-gunmetal)]">
                    No Scheduled Classes</h3>
                <p class="mb-6 text-[color:var(--color-dark-green)] dark:text-[color:var(--color-light-dark-green)]">
                    There are no classes scheduled at this time.</p>
                @can('manage classes')
                    <a href="{{ route('tenant.classes.create') }}"
                        class="inline-flex items-center rounded-md bg-[color:var(--color-castleton-green)] px-4 py-2 text-sm font-medium text-white transition-colors duration-200 hover:bg-[color:var(--color-brunswick-green)] dark:bg-[color:var(--color-light-castleton-green)] dark:hover:bg-[color:var(--color-light-brunswick-green)]">
                        <i class="fas fa-plus mr-2"></i>
                        Create Your First Class
                    </a>
                @endcan
            </div>
        </div>
    </div>

    <script>
        // Create a shared Alpine store for schedule management
        document.addEventListener('alpine:init', () => {
            Alpine.store('scheduleStore', {
                loading: false,
                currentView: 'weekly',
                weeklySchedule: {},
                scheduleByDay: @json($scheduleByDay),
                processedClasses: @json($processedClasses),
                currentWeekStart: null,
                currentDay: {},
                weekTitle: '',

                init() {
                    this.currentWeekStart = this.getStartOfWeek(new Date());
                    this.loadWeeklySchedule();
                    this.currentDay = this.getTodaySchedule();
                },

                isEmpty() {
                    if (this.currentView === 'weekly') {
                        return Object.keys(this.weeklySchedule).length === 0 ||
                            Object.values(this.weeklySchedule).every(day => day.classes.length === 0);
                    } else if (this.currentView === 'daily') {
                        return !this.currentDay.classes || this.currentDay.classes.length === 0;
                    } else {
                        return this.processedClasses.length === 0;
                    }
                },

                async loadWeeklySchedule() {
                    this.loading = true;
                    try {
                        const response = await fetch(
                            `{{ route('tenant.schedule.week') }}?start_date=${this.currentWeekStart.toISOString().split('T')[0]}`
                        );
                        const data = await response.json();
                        this.weeklySchedule = data;
                        this.updateWeekTitle();
                    } catch (error) {
                        console.error('Failed to load weekly schedule:', error);
                    } finally {
                        this.loading = false;
                    }
                },

                updateWeekTitle() {
                    const endDate = new Date(this.currentWeekStart);
                    endDate.setDate(endDate.getDate() + 6);
                    this.weekTitle =
                        `${this.formatDate(this.currentWeekStart)} - ${this.formatDate(endDate)}`;
                },

                getStartOfWeek(date) {
                    const d = new Date(date);
                    const day = d.getDay();
                    const diff = d.getDate() - day + (day === 0 ? -6 : 1); // Adjust when day is Sunday
                    return new Date(d.setDate(diff));
                },

                getTodaySchedule() {
                    const today = new Date();
                    const todayStr = today.toISOString().split('T')[0];
                    const dayName = today.toLocaleDateString('en-US', {
                        weekday: 'long'
                    });

                    return {
                        date: todayStr,
                        day_name: dayName,
                        classes: this.scheduleByDay[dayName] || []
                    };
                },

                formatDate(date) {
                    const d = typeof date === 'string' ? new Date(date) : date;
                    return d.toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric'
                    });
                },

                showWeeklyView() {
                    this.currentView = 'weekly';
                    this.loadWeeklySchedule();
                },

                showDailyView() {
                    this.currentView = 'daily';
                    this.currentDay = this.getTodaySchedule();
                },

                showListView() {
                    this.currentView = 'list';
                },

                async previousWeek() {
                    this.currentWeekStart.setDate(this.currentWeekStart.getDate() - 7);
                    await this.loadWeeklySchedule();
                },

                async nextWeek() {
                    this.currentWeekStart.setDate(this.currentWeekStart.getDate() + 7);
                    await this.loadWeeklySchedule();
                },

                previousDay() {
                    const currentDate = new Date(this.currentDay.date);
                    currentDate.setDate(currentDate.getDate() - 1);
                    const dayName = currentDate.toLocaleDateString('en-US', {
                        weekday: 'long'
                    });

                    this.currentDay = {
                        date: currentDate.toISOString().split('T')[0],
                        day_name: dayName,
                        classes: this.scheduleByDay[dayName] || []
                    };
                },

                nextDay() {
                    const currentDate = new Date(this.currentDay.date);
                    currentDate.setDate(currentDate.getDate() + 1);
                    const dayName = currentDate.toLocaleDateString('en-US', {
                        weekday: 'long'
                    });

                    this.currentDay = {
                        date: currentDate.toISOString().split('T')[0],
                        day_name: dayName,
                        classes: this.scheduleByDay[dayName] || []
                    };
                }
            });
        });

        function scheduleManager() {
            return {
                init() {
                    this.$store.scheduleStore.init();
                },
                get loading() {
                    return this.$store.scheduleStore.loading;
                },
                get currentView() {
                    return this.$store.scheduleStore.currentView;
                },
                get weeklySchedule() {
                    return this.$store.scheduleStore.weeklySchedule;
                },
                get scheduleByDay() {
                    return this.$store.scheduleStore.scheduleByDay;
                },
                get processedClasses() {
                    return this.$store.scheduleStore.processedClasses;
                },
                get currentDay() {
                    return this.$store.scheduleStore.currentDay;
                },
                get weekTitle() {
                    return this.$store.scheduleStore.weekTitle;
                },

                isEmpty() {
                    return this.$store.scheduleStore.isEmpty();
                },
                formatDate(date) {
                    return this.$store.scheduleStore.formatDate(date);
                },
                showWeeklyView() {
                    this.$store.scheduleStore.showWeeklyView();
                },
                showDailyView() {
                    this.$store.scheduleStore.showDailyView();
                },
                showListView() {
                    this.$store.scheduleStore.showListView();
                },
                previousWeek() {
                    return this.$store.scheduleStore.previousWeek();
                },
                nextWeek() {
                    return this.$store.scheduleStore.nextWeek();
                },
                previousDay() {
                    this.$store.scheduleStore.previousDay();
                },
                nextDay() {
                    this.$store.scheduleStore.nextDay();
                }
            }
        }
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        .scrollbar-thin::-webkit-scrollbar {
            width: 4px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: transparent;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 2px;
        }

        .dark .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #64748b;
        }
    </style>
</x-tenant-dash-component>
