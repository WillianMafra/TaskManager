@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Task Manager')
<img src="http//localhost/img/logo.png" class="logo" alt="Task Manager Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
