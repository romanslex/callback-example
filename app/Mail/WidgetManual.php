<?php

namespace App\Mail;

use App\Models\Widget;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WidgetManual extends Mailable
{
    use Queueable, SerializesModels;

    private $widget;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Widget $widget)
    {
        $this->widget = $widget;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.widget-manual', ['id' => $this->widget->id]);
    }
}
