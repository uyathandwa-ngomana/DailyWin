<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold text-primary">My account</p>
            <h1 class="text-3xl font-extrabold">Profile Settings</h1>
            <p class="mt-xs text-on-surface-variant">Manage your account information and security preferences.</p>
        </div>
    </x-slot>

    <div class="grid gap-lg px-gutter pb-xl md:px-xl xl:grid-cols-3">
        <div class="space-y-lg xl:col-span-2">
            <div class="dw-card p-lg">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="dw-card p-lg">
                @include('profile.partials.update-password-form')
            </div>

            <div class="dw-card border-error-container p-lg">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

        <aside class="space-y-lg">
            <div class="rounded-xl bg-primary-container p-lg text-on-primary-container shadow-sm">
                <div class="flex items-center gap-sm">
                    <span class="material-symbols-outlined">verified_user</span>
                    <h2 class="font-bold">Account Status</h2>
                </div>
                <dl class="mt-md space-y-sm text-sm">
                    <div class="flex justify-between border-b border-white/20 pb-sm">
                        <dt class="opacity-80">Role</dt>
                        <dd class="font-semibold">{{ str_replace('_', ' ', $user->role->value) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="opacity-80">Email services</dt>
                        <dd class="font-semibold">Reminder ready</dd>
                    </div>
                </dl>
            </div>

            <div class="dw-card p-lg">
                <h2 class="font-bold">Quick Links</h2>
                <div class="mt-md grid gap-sm">
                    <a href="{{ route('dashboard') }}" class="dw-button-secondary">Dashboard</a>
                    @if (!Auth::user()->isGuest())
                        <a href="{{ route('tasks.index') }}" class="dw-button-secondary">Tasks</a>
                    @endif
                </div>
            </div>
        </aside>
    </div>
</x-app-layout>
