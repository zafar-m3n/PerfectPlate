<?php

namespace App\Providers;

use App\Services\SettingsServices;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SettingsServices::class, function () {
            return new SettingsServices();

        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $settingsService = $this->app->make(SettingsServices::class);
        $settingsService->setGlobalSettings();
    }
}
