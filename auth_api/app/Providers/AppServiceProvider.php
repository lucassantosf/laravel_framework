<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

use View;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Traduz linguagem do DATE em todas as seções do site - Funciona apenas para a função diffForHuman() */
        Carbon::setLocale('pt');  

        View::composer('*', function($view){
            $view->with('auth', Auth::user()); //Envia dados do usuário logado para todas as páginas do sistema. Para resgatar basta digitar {{$auth->nome}}, {{$auth->email}}, {{$auth->role->label}} etc...
        });

        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
