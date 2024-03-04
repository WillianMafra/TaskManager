<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class reminderEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $taskName;
    public $remaingTime;
    public $url;
    public $userName;
    /**
     * Create a new message instance.
     */
    public function __construct(Task $task)
    {
        $this->taskName = $task->task_name;
        $this->url = 'http://localhost/task/'.$task->id;
        $this->userName = $task->user->name;

        switch ($task->reminder_time){
            case '30':
                $this->remaingTime = ' 30 minutes!';
                break;
            case '60':
                $this->remaingTime = ' 1 hour!';
                break;
            case '720':
                $this->remaingTime = ' 12 hour!';
                break;
            case '1440':
                $this->remaingTime = ' 1 day!';
                break;
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Do not forget your task!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.reminder-email',
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
