<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SenatoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kz_messageToSend;
    public $tr_messageToSend;

    /**
     * Create a new message instance.
     *
     * @param  string  $messageToSend
     * @return void
     */
    public function __construct($kz_messageToSend, $tr_messageToSend)
    {
        $this->kz_messageToSend = $kz_messageToSend;
        $this->tr_messageToSend = $tr_messageToSend;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.message')
                    ->subject('Жиналыс/Senato');
    }
}
