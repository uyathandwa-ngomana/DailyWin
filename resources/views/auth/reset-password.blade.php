<x-guest-layout>
    <div class="mb-md">
        <h2 class="text-xl font-bold">Choose a new password</h2>
        <p class="mt-xs text-sm text-on-surface-variant">Use a strong password for your DailyWin account.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-md">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="dw-label">Email Address</label>
            <input id="email" name="email" type="email" class="dw-input mt-xs" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="dw-label">Password</label>
            <input id="password" name="password" type="password" class="dw-input mt-xs" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="dw-label">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="dw-input mt-xs" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="dw-button-primary w-full">Reset password</button>
    </form>
</x-guest-layout>
