<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-md md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm font-semibold text-primary">Task details</p>
                <h1 class="text-3xl font-extrabold">{{ $task->title }}</h1>
            </div>
            <div class="flex gap-sm">
                @can('update', $task)
                    <a href="{{ route('tasks.edit', $task) }}" class="dw-button-secondary">
                        <span class="material-symbols-outlined">edit</span>
                        Edit
                    </a>
                @endcan
                <a href="{{ route('tasks.index') }}" class="dw-button-secondary">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="grid gap-lg px-gutter pb-xl md:px-xl xl:grid-cols-3">
        <section class="dw-card p-lg xl:col-span-2">
            <div class="flex flex-wrap gap-sm">
                <span class="rounded-full px-sm py-xs text-xs {{ $task->status_badge }}">{{ str_replace('_', ' ', $task->status->value) }}</span>
                <span class="rounded-full px-sm py-xs text-xs {{ $task->priority_badge }}">{{ ucfirst($task->priority->value) }}</span>
            </div>

            <div class="mt-lg">
                <h2 class="font-bold">Description</h2>
                <p class="mt-sm whitespace-pre-line text-on-surface-variant">{{ $task->description ?: 'No description provided.' }}</p>
            </div>

            @can('update', $task)
                <form method="POST" action="{{ route('tasks.update-status', $task) }}" class="mt-lg rounded-xl border border-outline-variant bg-surface-container-low p-md">
                    @csrf
                    @method('PATCH')
                    <label for="status" class="dw-label">Quick Status</label>
                    <div class="mt-sm flex flex-col gap-sm sm:flex-row">
                        <select id="status" name="status" class="dw-input">
                            @foreach (['pending' => 'Pending', 'in_progress' => 'In Progress', 'completed' => 'Completed'] as $value => $label)
                                <option value="{{ $value }}" @selected($task->status->value === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        <button class="dw-button-primary" type="submit">Update</button>
                    </div>
                </form>
            @endcan
        </section>

        <aside class="space-y-lg">
            <div class="dw-card p-lg">
                <h2 class="font-bold">Task Info</h2>
                <dl class="mt-md space-y-sm text-sm">
                    <div class="flex justify-between gap-md border-b border-outline-variant pb-sm">
                        <dt class="text-on-surface-variant">Due date</dt>
                        <dd class="font-semibold">{{ $task->formatted_due_date ?? '-' }}</dd>
                    </div>
                    <div class="flex justify-between gap-md border-b border-outline-variant pb-sm">
                        <dt class="text-on-surface-variant">Creator</dt>
                        <dd class="font-semibold">{{ $task->creator?->name ?? '-' }}</dd>
                    </div>
                    <div class="flex justify-between gap-md">
                        <dt class="text-on-surface-variant">Assignee</dt>
                        <dd class="font-semibold">{{ $task->assignee?->name ?? 'Unassigned' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="dw-card p-lg">
                <h2 class="font-bold">Categories</h2>
                <div class="mt-md flex flex-wrap gap-sm">
                    @forelse ($task->categories as $category)
                        <span class="rounded-full bg-surface-container-high px-sm py-xs text-sm">{{ $category->name }}</span>
                    @empty
                        <p class="text-sm text-on-surface-variant">No categories.</p>
                    @endforelse
                </div>
            </div>

            @can('delete', $task)
                <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="dw-card border-error-container p-lg" onsubmit="return confirm('Delete this task?')">
                    @csrf
                    @method('DELETE')
                    <h2 class="font-bold text-error">Delete Task</h2>
                    <p class="mt-sm text-sm text-on-surface-variant">This action cannot be undone.</p>
                    <button class="mt-md inline-flex items-center rounded-lg bg-error px-lg py-sm text-sm font-semibold text-white" type="submit">Delete Task</button>
                </form>
            @endcan
        </aside>
    </div>
</x-app-layout>
