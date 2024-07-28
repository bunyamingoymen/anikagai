<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CustomMigrationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom([
            'database/migrations/main',
            'database/migrations/shop',
        ]);
    }
}
