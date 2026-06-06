<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-md md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm font-semibold text-primary">User details</p>
                <h1 class="text-3xl font-extrabold">{{ $user->name }}</h1>
                <p class="mt-xs text-on-surface-variant">{{ $user->email }}</p>
            </div>
            <div class="flex gap-sm">
                <a href="{{ route('users.edit', $user) }}" class="dw-button-primary">Edit User</a>
                <a href="{{ route('users.index') }}" class="dw-button-secondary">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="grid gap-lg px-gutter pb-xl md:px-xl xl:grid-cols-3">
        <section class="dw-card p-lg">
            <h2 class="font-bold">Profile</h2>
            <dl class="mt-md space-y-sm text-sm">
                <div class="flex justify-between border-b border-outline-variant pb-sm">
                    <dt class="text-on-surface-variant">Role</dt>
                    <dd class="font-semibold">{{ str_replace('_', ' ', $user->role->value) }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-on-surface-variant">Joined</dt>
                    <dd class="font-semibold">{{ $user->created_at?->format('M d, Y') }}</dd>
                </div>
            </dl>
        </section>

        <section class="dw-card p-lg xl:col-span-2">
            <h2 class="font-bold">Assigned Tasks</h2>
            <div class="mt-md space-y-sm">
                @forelse ($user->assignedTasks as $task)
                    <a href="{{ route('tasks.show', $task) }}" class="flex items-center justify-between rounded-lg border border-outline-variant p-md hover:bg-surface-container-low">
                        <span class="font-semibold">{{ $task->title }}</span>
                        <span class="rounded-full px-sm py-xs text-xs {{ $task->status_badge }}">{{ str_replace('_', ' ', $task->status->value) }}</span>
                    </a>
                @empty
                    <p class="text-sm text-on-surface-variant">No assigned tasks.</p>
                @endforelse
            </div>
        </section>
    </div>
</x-app-layout>
