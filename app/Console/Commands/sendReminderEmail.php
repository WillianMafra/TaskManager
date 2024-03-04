<?php

namespace App\Console\Commands;

use App\Mail\reminderEmail;
use App\Models\Task;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class sendReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-reminder-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a remind email';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        $remindTime = Task::whereNull('reminder_email_sent')
             ->value('reminder_time');

        $tasks = Task::whereNull('reminder_email_sent')
             ->whereRaw('date= ?', [now()->subMinutes($remindTime)->format('Y-m-d H:i:00')])
             ->get();


        foreach ($tasks as $task) {
            $user = $task->user;
            Mail::to($user->email)->send(new reminderEmail($task));
            $task->reminder_email_sent = true;
            $task->save();
        }

        if(empty($tasks)){
            $this->info('There is no task to remind!');
        } else 
        {
            $this->info('Reminder emails sent with success!');
        }
    }
}
