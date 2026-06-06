<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-md md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm font-semibold text-primary">Admin tools</p>
                <h1 class="text-3xl font-extrabold">Categories</h1>
                <p class="mt-xs text-on-surface-variant">Organize tasks by subject area or workflow.</p>
            </div>
            <a href="{{ route('categories.create') }}" class="dw-button-primary">
                <span class="material-symbols-outlined">add</span>
                New Category
            </a>
        </div>
    </x-slot>

    <div class="px-gutter pb-xl md:px-xl">
        @if (session('success'))
            <div class="mb-md rounded-lg border border-green-200 bg-green-50 p-md text-green-800">{{ session('success') }}</div>
        @endif

        <section class="dw-card overflow-hidden">
            <table class="min-w-full divide-y divide-outline-variant">
                <thead class="bg-surface-container">
                    <tr>
                        <th class="px-md py-sm text-left text-xs font-bold uppercase text-on-surface-variant">Name</th>
                        <th class="px-md py-sm text-left text-xs font-bold uppercase text-on-surface-variant">Slug</th>
                        <th class="px-md py-sm text-left text-xs font-bold uppercase text-on-surface-variant">Tasks</th>
                        <th class="px-md py-sm text-right text-xs font-bold uppercase text-on-surface-variant">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-surface-container-low">
                            <td class="px-md py-sm font-semibold">{{ $category->name }}</td>
                            <td class="px-md py-sm text-sm text-on-surface-variant">{{ $category->slug }}</td>
                            <td class="px-md py-sm text-sm text-on-surface-variant">{{ $category->tasks_count }}</td>
                            <td class="px-md py-sm text-right text-sm">
                                <a href="{{ route('categories.edit', $category) }}" class="font-semibold text-primary">Edit</a>
                                <form method="POST" action="{{ route('categories.destroy', $category) }}" class="inline" onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ms-md font-semibold text-error">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-md py-xl text-center text-on-surface-variant">No categories yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="border-t border-outline-variant p-md">{{ $categories->links() }}</div>
        </section>
    </div>
</x-app-layout>
