<?php

namespace App\Mail;

use App\ClientesExpo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LigaBancaria extends Mailable
{
    use Queueable, SerializesModels;

    public $cliente;
    public $referencia;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public function __construct(LigaBancaria $ligaBancaria)
    // {
    //     $this->ligaBancaria = $ligaBancaria;
    // }

        public function __construct(ClientesExpo $cliente, $referencia)
    {
        $this->cliente = $cliente;
        $this->referencia = $referencia;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.ligaBancaria',compact('cliente','referencia'));
    }
}
