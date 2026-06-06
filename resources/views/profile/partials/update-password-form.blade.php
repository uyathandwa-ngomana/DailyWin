<section>
    <header>
        <h2 class="text-lg font-bold">Update Password</h2>
        <p class="mt-xs text-sm text-on-surface-variant">Use a long, random password to keep your account secure.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-lg max-w-xl space-y-md">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="dw-label">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" class="dw-input mt-xs" autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="dw-label">New Password</label>
            <input id="update_password_password" name="password" type="password" class="dw-input mt-xs" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="dw-label">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="dw-input mt-xs" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-md">
            <button class="dw-button-primary" type="submit">Update Password</button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-on-surface-variant">Saved.</p>
            @endif
        </div>
    </form>
</section>
