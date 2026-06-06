<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-xs md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm font-semibold text-primary">DailyWin overview</p>
                <h1 class="text-3xl font-extrabold text-on-surface">Dashboard</h1>
                <p class="mt-xs text-on-surface-variant">Track work, deadlines, and priorities for your team.</p>
            </div>
            @if (!Auth::user()->isGuest())
                <a href="{{ route('tasks.create') }}" class="dw-button-primary">
                    <span class="material-symbols-outlined">add_task</span>
                    New task
                </a>
            @endif
        </div>
    </x-slot>

    <div class="px-gutter pb-xl md:px-xl">
        <div class="grid gap-md sm:grid-cols-2 xl:grid-cols-6">
            @foreach ([
                ['label' => 'Total Tasks', 'value' => $totalTasks, 'icon' => 'assignment', 'class' => 'xl:col-span-2 bg-primary-container text-on-primary-container'],
                ['label' => 'Completed', 'value' => $completedTasks, 'icon' => 'task_alt', 'class' => 'bg-green-50 text-green-900'],
                ['label' => 'Pending', 'value' => $pendingTasks, 'icon' => 'schedule', 'class' => 'bg-yellow-50 text-yellow-900'],
                ['label' => 'In Progress', 'value' => $inProgressTasks, 'icon' => 'pending_actions', 'class' => 'bg-blue-50 text-blue-900'],
                ['label' => 'Due This Week', 'value' => $tasksDueThisWeek, 'icon' => 'event', 'class' => 'bg-white text-on-surface'],
            ] as $stat)
                <div class="rounded-xl border border-outline-variant p-lg shadow-sm {{ $stat['class'] }}">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold opacity-80">{{ $stat['label'] }}</p>
                        <span class="material-symbols-outlined">{{ $stat['icon'] }}</span>
                    </div>
                    <p class="mt-md text-4xl font-extrabold">{{ $stat['value'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-lg grid gap-lg xl:grid-cols-3">
            <section class="dw-card overflow-hidden xl:col-span-2">
                <div class="border-b border-outline-variant bg-surface-container-low p-lg">
                    <h2 class="text-lg font-bold">Recent Tasks</h2>
                    <p class="text-sm text-on-surface-variant">Latest work visible to your role.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-outline-variant">
                        <thead class="bg-surface-container">
                            <tr>
                                <th class="px-md py-sm text-left text-xs font-bold uppercase text-on-surface-variant">Task</th>
                                <th class="px-md py-sm text-left text-xs font-bold uppercase text-on-surface-variant">Priority</th>
                                <th class="px-md py-sm text-left text-xs font-bold uppercase text-on-surface-variant">Due</th>
                                <th class="px-md py-sm text-left text-xs font-bold uppercase text-on-surface-variant">Assigned</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            @forelse ($recentTasks as $task)
                                <tr class="hover:bg-surface-container-low">
                                    <td class="px-md py-sm">
                                        <a href="{{ route('tasks.show', $task) }}" class="font-semibold text-primary">{{ $task->title }}</a>
                                        <div class="mt-xs">
                                            <span class="rounded-full px-sm py-xs text-xs {{ $task->status_badge }}">{{ str_replace('_', ' ', $task->status->value) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-md py-sm"><span class="rounded-full px-sm py-xs text-xs {{ $task->priority_badge }}">{{ ucfirst($task->priority->value) }}</span></td>
                                    <td class="px-md py-sm text-sm text-on-surface-variant">{{ $task->formatted_due_date ?? '-' }}</td>
                                    <td class="px-md py-sm text-sm text-on-surface-variant">{{ $task->assignee?->name ?? 'Unassigned' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-md py-xl text-center text-on-surface-variant">No tasks yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <aside class="space-y-lg">
                <div class="dw-card p-lg">
                    <div class="flex items-center gap-sm text-error">
                        <span class="material-symbols-outlined">priority_high</span>
                        <h2 class="font-bold">High Priority Pending</h2>
                    </div>
                    <p class="mt-md text-5xl font-extrabold">{{ $highPriorityPendingTasks }}</p>
                    <p class="mt-sm text-sm text-on-surface-variant">Items that need attention before they become blockers.</p>
                </div>

                <div class="dw-card p-lg">
                    <h2 class="font-bold">Quick Actions</h2>
                    <div class="mt-md grid gap-sm">
                        @if (!Auth::user()->isGuest())
                            <a href="{{ route('tasks.index') }}" class="dw-button-secondary">View tasks</a>
                            <a href="{{ route('tasks.create') }}" class="dw-button-primary">Create task</a>
                        @endif
                        @if (Auth::user()->isAdmin())
                            <a href="{{ route('admin.index') }}" class="dw-button-secondary">Open admin</a>
                        @endif
                    </div>
                </div>
            </aside>
        </div>
    </div>
</x-app-layout>
