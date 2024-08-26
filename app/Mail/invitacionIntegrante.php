<?php

namespace App\Mail;

use App\Mail\EnvService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class invitacionIntegrante extends Mailable
{
    use Queueable, SerializesModels;

    public $nombreIntegrante1;
    public $nombreIntegrante2;
    public $idProyecto;
    protected $envService;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($usuario1, $usuario2, $idProyecto, $mailTo, $nameMailTo, $passMail)
    {
        // Laravel resuelve automáticamente la dependencia de EnvService
        // $this->envService = app(EnvService::class);
        // // Actualizar el archivo .env
        // $this->envService->updateEnv([
        //     'MAIL_USERNAME' => $mailTo,
        //     'MAIL_PASSWORD' => $passMail,
        // ]);
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
        $url = route('segundoIntegrante', [
            'usuario' => $this->nombreIntegrante2,
            'proyecto' => $this->idProyecto
        ]);

        return $this->view('emails.invitacionIntegrante')->with([
            'nombreIntegrante1' => $this->nombreIntegrante1,
            'nombreIntegrante2' => $this->nombreIntegrante2,
            'idProyecto' => $this->idProyecto,
            'url' => $url,
        ]);
    }
}
