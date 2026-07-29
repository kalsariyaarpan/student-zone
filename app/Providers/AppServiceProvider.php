<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if (app()->environment('production')) {
            try {
                config(['session.driver' => Schema::hasTable('sessions') ? 'database' : 'file']);
            } catch (\Throwable $e) {
                config(['session.driver' => 'file']);
            }

            URL::forceScheme('https');
        }

        if (!app()->runningInConsole()) {
            config(['session.secure' => request()->isSecure()]);
        }
    }
}
