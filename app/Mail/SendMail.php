<?php

namespace App\Mail;

use App\Consts\MailConst;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($template, $variable)
    {
        $this->template = $template;
        $this->variable = $variable;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->template == MailConst::RESERVATION) {
            return $this->view('emails.reservation')
                ->from('noeconn@nowconn.co.jp', 'Test')
                ->subject('New Reservation')
                ->with(['variable' => $this->variable]);
        }

        return $this->view('emails.test')
            ->from('noeconn@nowconn.co.jp', 'Test')
            ->subject('This is a test mail')
            ->with(['variable' => $this->variable]);
    }
}
