<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        // --------------------------------
        // GATES -=> Gate é um mecanismo de autorização — serve para verificar se o usuário autenticado pode ou não realizar uma determinada ação.
        // --------------------------------

        // Define a gate that checks if the user is admin
        // Gate::define('admin', function () {
        //     aqui esta dando erro
        //     return auth()->user()->role === 'admin'; 
        // });
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });

        // Define a gate that checks if the user is rh
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });
    }
}
