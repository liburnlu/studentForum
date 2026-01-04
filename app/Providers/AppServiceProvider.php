<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Nette\Utils\Paginator;
use Illuminate\Support\Facades\Gate;


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
        \Illuminate\Pagination\Paginator::useTailwind();
        //Model::preventLazyLoading(! $this->app->isProduction());


        Gate::define('view-admin-panel' , function (User $user) {
           return $user->role==='admin'
               ? Response::allow()
               : Response::deny('You are not authorized to view the admin panel.');
        });



    }
}
