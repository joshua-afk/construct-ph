<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        /* */
    }

    public function boot()
    {
        Schema::defaultStringLength(191);

        /******  Custom Blade Directives  ******/
        Blade::directive('greet', function ($expression) {
            return "<?php echo 'Hello ' . {$expression}; ?>";
        });

        /******* Components and Alisases ******/
        Blade::component('components.alert-error',                'alert');
        Blade::component('components.profile-pen',                'pen');
    }
}
