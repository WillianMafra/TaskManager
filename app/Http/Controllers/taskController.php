<?php

namespace App\Http\Controllers;

use App\Mail\newTaskMail;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class taskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mail::raw('Testando via controller', function($mensagem){
        //     $mensagem->to('teste@example.com');
        //     $mensagem->subject('Testando subject');
        // });
        return view('task.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        $task->save();
        return redirect()->route('dashboard');
    }
}
