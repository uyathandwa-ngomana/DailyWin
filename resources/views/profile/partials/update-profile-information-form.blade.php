<section>
    <header>
        <h2 class="text-lg font-bold">Update Profile Information</h2>
        <p class="mt-xs text-sm text-on-surface-variant">Update your account name and email address.</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-lg space-y-md">
        @csrf
        @method('patch')

        <div class="grid gap-md md:grid-cols-2">
            <div>
                <label for="name" class="dw-label">Full Name</label>
                <input id="name" name="name" class="dw-input mt-xs" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <label for="email" class="dw-label">Email Address</label>
                <input id="email" name="email" type="email" class="dw-input mt-xs" value="{{ old('email', $user->email) }}" required autocomplete="username">
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
        </div>

        <div class="flex items-center gap-md">
            <button class="dw-button-primary" type="submit">Save Profile</button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-on-surface-variant">Saved.</p>
            @endif
        </div>
    </form>
</section>
