<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-md md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm font-semibold text-primary">Task management</p>
                <h1 class="text-3xl font-extrabold">Tasks</h1>
                <p class="mt-xs text-on-surface-variant">Filter, inspect, and update team work.</p>
            </div>
            <a href="{{ route('tasks.create') }}" class="dw-button-primary">
                <span class="material-symbols-outlined">add</span>
                New Task
            </a>
        </div>
    </x-slot>

    <div class="px-gutter pb-xl md:px-xl">
        @if (session('success'))
            <div class="mb-md rounded-lg border border-green-200 bg-green-50 p-md text-green-800">{{ session('success') }}</div>
        @endif

        <section class="dw-card mb-lg p-md">
            <form method="GET" class="grid gap-md md:grid-cols-[1fr_1fr_auto]">
                <select name="status" class="dw-input">
                    <option value="">All statuses</option>
                    @foreach (['pending' => 'Pending', 'in_progress' => 'In Progress', 'completed' => 'Completed'] as $value => $label)
                        <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                <select name="priority" class="dw-input">
                    <option value="">All priorities</option>
                    @foreach (['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'] as $value => $label)
                        <option value="{{ $value }}" @selected(request('priority') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                <button class="dw-button-primary" type="submit">
                    <span class="material-symbols-outlined">filter_alt</span>
                    Filter
                </button>
            </form>
        </section>

        <section class="dw-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-outline-variant">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-md py-sm text-left text-xs font-bold uppercase text-on-surface-variant">Title</th>
                            <th class="px-md py-sm text-left text-xs font-bold uppercase text-on-surface-variant">Status</th>
                            <th class="px-md py-sm text-left text-xs font-bold uppercase text-on-surface-variant">Priority</th>
                            <th class="px-md py-sm text-left text-xs font-bold uppercase text-on-surface-variant">Due</th>
                            <th class="px-md py-sm text-left text-xs font-bold uppercase text-on-surface-variant">Assigned</th>
                            <th class="px-md py-sm text-left text-xs font-bold uppercase text-on-surface-variant">Categories</th>
                            <th class="px-md py-sm text-right text-xs font-bold uppercase text-on-surface-variant">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @forelse ($tasks as $task)
                            <tr class="hover:bg-surface-container-low">
                                <td class="px-md py-sm font-semibold">{{ $task->title }}</td>
                                <td class="px-md py-sm"><span class="rounded-full px-sm py-xs text-xs {{ $task->status_badge }}">{{ str_replace('_', ' ', $task->status->value) }}</span></td>
                                <td class="px-md py-sm"><span class="rounded-full px-sm py-xs text-xs {{ $task->priority_badge }}">{{ ucfirst($task->priority->value) }}</span></td>
                                <td class="px-md py-sm text-sm text-on-surface-variant">{{ $task->formatted_due_date ?? '-' }}</td>
                                <td class="px-md py-sm text-sm text-on-surface-variant">{{ $task->assignee?->name ?? 'Unassigned' }}</td>
                                <td class="px-md py-sm text-sm text-on-surface-variant">{{ $task->categories->pluck('name')->join(', ') ?: '-' }}</td>
                                <td class="px-md py-sm text-right text-sm">
                                    <a href="{{ route('tasks.show', $task) }}" class="font-semibold text-primary">View</a>
                                    @can('update', $task)
                                        <a href="{{ route('tasks.edit', $task) }}" class="ms-md font-semibold text-primary">Edit</a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-md py-xl text-center text-on-surface-variant">No tasks found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-t border-outline-variant p-md">{{ $tasks->links() }}</div>
        </section>
    </div>
</x-app-layout>
