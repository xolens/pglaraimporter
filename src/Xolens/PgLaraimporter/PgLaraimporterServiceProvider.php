<?php

namespace Xolens\PgLaraimporter;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Xolens\PgLarautil\PgLarautilServiceProvider;

class PgLaraimporterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->register(PgLarautilServiceProvider::class);
        $this->app->make('Illuminate\Database\Eloquent\Factory')->load(__DIR__ . '/../../database/factories');

        $this->publishes([
            __DIR__.'/../../config/xolens-pglaraimporter.php' => config_path('xolens-pglaraimporter.php'),
        ]);
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/xolens-pglaraimporter.php', 'xolens-pglaraimporter'
        );
    }
}