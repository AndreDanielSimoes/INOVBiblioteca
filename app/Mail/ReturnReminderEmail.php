<?php

namespace App\Mail;

use App\Models\Requisition;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReturnReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $requisition;

    /**
     * Create a new message instance.
     *
     * @param Requisition $requisition
     */
    public function __construct(Requisition $requisition)
    {
        $this->requisition = $requisition;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Book Return Reminder')
            ->view('mail.return-reminder')
            ->with([
                'requisition' => $this->requisition,
            ]);
    }
}



