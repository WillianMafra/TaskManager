<x-mail::message>
# Hi, {{ $userName }}, I'm here to remind you about your task!
The task {{ $taskName }} starts in {{ $remaingTime }}

<x-mail::button :url="$url">
See task
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
