<x-mail::message>
# DailyWin Task Reminder

Your task **{{ $task->title }}** is due on **{{ $task->formatted_due_date }}**.

<x-mail::panel>
**Status:** {{ str_replace('_', ' ', $task->status->value) }}  
**Priority:** {{ ucfirst($task->priority->value) }}  
**Assigned To:** {{ $task->assignee?->name ?? 'Unassigned' }}
</x-mail::panel>

{{ $task->description ?: 'No description provided.' }}

<x-mail::button :url="route('tasks.show', $task)">
View Task
</x-mail::button>

Thanks,  
{{ config('app.name') }}
</x-mail::message>
