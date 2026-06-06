<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-md md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm font-semibold text-primary">Admin tools</p>
                <h1 class="text-3xl font-extrabold">Users</h1>
                <p class="mt-xs text-on-surface-variant">Manage admin, team member, and guest accounts.</p>
            </div>
            <a href="{{ route('users.create') }}" class="dw-button-primary">
                <span class="material-symbols-outlined">person_add</span>
                New User
            </a>
        </div>
    </x-slot>

    <div class="px-gutter pb-xl md:px-xl">
        @if (session('success'))
            <div class="mb-md rounded-lg border border-green-200 bg-green-50 p-md text-green-800">{{ session('success') }}</div>
        @endif

        <section class="dw-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-outline-variant">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-md py-sm text-left text-xs font-bold uppercase text-on-surface-variant">Name</th>
                            <th class="px-md py-sm text-left text-xs font-bold uppercase text-on-surface-variant">Email</th>
                            <th class="px-md py-sm text-left text-xs font-bold uppercase text-on-surface-variant">Role</th>
                            <th class="px-md py-sm text-left text-xs font-bold uppercase text-on-surface-variant">Tasks</th>
                            <th class="px-md py-sm text-right text-xs font-bold uppercase text-on-surface-variant">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @forelse ($users as $user)
                            <tr class="hover:bg-surface-container-low">
                                <td class="px-md py-sm font-semibold">{{ $user->name }}</td>
                                <td class="px-md py-sm text-sm text-on-surface-variant">{{ $user->email }}</td>
                                <td class="px-md py-sm"><span class="rounded-full bg-surface-container-high px-sm py-xs text-xs">{{ str_replace('_', ' ', $user->role->value) }}</span></td>
                                <td class="px-md py-sm text-sm text-on-surface-variant">{{ $user->assigned_tasks_count }} assigned / {{ $user->created_tasks_count }} created</td>
                                <td class="px-md py-sm text-right text-sm">
                                    <a href="{{ route('users.show', $user) }}" class="font-semibold text-primary">View</a>
                                    <a href="{{ route('users.edit', $user) }}" class="ms-md font-semibold text-primary">Edit</a>
                                    <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline" onsubmit="return confirm('Delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ms-md font-semibold text-error">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-md py-xl text-center text-on-surface-variant">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-t border-outline-variant p-md">{{ $users->links() }}</div>
        </section>
    </div>
</x-app-layout>
