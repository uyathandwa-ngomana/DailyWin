<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold text-primary">Users</p>
            <h1 class="text-3xl font-extrabold">Edit User</h1>
        </div>
    </x-slot>

    <div class="px-gutter pb-xl md:px-xl">
        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PUT')
            @include('users._form', ['buttonText' => 'Update User'])
        </form>
    </div>
</x-app-layout>
