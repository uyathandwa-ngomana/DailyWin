<x-guest-layout>
    <x-auth-session-status class="mb-md" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-md">
        @csrf

        <div>
            <label for="email" class="dw-label">Email Address</label>
            <input id="email" name="email" type="email" class="dw-input mt-xs" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="name@university.edu">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between">
                <label for="password" class="dw-label">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-semibold text-secondary hover:underline">Forgot password?</a>
                @endif
            </div>
            <input id="password" name="password" type="password" class="dw-input mt-xs" required autocomplete="current-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label class="flex items-center gap-sm text-sm text-on-surface-variant">
            <input id="remember_me" name="remember" type="checkbox" class="rounded border-outline-variant text-primary focus:ring-primary">
            Remember this device
        </label>

        <button type="submit" class="dw-button-primary w-full">
            Log in
            <span class="material-symbols-outlined">arrow_forward</span>
        </button>
    </form>

    <div class="mt-lg border-t border-outline-variant pt-lg text-center">
        <p class="text-sm text-on-surface-variant">New to DailyWin?</p>
        <a href="{{ route('register') }}" class="dw-button-secondary mt-md w-full">Create institutional account</a>
    </div>
</x-guest-layout>
