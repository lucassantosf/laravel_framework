<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Events\Login;
use App\Mail\NovoAcesso;
use Illuminate\Support\Facades\Mail;

class LoginListener
{
    public function __construct()
    {
        //
    }

    public function handle(Login $event)
    {
        info('Logou!');
        info($event->user->name);
        info($event->user->email);

        $quando = now()->addMinutes(5);

        Mail::to($event->user)
            //->send(new NovoAcesso($event->user));
            //->queue(new NovoAcesso($event->user));
            ->later($quando,new NovoAcesso($event->user));
    }
}
