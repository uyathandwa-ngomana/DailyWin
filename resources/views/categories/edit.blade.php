<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold text-primary">Categories</p>
            <h1 class="text-3xl font-extrabold">Edit Category</h1>
        </div>
    </x-slot>

    <div class="px-gutter pb-xl md:px-xl">
        <form method="POST" action="{{ route('categories.update', $category) }}">
            @csrf
            @method('PUT')
            @include('categories._form', ['buttonText' => 'Update Category'])
        </form>
    </div>
</x-app-layout>
