<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class LocalizationServiceProvider extends ServiceProvider
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
            $locale = app()->getLocale();
            if ($locale !== null) {
                $view->with('current_locale', $locale);
            }else{
                $view->with('current_locale', 'en');
            }
        });
    }
}
