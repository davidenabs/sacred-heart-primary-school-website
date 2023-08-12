<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('guest.*', function ($view) {
            $view->with('settings', Setting::first());
        });

        view()->composer(['writer.*', 'admin.*'], function ($view) {
            $view->with('notifications', auth()->user()->unreadNotifications);
        });
    }
}
