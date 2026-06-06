<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold text-primary">Categories</p>
            <h1 class="text-3xl font-extrabold">Create Category</h1>
        </div>
    </x-slot>

    <div class="px-gutter pb-xl md:px-xl">
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf
            @include('categories._form', ['buttonText' => 'Save Category'])
        </form>
    </div>
</x-app-layout>
