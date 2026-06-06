<div class="grid gap-lg xl:grid-cols-3">
    <div class="dw-card p-lg xl:col-span-2">
        <div class="grid gap-md">
            <div class="grid gap-md md:grid-cols-2">
                <div>
                    <label for="name" class="dw-label">Full Name</label>
                    <input id="name" name="name" class="dw-input mt-xs" value="{{ old('name', $user->name) }}" required>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <label for="email" class="dw-label">Email Address</label>
                    <input id="email" name="email" type="email" class="dw-input mt-xs" value="{{ old('email', $user->email) }}" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>

            <div>
                <label for="role" class="dw-label">Role</label>
                <select id="role" name="role" class="dw-input mt-xs" required>
                    @foreach (['admin' => 'Admin', 'team_member' => 'Team Member', 'guest' => 'Guest'] as $value => $label)
                        <option value="{{ $value }}" @selected(old('role', $user->role?->value ?? 'team_member') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <div class="grid gap-md md:grid-cols-2">
                <div>
                    <label for="password" class="dw-label">Password</label>
                    <input id="password" name="password" type="password" class="dw-input mt-xs" @required(! $user->exists)>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <label for="password_confirmation" class="dw-label">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="dw-input mt-xs" @required(! $user->exists)>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            @if ($user->exists)
                <p class="text-sm text-on-surface-variant">Leave password fields blank to keep the existing password.</p>
            @endif
        </div>
    </div>

    <aside class="space-y-lg">
        <div class="dw-card bg-primary-container p-lg text-on-primary-container">
            <div class="flex items-center gap-sm">
                <span class="material-symbols-outlined">admin_panel_settings</span>
                <h2 class="font-bold">Admin User Control</h2>
            </div>
            <p class="mt-sm text-sm opacity-90">Admins can create users, update roles, and remove accounts from this area.</p>
        </div>

        <div class="flex gap-sm">
            <button class="dw-button-primary flex-1" type="submit">{{ $buttonText }}</button>
            <a href="{{ route('users.index') }}" class="dw-button-secondary">Cancel</a>
        </div>
    </aside>
</div>
