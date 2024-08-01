<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class invitacionIntegrante extends Mailable
{
    use Queueable, SerializesModels;

    public $nombreIntegrante1;
    public $nombreIntegrante2;
    public $idProyecto;

    /**
     * Create a new message instance.
     *
     * @return void
     */



    public function __construct($usuario1, $usuario2, $idProyecto, $mailTo, $nameMailTo)
    {
        $this->nombreIntegrante1 = $usuario1;
        $this->nombreIntegrante2 = $usuario2;
        $this->idProyecto = $idProyecto;
        $this->from($mailTo, $nameMailTo);
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = route('segundoIntegrante', ['usuario' => $this->nombreIntegrante2, 'proyecto' => $this->idProyecto]);

        return $this->view('emails.invitacionIntegrante')->with([
            'nombreIntegrante1' => $this->nombreIntegrante1,
            'nombreIntegrante2' => $this->nombreIntegrante2,
            'idProyecto' => $this->idProyecto,
            'url' => $url,

        ]);;
    }
}
