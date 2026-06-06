<x-guest-layout>
    <div class="mb-md">
        <h2 class="text-xl font-bold">Verify your email</h2>
        <p class="mt-xs text-sm text-on-surface-variant">Before continuing, please verify your email address using the link we sent you.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-md rounded-lg border border-green-200 bg-green-50 p-md text-sm text-green-800">
            A new verification link has been sent to your email address.
        </div>
    @endif

    <div class="flex flex-col gap-sm">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="dw-button-primary w-full">Resend verification email</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dw-button-secondary w-full">Log out</button>
        </form>
    </div>
</x-guest-layout>
