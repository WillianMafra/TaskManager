<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto">
                        @if (!empty($tasks[0]))
                            <div style="text-align: end; margin-bottom: 2%">
                                <a style="display: inline-block" href="{{route('task.export', 'xlsx')}}">
                                    <x-secondary-button>
                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                                        Export XLSX
                                    </x-secondary-button>
                                </a>
                                <a style="display: inline-block" href="{{route('task.export', 'csv')}}">
                                    <x-secondary-button>
                                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                                        Export CSV
                                    </x-secondary-button>
                                </a>    
                            </div>       
                        @endif
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Task Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        When?
                                    </th>
                                    <th scope="col" class="px-6 justify-end py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $task->task_name }}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ date('d/m/Y h:i', strtotime($task->date)) }}
                                        </th>
                                        <th scope="row"  class="px-6 py-4 justify-end font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <a style="display: inline-block" href="{{route('task.show', $task)}}">
                                                <x-primary-button>
                                                    See Task
                                                 </x-primary-button>
                                            </a>
                                            <form style="display:inline-block " action="{{route('task.destroy', $task->id)}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <x-danger-button>
                                                    Delete
                                                 </x-danger-button>
                                            </form>
                                        </th>
                                    </tr>  
                                @endforeach
                            </tbody>
                        </table>
                    </div>   
                </div>
            </div>
            {{ $tasks->appends($request)->links() }}
        </div>
    </div>
</x-app-layout>
