<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm font-semibold text-primary">Tasks</p>
            <h1 class="text-3xl font-extrabold">Edit Task</h1>
        </div>
    </x-slot>

    <div class="px-gutter pb-xl md:px-xl">
        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @csrf
            @method('PUT')
            @include('tasks._form', ['buttonText' => 'Update Task'])
        </form>
    </div>
</x-app-layout>
