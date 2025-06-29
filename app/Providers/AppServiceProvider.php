<?php

namespace App\Providers;

use App\Interfaces\ColorInterface;
use App\Interfaces\SliderInterface;
use App\Repositories\ColorRepository;
use App\Repositories\SliderRepository;
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
        $this->app->bind(SliderInterface::class,SliderRepository::class);
        $this->app->bind(ColorInterface::class,ColorRepository::class);
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
