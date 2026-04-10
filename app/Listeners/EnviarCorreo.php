<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\AlertaLoginCorreo;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Mail;

class EnviarCorreo
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void //Se modifico que sea un objeto de tipo Login
    {
        //Obtenemos la información del usuario con la sesión
        $user = $event->user;

        /*
        Postereriormente usamos la información para poder enviar el correo
        a la clase en la cual fue construido el email
        */
        Mail::to($user->email)->send(new AlertaLoginCorreo($user));
    }
}
