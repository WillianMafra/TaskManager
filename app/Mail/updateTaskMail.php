<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class updateTaskMail extends Mailable
{
    use Queueable, SerializesModels;
    public $newTaskName;
    public $oldTaskName;
    public $oldDeadlineDate;
    public $newDeadlineDate;
    public $url;
    public $userName;
    /**
     * Create a new message instance.
     */
    public function __construct(Task $oldTask, $newTask)
    {
        $this->newTaskName = $newTask->task_name;
        $this->oldTaskName = $oldTask->task_name;
        $this->newDeadlineDate = date('d/m/Y h:i A', strtotime($newTask->date));
        $this->oldDeadlineDate = date('d/m/Y h:i A', strtotime($oldTask->date));
        $this->url = 'http://localhost/task/'.$oldTask->id;
        $this->userName = $oldTask->user->name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Task Updated!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.update-task',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
