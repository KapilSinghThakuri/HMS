<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class NotificationsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $user = Auth::user();
            $isAdmin = $user && $user->hasRole(['Super Admin', 'Administrator']);

            $adminNotifications = $isAdmin ? $user->unreadNotifications : collect();
            $view->with('adminNotifications', $adminNotifications);
        });
    }
}
