<?php

namespace App\Providers;

use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use App\Policies\ReplyPolicy;
use App\Policies\TopicPolicy;
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

        //registering the policies
       Gate::policy(Topic::class, TopicPolicy::class);
       Gate::policy(Reply::class, ReplyPolicy::class);
    }
}
