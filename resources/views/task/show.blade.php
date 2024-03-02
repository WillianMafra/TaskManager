<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tasks
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto items-center sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 mt-4 text-gray-900 dark:text-gray-100">
                    <form action="{{route('task.update', $task->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                         <!-- Task Name -->
                        <div>
                            <x-input-label for="task_name" :value="'Task Name'" />
                            <x-text-input id="task_name" class="block mt-1 w-full" type="text" name="task_name" :value="$task->task_name" required autofocus />
                            <x-input-error :messages="$errors->get('task_name')" class="mt-2" />
                        </div>

                        <!-- Date -->
                        <div class="mt-4">
                            <x-input-label for="date" :value="'When?'" />
                            <x-text-input id="date" class="block mt-1 w-48" type="datetime-local" name="date" :value="$task->date" required />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>
                        <!-- Reminder time -->
                        <div class="mt-4">
                            <x-input-label for="reminder_time" :value="'Need a reminder?'" />
                            <select name="reminder_time" id="reminder_time">
                                @foreach ($remind_times as $key => $value)
                                <option value="{{$key}}" {{ $key == $task->reminder_time ? 'selected' : '' }}>{{$value}}</option>
                                @endforeach    
                            </select>
                        </div>
                        {{-- Button --}}
                        <div class="flex items-center justify-end mt-4">
                            <a style="margin-right: 2%" href="{{ route('dashboard') }}">
                                <x-secondary-button>
                                    Return
                                </x-secondary-button>
                            </a>
                            <x-primary-button>
                               Save
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
