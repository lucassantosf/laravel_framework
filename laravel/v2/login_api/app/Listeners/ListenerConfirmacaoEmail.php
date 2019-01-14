<?php

namespace App\Listeners;

use App\Events\EventNovoRegistro;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\EmailRegistroConfirmacao;
use Illuminate\Support\Facades\Mail;

class ListenerConfirmacaoEmail
{
    public function __construct()
    {
        //
    }

    public function handle(EventNovoRegistro $event)
    {
        Mail::to($event->user)
            ->send(new EmailRegistroConfirmacao($event->user));
    }
}
