<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-md">
        @csrf

        <div>
            <label for="name" class="dw-label">Full Name</label>
            <input id="name" name="name" class="dw-input mt-xs" value="{{ old('name') }}" required autofocus autocomplete="name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="dw-label">Email Address</label>
            <input id="email" name="email" type="email" class="dw-input mt-xs" value="{{ old('email') }}" required autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="role" class="dw-label">Role</label>
            <select id="role" name="role" class="dw-input mt-xs" required>
                <option value="team_member" @selected(old('role') === 'team_member')>Team Member</option>
                <option value="guest" @selected(old('role') === 'guest')>Guest</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="grid gap-md sm:grid-cols-2">
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
        </div>

        <button type="submit" class="dw-button-primary w-full">
            Create account
            <span class="material-symbols-outlined">person_add</span>
        </button>
    </form>

    <div class="mt-lg border-t border-outline-variant pt-lg text-center">
        <a href="{{ route('login') }}" class="text-sm font-semibold text-secondary hover:underline">Already registered? Log in</a>
    </div>
</x-guest-layout>
