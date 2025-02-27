<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmployeeAccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Your Employee Account Has Been Created')
                    ->view('emails.employee_account_created');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Employee Account Created',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
{
    return new Content(
        view: 'emails.employee_account_created', 
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
