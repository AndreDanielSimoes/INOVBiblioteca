<?php

namespace App\Mail;

use App\Models\Requisition;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestConfirmation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Requisition $requisition)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Book Request Confirmation',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.request-confirmation',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
