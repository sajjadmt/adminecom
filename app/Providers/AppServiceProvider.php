<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();
        foreach (['edit-user', 'delete-user', 'change-user-password','change-status'] as $action) {
            Gate::define($action, function ($user) {
                return $user->role === 'admin';
            });
        }
    }
}
