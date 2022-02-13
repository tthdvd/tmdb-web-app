<?php

namespace tthdvd\Tmdb;

use Illuminate\Support\ServiceProvider;

class TMDBServiceProvider extends ServiceProvider
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
        $this->publishes([
            __DIR__ . '/../config/tmdb.php' => config_path('tmdb.php')
        ]);
    }
}
