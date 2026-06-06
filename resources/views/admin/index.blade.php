<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-md md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm font-semibold text-primary">Admin panel</p>
                <h1 class="text-3xl font-extrabold">DailyWin Control Room</h1>
                <p class="mt-xs text-on-surface-variant">Manage tasks, people, categories, and deadline readiness.</p>
            </div>
            @if (Route::has('users.index'))
                <a href="{{ route('users.index') }}" class="dw-button-primary">
                    <span class="material-symbols-outlined">group</span>
                    Manage Users
                </a>
            @endif
        </div>
    </x-slot>

    <div class="px-gutter pb-xl md:px-xl">
        <div class="grid gap-md md:grid-cols-3">
            <div class="rounded-xl border border-outline-variant bg-primary-container p-lg text-on-primary-container shadow-sm">
                <p class="text-sm font-semibold opacity-80">Tasks</p>
                <p class="mt-md text-4xl font-extrabold">{{ $taskCount }}</p>
            </div>
            <div class="dw-card p-lg">
                <p class="text-sm font-semibold text-on-surface-variant">Users</p>
                <p class="mt-md text-4xl font-extrabold">{{ $userCount }}</p>
            </div>
            <div class="dw-card p-lg">
                <p class="text-sm font-semibold text-on-surface-variant">Categories</p>
                <p class="mt-md text-4xl font-extrabold">{{ $categoryCount }}</p>
            </div>
        </div>

        <div class="mt-lg grid gap-lg xl:grid-cols-3">
            <section class="dw-card p-lg xl:col-span-2">
                <h2 class="font-bold">Recent Tasks</h2>
                <div class="mt-md space-y-sm">
                    @forelse ($tasks as $task)
                        <a href="{{ route('tasks.show', $task) }}" class="flex items-center justify-between rounded-lg border border-outline-variant p-md hover:bg-surface-container-low">
                            <span class="font-semibold">{{ $task->title }}</span>
                            <span class="rounded-full px-sm py-xs text-xs {{ $task->priority_badge }}">{{ ucfirst($task->priority->value) }}</span>
                        </a>
                    @empty
                        <p class="text-sm text-on-surface-variant">No tasks yet.</p>
                    @endforelse
                </div>
            </section>

            <aside class="space-y-lg">
                <div class="dw-card p-lg">
                    <h2 class="font-bold">Recent Users</h2>
                    <div class="mt-md space-y-sm">
                        @foreach ($users as $user)
                            <div class="flex items-center justify-between rounded-lg bg-surface-container-low p-sm">
                                <span class="font-semibold">{{ $user->name }}</span>
                                <span class="text-xs text-on-surface-variant">{{ str_replace('_', ' ', $user->role->value) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="dw-card p-lg">
                    <h2 class="font-bold">Category Management</h2>
                    <div class="mt-md flex flex-wrap gap-sm">
                        @foreach ($categories as $category)
                            <span class="rounded-full bg-surface-container-high px-sm py-xs text-sm">{{ $category->name }} ({{ $category->tasks_count }})</span>
                        @endforeach
                    </div>
                    <a href="{{ route('categories.index') }}" class="dw-button-secondary mt-md w-full">Manage categories</a>
                </div>
            </aside>
        </div>
    </div>
</x-app-layout>
