<x-mail::message>
# {{ $taskName }}
Hi, {{ $userName }} a new task was create on your profile!

Deadline for completion: {{ $deadlineDate }}

<x-mail::button :url="$url">
See task
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
