<x-guest-layout>
    <div class="mb-md">
        <h2 class="text-xl font-bold">Reset your password</h2>
        <p class="mt-xs text-sm text-on-surface-variant">Enter your email and DailyWin will send a reset link.</p>
    </div>

    <x-auth-session-status class="mb-md" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-md">
        @csrf
        <div>
            <label for="email" class="dw-label">Email Address</label>
            <input id="email" name="email" type="email" class="dw-input mt-xs" value="{{ old('email') }}" required autofocus>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <button type="submit" class="dw-button-primary w-full">Email reset link</button>
    </form>
</x-guest-layout>
