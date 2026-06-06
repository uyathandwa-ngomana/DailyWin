<x-guest-layout>
    <div class="mb-md">
        <h2 class="text-xl font-bold">Confirm password</h2>
        <p class="mt-xs text-sm text-on-surface-variant">Please confirm your password before continuing.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-md">
        @csrf
        <div>
            <label for="password" class="dw-label">Password</label>
            <input id="password" name="password" type="password" class="dw-input mt-xs" required autocomplete="current-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <button type="submit" class="dw-button-primary w-full">Confirm</button>
    </form>
</x-guest-layout>
