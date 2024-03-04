<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Task;

class newTaskMail extends Mailable
{
    use Queueable, SerializesModels;
    public $taskName;
    public $deadlineDate;
    public $url;
    public $userName;
    /**
     * Create a new message instance.
     */
    public function __construct(Task $task)
    {
        $this->taskName = $task->task_name;
        $this->deadlineDate = date('d/m/Y h:i A', strtotime($task->date));
        $this->url = 'http://localhost/task/'.$task->id;
        $this->userName = $task->user->name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Task Created',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.new-task',
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
