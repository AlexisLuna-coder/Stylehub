<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// 1. IMPORTAR LAS CLASES QUE VAS A USAR EN EL BOOT
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use App\Listeners\EnviarCorreo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(Login::class, EnviarCorreo::class);
    }
}
