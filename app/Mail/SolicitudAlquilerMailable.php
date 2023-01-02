<?php

namespace App\Mail;

use App\Models\Publicacion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudAlquilerMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Solicitud de alquiler";
    public $info;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($info)
    {
        $this->info = $info;
//        $publicacion = Publicacion::all()->where('id', $info[0])->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('correos.solicitudAlquiler');
    }
}
