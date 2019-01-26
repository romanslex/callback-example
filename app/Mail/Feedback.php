<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Feedback extends Mailable
{
    use Queueable, SerializesModels;

    private $title;
    private $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $msg)
    {
        $this->title = $title;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->title)
            ->text("emails.feedback", ["msg" => $this->msg]);
    }
}
