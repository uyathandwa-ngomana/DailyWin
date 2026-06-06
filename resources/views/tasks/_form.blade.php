@php
    $selectedCategories = old('categories', $task->exists ? $task->categories->pluck('id')->all() : []);
@endphp

<div class="grid gap-lg xl:grid-cols-3">
    <div class="dw-card p-lg xl:col-span-2">
        <div class="grid gap-md">
            <div>
                <label for="title" class="dw-label">Title</label>
                <input id="title" name="title" class="dw-input mt-xs" value="{{ old('title', $task->title) }}" required>
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <label for="description" class="dw-label">Description</label>
                <textarea id="description" name="description" rows="6" class="dw-input mt-xs">{{ old('description', $task->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="grid gap-md md:grid-cols-3">
                <div>
                    <label for="status" class="dw-label">Status</label>
                    <select id="status" name="status" class="dw-input mt-xs">
                        @foreach (['pending' => 'Pending', 'in_progress' => 'In Progress', 'completed' => 'Completed'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('status', $task->status?->value ?? $task->status) === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>

                <div>
                    <label for="priority" class="dw-label">Priority</label>
                    <select id="priority" name="priority" class="dw-input mt-xs">
                        @foreach (['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('priority', $task->priority?->value ?? $task->priority) === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                </div>

                <div>
                    <label for="due_date" class="dw-label">Due Date</label>
                    <input id="due_date" name="due_date" type="date" class="dw-input mt-xs" value="{{ old('due_date', optional($task->due_date)->format('Y-m-d')) }}">
                    <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                </div>
            </div>

            <div>
                <label for="assigned_to" class="dw-label">Assign To</label>
                <select id="assigned_to" name="assigned_to" class="dw-input mt-xs" @disabled(!Auth::user()->isAdmin())>
                    <option value="">Unassigned</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected((int) old('assigned_to', $task->assigned_to) === $user->id)>
                            {{ $user->name }} ({{ str_replace('_', ' ', $user->role->value) }})
                        </option>
                    @endforeach
                </select>
                @if (!Auth::user()->isAdmin())
                    <p class="mt-xs text-sm text-on-surface-variant">Team members create tasks for themselves. Admins can assign tasks to other users.</p>
                @endif
                <x-input-error :messages="$errors->get('assigned_to')" class="mt-2" />
            </div>
        </div>
    </div>

    <aside class="space-y-lg">
        <div class="dw-card p-lg">
            <h2 class="font-bold">Categories</h2>
            <div class="mt-md grid gap-sm">
                @forelse ($categories as $category)
                    <label class="flex items-center gap-sm rounded-lg border border-outline-variant bg-white p-sm text-sm">
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" @checked(in_array($category->id, $selectedCategories)) class="rounded border-outline-variant text-primary focus:ring-primary">
                        <span>{{ $category->name }}</span>
                    </label>
                @empty
                    <p class="text-sm text-on-surface-variant">No categories have been created yet.</p>
                @endforelse
            </div>
            <x-input-error :messages="$errors->get('categories')" class="mt-2" />
        </div>

        <div class="dw-card bg-primary-container p-lg text-on-primary-container">
            <div class="flex items-center gap-sm">
                <span class="material-symbols-outlined">tips_and_updates</span>
                <h2 class="font-bold">Task Tip</h2>
            </div>
            <p class="mt-sm text-sm opacity-90">Use a clear title, a deadline, and a category so the dashboard stays useful for everyone.</p>
        </div>

        <div class="flex gap-sm">
            <button class="dw-button-primary flex-1" type="submit">{{ $buttonText }}</button>
            <a href="{{ route('tasks.index') }}" class="dw-button-secondary">Cancel</a>
        </div>
    </aside>
</div>
