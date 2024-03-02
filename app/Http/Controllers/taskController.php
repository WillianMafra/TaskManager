<?php

namespace App\Http\Controllers;

use App\Exports\tasksExport;
use App\Mail\newTaskMail;
use App\Mail\updateTaskMail;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class taskController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function index()
    {
        $remindTimes = [
            null => "No, I don't",
            '30' => 'Yes, 30 minutes before',
            '60' => 'Yes, 1 hour before',
            '720' => 'Yes, 12 hours before',
            '1440' => 'Yes, 1 day before'
        ];
        $data['remind_times'] = $remindTimes;
        return view('task.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rulesValidation = [
            'task_name' => 'min:4'
        ];
        // Validating the task data
        $request->validate($rulesValidation);

        // Storing the data on the DB

        $newTask = new Task();
        $newTask->task_name = $request->get('task_name');
        $newTask->date = $request->get('date');
        $newTask->user_id = auth()->user()->id;

        // Verifying if the user wants a remind email
        if($request->get('reminder_time') != null){
            $newTask->reminder_time = $request->get('reminder_time');
        }

        $newTask->save();

        // Send email telling that a new task was created
        $userEmail = auth()->user()->email;
        Mail::to($userEmail)->send(new newTaskMail($newTask));

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // Verify if the task belongs to the user
        if($task->user_id !== auth()->user()->id){
            return redirect()->route('dashboard');
        }
        $remindTimes = [
            null => "No, I don't",
            '30' => 'Yes, 30 minutes before',
            '60' => 'Yes, 1 hour before',
            '720' => 'Yes, 12 hours before',
            '1440' => 'Yes, 1 day before'
        ];
        $data['remind_times'] = $remindTimes;
        $data['task'] = $task;
        return view('task.show', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Verify if the task belongs to the user
        if($task->user_id !== auth()->user()->id){
            return redirect()->route('dashboard');
        }
        $rulesValidation = [
            'task_name' => 'min:4'
        ];
        // Validating the task data
        $request->validate($rulesValidation);
        $oldTaskDate = strtotime($task->date);
        $newTaskDate = strtotime($request->get('date'));
        if($request->get('task_name') != $task->task_name || $oldTaskDate != $newTaskDate || $task->reminder_time != $request->get('reminder_time'))
        {
            // Send email telling to user that a task was updated
            $userEmail = auth()->user()->email;
            Mail::to($userEmail)->send(new updateTaskMail($task, $request));
            $task->update($request->all());

        }
        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Verify if the task belongs to the user
        if($task->user_id !== auth()->user()->id){
            return redirect()->route('dashboard');
        }
        $task->delete();
        return redirect()->route('dashboard');
    }

    // Export all taks to csv or xlsx
    public function exportTasks($extension){
        if($extension == 'xlsx'){
            return Excel::download(new tasksExport, 'task-list.xlsx');
        } elseif ($extension == 'csv'){
            return Excel::download(new tasksExport, 'task.list.csv');
        }

        return redirect()->route('dashboard');
    }
}
