<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LinkPropostaAssinaturaMail extends Mailable
{
    use Queueable, SerializesModels;

    private $linkAssinatura;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($linkAssinatura)
    {
        $this->linkAssinatura = $linkAssinatura;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.link-assinatura')
            ->with([
                'linkAssinatura' => $this->linkAssinatura
            ]);
    }
}
