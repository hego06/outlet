<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LigaBancaria extends Mailable
{
    use Queueable, SerializesModels;

    public $ligaBancaria;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public function __construct(LigaBancaria $ligaBancaria)
    // {
    //     $this->ligaBancaria = $ligaBancaria;
    // }

        public function __construct()
    {
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.ligaBancaria');
    }
}
