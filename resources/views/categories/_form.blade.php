<div class="dw-card max-w-2xl p-lg">
    <div>
        <label for="name" class="dw-label">Name</label>
        <input id="name" name="name" class="dw-input mt-xs" value="{{ old('name', $category->name) }}" required>
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div class="mt-lg flex items-center gap-sm">
        <button class="dw-button-primary" type="submit">{{ $buttonText }}</button>
        <a href="{{ route('categories.index') }}" class="dw-button-secondary">Cancel</a>
    </div>
</div>
