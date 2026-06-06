<section class="space-y-md">
    <header>
        <h2 class="text-lg font-bold text-error">Delete Account</h2>
        <p class="mt-xs text-sm text-on-surface-variant">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
    </header>

    <button class="inline-flex items-center rounded-lg bg-error px-lg py-sm text-sm font-semibold text-white"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        Delete Account
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-lg">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold">Are you sure you want to delete your account?</h2>
            <p class="mt-sm text-sm text-on-surface-variant">Please enter your password to confirm permanent deletion.</p>

            <div class="mt-lg">
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" type="password" class="dw-input" placeholder="Password">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-lg flex justify-end gap-sm">
                <button type="button" class="dw-button-secondary" x-on:click="$dispatch('close')">Cancel</button>
                <button type="submit" class="inline-flex items-center rounded-lg bg-error px-lg py-sm text-sm font-semibold text-white">Delete Account</button>
            </div>
        </form>
    </x-modal>
</section>
