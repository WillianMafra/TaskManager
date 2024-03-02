<x-mail::message>
Hi, {{ $userName }}, a task was updated on your profile!

@if ($oldTaskName != $newTaskName)
    Now, the task {{ $oldTaskName }} is called {{ $newTaskName}}!
@else
    Task: {{ $oldTaskName }}
@endif
@if ($oldDeadlineDate != $newDeadlineDate)
    Previously you have set the deadline to {{ $oldDeadlineDate }} and now the new deadline date is: {{ $newDeadlineDate }}
@else
    The deadline to completion still: {{ $oldDeadlineDate }}
@endif
<x-mail::button :url="$url">
See task
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
