<x-mail::message>
# {{ $taskName }}

Deadline for completion: {{ $deadlineDate }}

<x-mail::button :url="$url">
See task
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
